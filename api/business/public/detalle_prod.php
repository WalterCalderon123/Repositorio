<?php
require_once('../../entities/dto/detalle_prod.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se instancia la clase correspondiente.
    $detalleprod = new DetalleProd;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null, 'dataset' => null);
    // Se compara la acción a realizar según la petición del controlador.
    switch ($_GET['action']) {
        case 'readDetalle_prod':
            if (!$detalleprod->setId($_POST['iddetalle_producto'])) {
                $result['exception'] = 'Detalle del producto incorrecto';
            } elseif ($result['dataset'] = $detalleprod->readTallas()) {
                $result['status'] = 1;
            } elseif (Database::getException()) {
                $result['exception'] = Database::getException();
            } else {
                $result['exception'] = 'No existen detalles para mostrar';
            }
            break;
        case 'readOne':
            if (!$detalleprod->setId($_POST['idtalla'])) {
                $result['exception'] = 'Detalle del producto incorrecto';
            } elseif ($result['dataset'] = $detalleprod->readOne()) {
                $result['status'] = 1;
            } elseif (Database::getException()) {
                $result['exception'] = Database::getException();
            } else {
                $result['exception'] = 'Detalle del producto inexistente';
            }
            break;
        default:
            $result['exception'] = 'Acción no disponible';
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
