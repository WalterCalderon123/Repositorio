<?php
require_once('../../helpers/database.php');
/*
*	Clase para manejar el acceso a datos de la entidad Talla.
*/
class DetalleprodQueries
{
    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT iddetalle_producto, idproducto, idtalla, existencia
                FROM detalle_productos
                INNER JOIN productos USING(idproducto)
                INNER JOIN tallas USING(idtalla)
                WHERE idproducto ILIKE ? OR idtalla ILIKE ? OR existencia ILIKE ?
                ORDER BY iddetalle_producto';
        $params = array("%$value%", "%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO detalle_productos(idproducto, idtalla, existencia)
                VALUES(?,?,?)';
        $params = array($this->producto, $this->talla, $this->existencia);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT iddetalle_producto, nombre_producto, num_talla, existencia
                FROM detalle_productos INNER JOIN productos USING(idproducto)
                INNER JOIN tallas USING(idtalla)
                ORDER BY iddetalle_producto';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT iddetalle_producto, idproducto, idtalla, existencia
                FROM detalle_productos
                WHERE iddetalle_producto = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE detalle_productos
                SET existencia = existencia + ?
                WHERE iddetalle_producto = ?';
        $params = array($this->existencia, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM detalle_productos
                WHERE iddetalle_producto = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function readDetallesProductos()
    {
        $sql = 'SELECT iddetalle_producto, existencia
                FROM detalle_productos INNER JOIN productos USING(idproducto)
                WHERE productos = ?
                ORDER BY iddetalle_producto';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }

    public function readDetallesTallas()
    {
        $sql = 'SELECT iddetalle_producto, existencia
                FROM detalle_productos INNER JOIN tallas USING(idtalla)
                WHERE tallas = ?
                ORDER BY iddetalle_producto';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }

    
    /*
    *   Métodos para generar reportes.
    */
    public function productosMarca()
    {
        $sql = 'SELECT nombre_producto, num_talla, existencia
                FROM productos
                INNER JOIN marcas USING(idmarca)
                WHERE idmarca = ?
                ORDER BY nombre_producto';
        $params = array($this->marca);
        return Database::getRows($sql, $params);
    }
}
