<?php
require_once('../../helpers/database.php');
/*
*	Clase para manejar el acceso a datos de la entidad CATEGORIA.
*/
class CategoriaQueries
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
        $params = array($this->nombre, $this->imagen, $this->descripcion);
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

    public function updateRow($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->imagen) ? Validator::deleteFile($this->getRuta(), $current_image) : $this->imagen = $current_image;

        $sql = 'UPDATE tallas
                SET num_talla = ?
                WHERE idtalla = ?';
        $params = array($this->imagen, $this->nombre, $this->descripcion, $this->id);
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
