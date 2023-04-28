<?php
require_once('../../helpers/database.php');
/*
*	Clase para manejar el acceso a datos de la entidad PRODUCTO.
*/
class EstadoPedidoQueries
{
    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */

 
    public function readAll()
    {
        $sql = 'SELECT idestado_pedido, estado_pedido
                FROM estado_pedidos';
        return Database::getRows($sql);
    }
}