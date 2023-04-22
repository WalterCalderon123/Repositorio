<?php
require_once('../../helpers/validator.php');
require_once('../../entities/dao/producto_queries.php');
/*
*	Clase para manejar la transferencia de datos de la entidad PRODUCTO.
*/
class Producto extends ProductoQueries
{
    // Declaración de atributos (propiedades).
    protected $id = null;
    protected $nombre = null;
    protected $descripcion = null;
    protected $precio = null;
    protected $marca = null;
    protected $genero = null;
    protected $tipo = null;
    protected $imagen = null;
    protected $usuario = null;
    protected $descuento = null;
    protected $estado = null;
    protected $ruta = '../../images/productos/';





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
        if (Validator::validateAlphanumeric($value, 1, 150)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDescripcion($value)
    {
        if (Validator::validateString($value, 1, 500)) {
            $this->descripcion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPrecio($value)
    {
        if (Validator::validateMoney($value)) {
            $this->precio = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setMarca($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->marca = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setGenero($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->genero = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTipo($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->tipo = $value;
            return true;
        } else {
            return false;
        }
    }

    
    public function setImagen($file)
    {
        if (Validator::validateImageFile($file, 500, 500)) {
            $this->imagen = Validator::getFileName();
            return true;
        } else {
            return false;
        }
    }

    public function setUsuario($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->usuario = $value;
            return true;
        } else {
            return false;
        }
    }

  
    public function setDescuento($value)
    {
        if (Validator::validateMoney($value)) {
            $this->descuento = $value;
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

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getTipo()
    {
        return $this->tipo;
    }


    public function getImagen()
    {
        return $this->imagen;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getDescuento()
    {
        return $this->descuento;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getRuta()
    {
        return $this->ruta;
    }
}
