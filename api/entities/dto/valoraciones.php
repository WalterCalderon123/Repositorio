<?php
require_once('../../helpers/validator.php');
require_once('../../entities/dao/valoracion_queries.php');
/*
*	Clase para manejar la transferencia de datos de la entidad Valoracion.
*/
class Valoracion extends ValoracionQueries
{
    // Declaración de atributos (propiedades).
    protected $id = null;
    protected $detallepedido = null;
    protected $calificacion = null;
    protected $cliente = null;
    protected $titulo = null;
    protected $resenia = null;
    protected $fecha = null;
    protected $estado = null;

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

    public function setDetalle($value)
    {
        if (Validator::validateNaturalNumber($value, 1, 50)) {
            $this->detallepedido = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCalificacion($value)
    {
        if (Validator::validateNaturalNumber($value, 1, 1)) {
            $this->calificacion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCliente($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTitulo($value)
    {
        if (Validator::validateString($value, 1, 50)) {
            $this->titulo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setResenia($value)
    {
        if (Validator::validateString($value, 1, 800)) {
            $this->resenia = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setFecha($value)
    {
        if (Validator::validateDate($value)) {
            $this->fecha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEstado($value)
    {
        if (Validator::validateBoolean($value)) {
            $this->estado = $value;
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

    public function getDetalle()
    {
        return $this->detallepedido;
    }

    public function getCalificacion()
    {
        return $this->calificacion;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getResenia()
    {
        return $this->resenia;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getEstado()
    {
        return $this->estado;
    }


   
}
