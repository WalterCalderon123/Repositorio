<?php
require_once('../../helpers/validator.php');
require_once('../../entities/dao/genero_prod_queries.php');
/*
*	Clase para manejar la transferencia de datos de la entidad GENEROS PRODUCTOS.
*/
class Genero_prod extends Genero_prod_Queries
{
    // Declaración de atributos (propiedades).
    protected $id = null;
    protected $nombregenero = null;
    

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

    public function setNombre($value)
    {
        if (Validator::validateAlphanumeric($value, 1, 50)) {
            $this->nombregenero = $value;
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

    public function getNombre()
    {
        return $this->nombregenero;
    }

   
}
