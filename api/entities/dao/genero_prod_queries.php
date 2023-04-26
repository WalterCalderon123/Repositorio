<?php
require_once('../../helpers/database.php');
/*
*	Clase para manejar el acceso a datos de la entidad GENEROS PRODUCTOS.
*/
class Genero_prod_Queries
{
    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT idgenero_producto, nombre_genero 
                FROM generos_productos
                WHERE nombre_genero ILIKE ?
                ORDER BY idgenero_producto';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO generos_productos(nombre_genero)
                VALUES(?)';
        $params = array($this->nombregenero);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT idgenero_producto, nombre_genero 
                FROM generos_productos
                ORDER BY idgenero_producto';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT idgenero_producto, nombre_genero 
                FROM generos_productos
                WHERE idgenero_producto = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow($current_image)
    {
       
        $sql = 'UPDATE generos_productos
                SET nombre_genero = ?
                WHERE idgenero_producto = ?';
        $params = array($this->nombregenero, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM generos_productos
                WHERE idgenero_productos = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
