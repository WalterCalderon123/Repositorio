<?php
require_once('../../helpers/database.php');
/*
*	Clase para manejar el acceso a datos de la entidad CLIENTE.
*/
class ClienteQueries
{
    /*
    *   Métodos para gestionar la cuenta del cliente.
    */
    public function checkUser($correo)
    {
        $sql = 'SELECT idcliente FROM clientes WHERE correo = ?';
        $params = array($correo);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['idcliente'];
            $this->correo = $correo;
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        $sql = 'SELECT clave_cliente FROM clientes WHERE idcliente = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        if ( $data['clave_cliente']){
            return true;
        } else {
            return false;
        }
    }

    

    public function changePassword()
    {
        $sql = 'UPDATE clientes SET clave_cliente = ? WHERE id_cliente = ?';
        $params = array($this->clave, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function editProfile()
    {
        $sql = 'UPDATE clientes
                SET nombres_cliente = ?, apellidos_cliente = ?, correo_cliente = ?, dui_cliente = ?, telefono_cliente = ?, nacimiento_cliente = ?, direccion_cliente = ?
                WHERE id_cliente = ?';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->dui, $this->telefono, $this->nacimiento, $this->direccion, $this->id);
        return Database::executeRow($sql, $params);
    }


    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT idcliente, nombre_cliente, apellido_cliente, dui, correo, telefono, fecha_nacimiento, direccion
                FROM clientes
                WHERE apellidos_cliente ILIKE ? OR nombres_cliente ILIKE ? OR correo_cliente ILIKE ?
                ORDER BY apellidos_cliente';
        $params = array("%$value%", "%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO clientes(nombre_cliente, apellido_cliente, dui, correo, telefono, fecha_nacimiento, direccion, clave_cliente)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre, $this->apellido, $this->dui, $this->correo, $this->telefono, $this->nacimiento, $this->direccion,$this->clave);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT idcliente, nombre_cliente, apellido_cliente, dui,correo, telefono
                FROM clientes
                ORDER BY nombre_cliente';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT id_cliente, nombres_cliente, apellidos_cliente, correo_cliente, dui_cliente, telefono_cliente, nacimiento_cliente, direccion_cliente, estado_cliente
                FROM clientes
                WHERE id_cliente = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE clientes
                SET nombres_cliente = ?, apellidos_cliente = ?, dui_cliente = ?, estado_cliente = ?, telefono_cliente = ?, nacimiento_cliente = ?, direccion_cliente = ?
                WHERE id_cliente = ?';
        $params = array($this->nombres, $this->apellidos, $this->dui, $this->estado, $this->telefono, $this->nacimiento, $this->direccion, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM clientes
                WHERE id_cliente = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function readClienteGeneros()
    {
        $sql = 'SELECT idcliente, genero_cliente, nombre_cliente, apellido_cliente
                FROM clientes INNER JOIN genero_clientes USING (idgenero_cliente)
                WHERE idgenero_cliente = ? 
                ORDER BY nombre_cliente';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }

    //Creamos la consulta para obtener la cantidad de clientes que pertenecen a un genero 
    public function cantidadClientesGenero()
    {
        $sql = 'SELECT genero_cliente, COUNT(idcliente) cantidad
                FROM clientes INNER JOIN genero_clientes USING(idgenero_cliente)
                GROUP BY genero_cliente ORDER BY cantidad DESC';
        return Database::getRows($sql);   
    }
}

