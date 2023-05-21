<?php
require_once('../../helpers/database.php');
/*
*	Clase para manejar el acceso a datos de la entidad GENEROS PRODUCTOS.
*/
class Genero_cliente_Queries
{
    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
  

    public function readAll()
    {
        $sql = 'SELECT idgenero_cliente, genero_cliente 
                FROM genero_clientes
                ORDER BY idgenero_cliente';
        return Database::getRows($sql);
    }

 
}
