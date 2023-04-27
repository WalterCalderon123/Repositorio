<?php
require_once('../../helpers/validator.php');
require_once('../../entities/dao/detalle_prod_queries.php');
/*
*	Clase para manejar la transferencia de datos de la entidad Talla.
*/
class DetalleProd extends DetalleprodQueries
{
    // Declaración de atributos (propiedades).
    protected $id = null;
    protected $producto = null;
    protected $talla = null;
    protected $existencia = null;

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

    public function setProducto($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->producto = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTalla($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->talla = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setExistencia($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->existencia = $value;
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

    public function getProducto()
    {
        return $this->producto;
    }

    public function getTalla()
    {
        return $this->talla;
    }

    public function getExistencia()
    {
        return $this->existencia;
    }
}
