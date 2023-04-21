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
        $sql = 'SELECT idtalla, num_talla
                FROM tallas
                WHERE num_talla ILIKE ?
                ORDER BY num_talla';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO tallas(num_talla)
                VALUES(?)';
        $params = array($this->numero);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT idtalla, num_talla
                FROM tallas
                ORDER BY num_talla';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT idtalla, num_talla
                FROM tallas
                WHERE idtalla = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE tallas
                SET num_talla = ?
                WHERE idtalla = ?';
        $params = array($this->numero, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM tallas
                WHERE idtalla = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
