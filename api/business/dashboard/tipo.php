<?php
require_once('../../entities/dto/tipo.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $tipoprod = new Tipo_prod;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null, 'dataset' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['idusuario'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $tipoprod->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen '.count($result['dataset']).' registros';
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay datos registrados';
                }
                break;
            case 'search':
                $_POST = Validator::validateForm($_POST);
                if ($_POST['search'] == '') {
                    $result['exception'] = 'Ingrese un valor para buscar';
                } elseif ($result['dataset'] = $tipoprod->searchRows($_POST['search'])) {
                    $result['status'] = 1;
                    $result['message'] = 'Existen '.count($result['dataset']).' coincidencias';
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay coincidencias';
                }
                break;
            case 'create':
                $_POST = Validator::validateForm($_POST);
                if (!$tipoprod->setNombre($_POST['tipo'])) {
                    $result['exception'] = ' Tipo de Producto incorrecto';
                } elseif ($tipoprod->createRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Tipo de Producto creado correctamente';
                } else {
                    $result['exception'] = Database::getException();;
                }
                break;
            case 'readOne':
                if (!$tipoprod->setId($_POST['idtipo_producto'])) {
                    $result['exception'] = 'Tipo de Producto incorrecto';
                } elseif ($result['dataset'] = $tipoprod->readOne()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'Tipo de Producto inexistente';
                }
                break;
            case 'update':
                $_POST = Validator::validateForm($_POST);
                if (!$tipoprod->setId($_POST['id'])) {
                    $result['exception'] = 'Tipo de Producto incorrecto';
                } elseif (!$data = $tipoprod->readOne()) {
                    $result['exception'] = 'Tipo de Producto inexistente';
                } elseif (!$tipoprod->setNombre($_POST['tipo'])) {
                    $result['exception'] = 'Tipo de Producto incorrecto';
                }  elseif ($tipoprod->updateRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Tipo de Producto modificado correctamente';
                }else {
                    $result['exception'] = Database::getException();
                }
                break;
            case 'delete':
                if (!$tipoprod->setId($_POST['idtipo_producto'])) {
                    $result['exception'] = 'Tipo de Producto incorrecto';
                } elseif (!$tipoprod->readOne()) {
                    $result['exception'] = 'Tipo de Producto inexistente';
                } elseif ($tipoprod->deleteRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Tipo de Producto eliminado correctamente';
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Acceso denegado'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}
