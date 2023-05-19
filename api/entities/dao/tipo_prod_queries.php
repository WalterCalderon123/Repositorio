<?php
require_once('../../helpers/database.php');
/*
*	Clase para manejar el acceso a datos de la entidad TIPOS PRODUCTOS.
*/
class Tipo_prod_Queries
{
    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT idtipo_producto, tipo_producto
                FROM tipo_productos
                WHERE tipo_producto ILIKE ?
                ORDER BY  tipo_producto';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO tipo_productos(tipo_producto)
                VALUES(?)';
        $params = array($this->tipo);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT idtipo_producto, tipo_producto 
                FROM tipo_productos
                ORDER BY idtipo_producto';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT idtipo_producto, tipo_producto 
                FROM tipo_productos
                WHERE idtipo_producto = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
       
        $sql = 'UPDATE tipo_productos
                SET tipo_producto = ?
                WHERE idtipo_producto = ?';
        $params = array($this->tipo, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM tipo_productos
                WHERE idtipo_producto = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
