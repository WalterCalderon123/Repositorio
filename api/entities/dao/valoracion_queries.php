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
        $sql = 'SELECT idvaloracion, iddetalle_pedido, calificacion_producto, nombre_cliente, titulo, resenia, fecha_comentario, estado_valoracion
                FROM valoraciones
                INNER JOIN clientes USING (idcliente)
                WHERE iddetalle_pedido ILIKE ? OR calificacion_producto ILIKE ? OR nombre ILIKE ? 
                OR titulo ILIKE ? OR resenia ILIKE ? OR fecha_comentario ILIKE ?
                ORDER BY iddetalle_pedido';
        $params = array("%$value%", "%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO valoraciones(iddetalle_pedido, calificacion_producto, idcliente, titulo, resenia, fecha_comentario, estado_valoracion)
                VALUES(?,?,?,?,?,?,?)';
        $params = array($this->detallepedido, $this->calificacion, $this->cliente, $this->titulo, $this->resenia, $this->fecha, $this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE valoraciones
                SET iddetalle_pedido = ?, calificacion_producto = ?, idcliente = ?, titulo = ?, resenia = ?, fecha_comentario = ?, estado_valoracion = ?
                WHERE idvaloracion = ?';
        $params = array($this->detallepedido, $this->calificacion, $this->cliente, $this->titulo, $this->resenia, $this->fecha, $this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM valoraciones
                WHERE idvaloracion = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
    
    public function readAll()
    {
        $sql = 'SELECT idvaloracion, iddetalle_pedido, calificacion_producto, nombre_cliente, titulo, resenia, fecha_comentario, estado_valoracion
                FROM valoraciones
                INNER JOIN clientes USING (idcliente)
                ORDER BY idvaloracion';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT idvaloracion, iddetalle_pedido, calificacion_producto, idcliente, titulo, resenia, fecha_comentario, estado_valoracion
                FROM valoraciones
                WHERE idvaloracion = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

}
