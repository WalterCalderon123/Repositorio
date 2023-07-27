<?php
require_once('../../helpers/validator.php');
require_once('../../entities/dao/detalle_pedido_queries.php');
/*
*	Clase para manejar la transferencia de datos de las entidades PEDIDO y DETALLE_PEDIDO.
*/
class Detalle extends DetallePedidoQueries
{
    // Declaración de atributos (propiedades).
    protected $id = null;
    protected $pedido = null;
   
   
    /*
    *   ESTADOS PARA UN PEDIDO
    *   0: Pendiente. Es cuando el pedido esta en proceso por parte del cliente y se puede modificar el detalle.
    *   1: Finalizado. Es cuando el cliente finaliza el pedido y ya no es posible modificar el detalle.
    *   2: Entregado. Es cuando la tienda ha entregado el pedido al cliente.
    *   3: Anulado. Es cuando el cliente se arrepiente de haber realizado el pedido.
    */

    /*
    *   Métodos para validar y asignar valores de los atributos.
    */
    public function setId($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPedido($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->pedido = $value;
            return true;
        } else {
            return false;
        }
    }
   
    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getPedido()
    {
        return $this->pedido;
    }
}
