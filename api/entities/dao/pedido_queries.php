<?php
require_once('../../helpers/database.php');
/*
*	Clase para manejar el acceso a datos de la entidad PRODUCTO.
*/
class PedidoQueries
{

    public function startOrder()
    {
        $sql = 'SELECT id_pedido
                FROM pedidos
                WHERE estado_pedido = 0 AND idcliente = ?';
        $params = array($_SESSION['idcliente']);
        if ($data = Database::getRow($sql, $params)) {
            $this->id_pedido = $data['id_pedido'];
            return true;
        } else {
            $sql = 'INSERT INTO pedidos(direccion_pedido, idcliente)
                    VALUES((SELECT direccion FROM clientes WHERE idcliente = ?), ?)';
            $params = array($_SESSION['idcliente'], $_SESSION['idcliente']);
            // Se obtiene el ultimo valor insertado en la llave primaria de la tabla pedidos.
            if ($this->id_pedido = Database::getLastRow($sql, $params)) {
                return true;
            } else {
                return false;
            }
        }
    }

    // Método para agregar un producto al carrito de compras.
 

    public function createDetail()
    {
        // Se realiza una subconsulta para obtener el precio del producto.
        $sql = 'INSERT INTO detalle_pedidos(id_pedido,cantidad_producto,idproducto, precio)
                VALUES(?, ?, ?,(SELECT precio FROM productos WHERE idproducto = ?))';
        $params = array($this->id_pedido, $this->cantidad, $this->producto, $this->producto);
        return Database::executeRow($sql, $params);
    }


    // Método para obtener los productos que se encuentran en el carrito de compras.
    public function readOrderDetail()
    {
        $sql = 'SELECT iddetalle_pedido, nombre_producto, detalle_pedidos.precio, detalle_pedidos.cantidad_producto
                FROM pedidos INNER JOIN detalle_pedidos USING(id_pedido) INNER JOIN productos USING(idproducto)
                WHERE id_pedido = ?';
        $params = array($this->id_pedido);
        return Database::getRows($sql, $params);
    }

    // Método para finalizar un pedido por parte del cliente.
    public function finishOrder()
    {
        // Se establece la zona horaria local para obtener la fecha del servidor.
        date_default_timezone_set('America/El_Salvador');
        $date = date('Y-m-d');
        $this->estado = 1;
        $sql = 'UPDATE pedidos
                SET estado_pedido = ?, fecha_pedido = ?
                WHERE id_pedido = ?';
        $params = array($this->estado, $date, $_SESSION['id_pedido']);
        return Database::executeRow($sql, $params);
    }

    // Método para actualizar la cantidad de un producto agregado al carrito de compras.
    public function updateDetail()
    {
        $sql = 'UPDATE detalle_pedidos
                SET cantidad_producto = ?
                WHERE iddetalle_pedido = ? AND id_pedido = ?';
        $params = array($this->cantidad, $this->id_detalle, $_SESSION['id_pedido']);
        return Database::executeRow($sql, $params);
    }

    // Método para eliminar un producto que se encuentra en el carrito de compras.
    public function deleteDetail()
    {
        $sql = 'DELETE FROM detalle_pedidos
                WHERE iddetalle_pedido= ? AND id_pedido = ?';
        $params = array($this->id_detalle, $_SESSION['id_pedido']);
        return Database::executeRow($sql, $params);
    }

    public function readHistoryOrder()
    {
        $sql = 'SELECT iddetalle_pedido, nombre_producto, detalle_pedidos.precio, detalle_pedidos.cantidad_producto,fecha_pedido, estado_pedido
        FROM pedidos INNER JOIN detalle_pedidos USING(id_pedido) INNER JOIN productos USING(idproducto)
        WHERE idcliente = ?';
        $params = array($_SESSION['idcliente']);
        return Database::getRows($sql, $params);
    }

   


    

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = ' SELECT id_pedido,nombre_cliente, estado_pedido, fecha_pedido, direccion_pedido
        FROM pedidos INNER JOIN clientes USING(idcliente)
        INNER JOIN estado_pedidos USING (idestado_pedido)
        WHERE nombre_cliente ILIKE ? 
        ORDER BY nombre_cliente';
        $params = array("%$value%");
        return Database::getRows($sql, $params);

        

    }

 
    public function readAll()
    {
        $sql = 'SELECT id_pedido,nombre_cliente, estado_pedido, fecha_pedido, direccion_pedido
                FROM pedidos INNER JOIN clientes USING(idcliente)
                INNER JOIN estado_pedidos USING (idestado_pedido)
                ORDER BY nombre_cliente';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT id_pedido,idcliente, idestado_pedido, fecha_pedido, direccion_pedido
                FROM pedidos 
                WHERE id_pedido = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
       
        $sql = 'UPDATE pedidos
                SET idestado_pedido = ? 
                WHERE id_pedido = ?';
        $params = array($this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function readEstadoPedidos()
    {
        $sql = 'SELECT id_pedido, estado_pedido, fecha_pedido, direccion_pedido
                FROM pedidos INNER JOIN estado_pedidos USING (idestado_pedido)
                WHERE idestado_pedido = ? 
                ORDER BY fecha_pedido';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }

    public function cantidadPedidosEstado()
    {
        $sql = 'SELECT estado_pedido, COUNT(id_pedido) cantidad
                FROM pedidos INNER JOIN estado_pedidos USING(idestado_pedido)
                GROUP BY estado_pedido ORDER BY cantidad DESC';
        return Database::getRows($sql);   
    }


    /*
    *   Métodos para generar reportes.
    */
    
    //Reporte no parametrizado de los pedidos de los cliente
    public function pedidosCliente()
    {
        $sql = 'SELECT fecha_pedido, direccion_pedido
                FROM pedidos
                INNER JOIN clientes USING(idcliente)
                WHERE idcliente = ?
                ORDER BY fecha_pedido';
        $params = array($this->cliente);
        return Database::getRows($sql, $params);
    }
}
  
