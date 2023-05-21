<?php
require_once('../../helpers/database.php');
/*
*	Clase para manejar el acceso a datos de la entidad USUARIO.
*/
class ClienteQueries
{
    /*
    *   Métodos para gestionar la cuenta del usuario.
    */
    

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT idusuario, nombre_usuario, apellido_usuario, correo_usuario, alias_usuario
                FROM usuarios
                WHERE apellido_usuario ILIKE ? OR nombre_usuario ILIKE ?
                ORDER BY nombre_usuario';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT idusuario, nombre_usuario, apellido_usuario, correo_usuario, alias_usuario
                FROM usuarios
                ORDER BY apellido_usuario';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT idusuario, nombre_usuario, apellido_usuario, correo_usuario, alias_usuario
                FROM usuarios
                WHERE idusuario = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE usuarios 
                SET nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?
                WHERE idusuario = ?';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM usuarios
                WHERE idusuario = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
