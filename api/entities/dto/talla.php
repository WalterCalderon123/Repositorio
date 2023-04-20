<?php
require_once('../../helpers/validator.php');
require_once('../../entities/dao/talla_queries.php');
/*
*	Clase para manejar la transferencia de datos de la entidad Talla.
*/
class Talla extends TallaQueries
{
    // Declaración de atributos (propiedades).
    protected $id = null;
    protected $numero = null;

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

    public function setNumero($value)
    {
        if (Validator::validateAlphanumeric($value, 1, 50)) {
            $this->numero = $value;
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

    public function getNumero()
    {
        return $this->numero;
    }
}
