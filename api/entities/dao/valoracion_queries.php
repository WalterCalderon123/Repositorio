<?php
require_once('../../helpers/database.php');
/*
*	Clase para manejar el acceso a datos de la entidad Valoraciones.
*/
class ValoracionQueries
{
    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT idvaloracion, iddetalle_pedido, calificacion_producto, nombre, titulo, resenia, fecha_comentario, estado_valoracion
                FROM valoraciones
                WHERE iddetalle_pedido ILIKE ? OR calificacion_producto ILIKE ? OR nombre ILIKE ? 
                OR titulo ILIKE ? OR resenia ILIKE ? OR fecha_comentario ILIKE ?
                ORDER BY iddetalle_pedido';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE valoraciones
                SET iddetalle_pedido = ?, calificacion_producto = ?, nombre = ?, titulo = ?, resenia = ?, fecha_comentario = ?, estado_valoracion = ?
                WHERE idvaloracion = ?';
        $params = array($this->detallepedido, $this->calificacion, $this->nombre, $this->titulo, $this->resenia, $this->fecha, $this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }
    
    public function readAll()
    {
        $sql = 'SELECT idvaloracion, iddetalle_pedido, calificacion_producto, nombre, titulo, resenia, fecha_comentario, estado_valoracion
                FROM valoraciones
                ORDER BY idvaloracion';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT idvaloracion, iddetalle_pedido, calificacion_producto, nombre, titulo, resenia, fecha_comentario, estado_valoracion
                FROM valoraciones
                WHERE idvaloracion = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }
}
