<?php
require_once('../../helpers/database.php');
/*
*	Clase para manejar el acceso a datos de la entidad PRODUCTO.
*/
class DetallePedidoQueries
{
    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT iddetalle_pedido,b.fecha_pedido, c.nombre_producto , cantidad_producto
        FROM detalle_pedidos a,pedidos b, productos c, detalle_productos d
        where idpedido = b.id_pedido AND c.idproducto = d.idproducto AND c.nombre_producto ILIKE ?
        ORDER BY nombre_producto';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

 
    public function readAll()
    {
        $sql = 'SELECT iddetalle_pedido,b.fecha_pedido, c.nombre_producto , cantidad_producto
        FROM detalle_pedidos a,pedidos b, productos c, detalle_productos d
        where idpedido = b.id_pedido AND c.idproducto = d.idproducto
        ORDER BY nombre_producto';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT iddetalle_pedido,idpedido, iddetalle_producto, cantidad_producto
                FROM detalle_pedidos 
                WHERE iddetalle_pedido = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    /*public function updateRow()
    {
       
        $sql = 'UPDATE pedidos
                SET idestado_pedido = ? 
                WHERE id_pedido = ?';
        $params = array($this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }*/

    /*public function readEstadoPedidos()
    {
        $sql = 'SELECT id_pedido, estado_pedido, fecha_pedido, direccion_pedido
                FROM pedidos INNER JOIN estado_pedidos USING (idestado_pedido)
                WHERE idestado_pedido = ? 
                ORDER BY fecha_pedido';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }*/

    /*
    *   Métodos para generar gráficas.
    */
    /*public function cantidadProductosCategoria()
    {
        $sql = 'SELECT nombre_categoria, COUNT(id_producto) cantidad
                FROM productos INNER JOIN categorias USING(id_categoria)
                GROUP BY nombre_categoria ORDER BY cantidad DESC';
        return Database::getRows($sql);
    }

    public function porcentajeProductosCategoria()
    {
        $sql = 'SELECT nombre_categoria, ROUND((COUNT(id_producto) * 100.0 / (SELECT COUNT(id_producto) FROM productos)), 2) porcentaje
                FROM productos INNER JOIN categorias USING(id_categoria)
                GROUP BY nombre_categoria ORDER BY porcentaje DESC';
        return Database::getRows($sql);
    }*/

    /*
    *   Métodos para generar reportes.
    */
   /* public function productosCategoria()
    {
        $sql = 'SELECT nombre_producto, precio_producto, estado_producto
                FROM productos INNER JOIN categorias USING(id_categoria)
                WHERE id_categoria = ?
                ORDER BY nombre_producto';
        $params = array($this->categoria);
        return Database::getRows($sql, $params);
    }*/
}
