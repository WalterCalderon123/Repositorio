<?php
require_once('../../helpers/validator.php');
require_once('../../entities/dao/genero_cliente_queries.php');
/*
*	Clase para manejar la transferencia de datos de la entidad GENEROS PRODUCTOS.
*/
class Genero_cliente extends Genero_cliente_Queries
{
    // Declaración de atributos (propiedades).
    protected $id = null;
    protected $genero = null;
    

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

    public function setGenero($value)
    {
        if (Validator::validateAlphanumeric($value, 1, 50)) {
            $this->genero = $value;
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

    public function getGenero()
    {
        return $this->genero;
    }

   
}
