<?php
require_once('../../helpers/database.php');
/*
*	Clase para manejar el acceso a datos de la entidad PRODUCTO.
*/
class ProductoQueries
{
    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = ' SELECT idproducto, imagen, nombre_producto, descripcion, precio, nombre_marca,nombre_genero,tipo_producto,nombre_usuario,descuento ,estado_producto
        FROM productos INNER JOIN marcas USING(idmarca)
        INNER JOIN generos_productos USING (idgenero_producto)
        INNER JOIN tipo_productos USING (idtipo_producto)
        INNER JOIN usuarios USING (idusuario)
        WHERE nombre_producto ILIKE ? OR descripcion ILIKE ?
        ORDER BY nombre_producto';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);

        

    }

    public function createRow()
    {
        $sql = 'INSERT INTO productos(nombre_producto, descripcion, precio, idmarca, idgenero_producto, idtipo_producto, imagen,  idusuario, descuento, estado_producto)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre, $this->descripcion, $this->precio, $this->marca, $this->genero, $this->tipo,$this->imagen, $this->usuario, $this->descuento,$this->estado);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT idproducto,nombre_producto, precio, nombre_marca, nombre_genero, tipo_producto, imagen, nombre_usuario, descuento, estado_producto
                FROM productos INNER JOIN marcas USING(idmarca)
                INNER JOIN generos_productos USING (idgenero_producto)
                INNER JOIN tipo_productos USING (idtipo_producto)
                INNER JOIN usuarios USING (idusuario)
                ORDER BY nombre_producto';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT idproducto,nombre_producto, descripcion, precio, idmarca, idgenero_producto, idtipo_producto, imagen, idusuario, descuento, estado_producto
                FROM productos
                WHERE idproducto = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->imagen) ? Validator::deleteFile($this->getRuta(), $current_image) : $this->imagen = $current_image;

        $sql = 'UPDATE productos
                SET imagen = ?, nombre_producto = ?, descripcion = ?, precio = ?, idmarca = ?, idgenero_producto = ?, idtipo_producto = ?, idusuario = ?, descuento = ?, estado_producto = ?
                WHERE idproducto = ?';
        $params = array($this->imagen, $this->nombre, $this->descripcion, $this->precio, $this->marca, $this->genero, $this->tipo, $this->usuario, $this->descuento, $this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM productos
                WHERE idproducto = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function readProductosMarcas()
    {
        $sql = 'SELECT idproducto, imagen, nombre_producto, descripcion, precio, nombre_marca
                FROM productos INNER JOIN marcas USING(idmarca)
                WHERE idmarca = ? AND estado_producto = true
                ORDER BY nombre_producto';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }

    public function readProductosGeneros()
    {
        $sql = 'SELECT idproducto, imagen, nombre_producto, descripcion, precio
                FROM productos INNER JOIN generos_productos USING (idgenero_producto)
                WHERE idgenero_producto = ? AND estado_producto = true
                ORDER BY nombre_producto';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }

    public function readProductosTipo()
    {
        $sql = 'SELECT idproducto, imagen, nombre_producto, descripcion, precio
                FROM productos INNER JOIN tipo_productos USING(idtipo_producto)
                WHERE idtipo_producto = ? AND estado_producto = true
                ORDER BY nombre_producto';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }

    public function readProductosUsuarios()
    {
        $sql = 'SELECT idproducto, imagen, nombre_producto, descripcion, precio
                FROM productos INNER JOIN usuarios USING(idusuarios)
                WHERE idusuarios = ? AND estado_producto = true
                ORDER BY nombre_producto';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }

    public function cantidadProductosMarca()
    {
        $sql = 'SELECT nombre_marca, COUNT(idproducto) cantidad
                FROM productos INNER JOIN marcas USING(idmarca)
                GROUP BY nombre_marca ORDER BY cantidad DESC';
        return Database::getRows($sql);
    }

    public function cantidadProductosTipo()
    {
        $sql = 'SELECT tipo_producto, COUNT(idproducto) cantidad
                FROM productos INNER JOIN tipo_productos USING(idtipo_producto)
                GROUP BY tipo_producto ORDER BY cantidad DESC';
        return Database::getRows($sql);   
    }
    

   


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
    public function productosMarca()
    {
        $sql = 'SELECT nombre_producto, precio, descuento
                FROM productos
                INNER JOIN marcas USING(idmarca)
                WHERE idmarca = ?
                ORDER BY nombre_producto';
        $params = array($this->marca);
        return Database::getRows($sql, $params);
    }

    /*
    *   Métodos para generar reportes.
    */
    public function productosTipo()
    {
        $sql = 'SELECT nombre_producto, precio, descuento
                FROM productos
                INNER JOIN tipo_productos USING(idtipo_producto)
                WHERE idtipo_producto = ?
                ORDER BY nombre_producto';
        $params = array($this->tipo);
        return Database::getRows($sql, $params);
    }
    
    /*
    *   Métodos para generar reportes.
    */
    public function productosGenero()
    {
        $sql = 'SELECT nombre_producto, precio, descuento
                FROM productos
                INNER JOIN generos_productos USING(idgenero_producto)
                WHERE idgenero_producto = ?
                ORDER BY nombre_producto';
        $params = array($this->genero);
        return Database::getRows($sql, $params);
    }
}
