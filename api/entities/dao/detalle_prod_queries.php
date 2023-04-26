<?php
require_once('../../helpers/database.php');
/*
*	Clase para manejar el acceso a datos de la entidad Talla.
*/
class TallaQueries
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
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO detalle_productos(idproducto, idtalla, existencia)
                VALUES(?,?,?)';
        $params = array($this->numero);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT iddetalle_producto, idproducto, idtalla, existencia
                FROM detalle_productos
                INNER JOIN productos USING(idproducto)
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
                SET idproducto = ?, idtalla = ?, existencia = ?
                WHERE iddetalle_producto = ?';
        $params = array($this->numero, $this->id);
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
        $sql = 'SELECT iddetalle_producto, idproducto, idtalla, existencia
                FROM detalle_productos INNER JOIN productos USING(idproducto)
                WHERE idmarca = ? AND estado_producto = true
                ORDER BY nombre_producto';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }
}
