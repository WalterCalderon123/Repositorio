<?php
require_once('../../helpers/validator.php');
require_once('../../entities/dao/marcas_queries.php');
/*
*	Clase para manejar la transferencia de datos de la entidad PRODUCTO.
*/
class Marcas extends MarcaQueries
{
    // Declaración de atributos (propiedades).
    protected $id = null;
    protected $marca = null;
    protected $logo = null;
    protected $ruta = '../../images/marcas/';

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

    public function setMarca($value)
    {
        if (Validator::validateAlphanumeric($value, 1, 50)) {
            $this->marca = $value;
            return true;
        } else {
            return false;
        }
    }

   
    
    public function setImagen($file)
    {
        if (Validator::validateImageFile($file, 500, 500)) {
            $this->logo = Validator::getFileName();
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
        return $this->marca;
    }


    public function getImagen()
    {
        return $this->logo;
    }


    public function getRuta()
    {
        return $this->ruta;
    }
}
