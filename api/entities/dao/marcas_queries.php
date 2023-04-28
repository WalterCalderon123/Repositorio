<?php
require_once('../../helpers/database.php');
/*
*	Clase para manejar el acceso a datos de la entidad MARCA.
*/
class MarcaQueries
{
    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT idmarca, logo, nombre_marca
                FROM marcas 
                WHERE logo ILIKE ? OR nombre_marca ILIKE ?
                ORDER BY nombre_marca';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO marcas(nombre_marca, logo)
                VALUES(?, ?)';
        $params = array($this->marca, $this->logo);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT idmarca, nombre_marca, logo
                FROM marcas 
                ORDER BY nombre_marca';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT idmarca, nombre_marca, logo
                FROM marcas
                WHERE idmarca = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->logo) ? Validator::deleteFile($this->getRuta(), $current_image) : $this->logo = $current_image;

        $sql = 'UPDATE marcas
                SET logo = ?, nombre_marca = ?
                WHERE idmarca = ?';
        $params = array($this->logo, $this->marca, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM marcas
                WHERE idmarca = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    

  
}
