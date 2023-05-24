<?php
require_once('../../entities/dto/detalle_prod.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $detalleprod = new DetalleProd;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null, 'dataset' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['idusuario'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $detalleprod->readAll()) {
                    $result['status'] = 1;
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
                } elseif ($result['dataset'] = $detalleprod->searchRows($_POST['search'])) {
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
                if (!$detalleprod->setProducto($_POST['producto'])) {
                    $result['exception'] = 'Producto incorrecto';
                }  elseif (!$detalleprod->setTalla($_POST['talla'])) {
                    $result['exception'] = 'Talla incorrecta';
                }  elseif (!$detalleprod->setExistencia($_POST['existencia1'])) {
                    $result['exception'] = 'Existencia incorrecta';
                }   elseif ($detalleprod->createRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Detalle creado correctamente';
                } else {
                    $result['exception'] = Database::getException();;
                }
                break;
            case 'readOne':
                if (!$detalleprod->setId($_POST['id'])) {
                    $result['exception'] = 'Detalle incorrecto';
                } elseif ($result['dataset'] = $detalleprod->readOne()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'Detalle inexistente';
                }
                break;
            case 'update':
                $_POST = Validator::validateForm($_POST);
                if (!$detalleprod->setId($_POST['id'])) {
                    $result['exception'] = 'Detalle incorrect';
                } elseif (!$data = $detalleprod->readOne()) {
                    $result['exception'] = 'Detalle inexistente';
                } elseif (!$detalleprod->setExistencia($_POST['existencia'])) {
                    $result['exception'] = 'Existencia incorrecta';
                }  elseif ($detalleprod->updateRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Detalle modificado correctamente';
                }else {
                    $result['exception'] = Database::getException();
                }
                break;
            case 'delete':
                if (!$detalleprod->setId($_POST['iddetalle_producto'])) {
                    $result['exception'] = 'Detalle incorrecto';
                } elseif (!$detalleprod->readOne()) {
                    $result['exception'] = 'Detalle inexistente';
                } elseif ($detalleprod->deleteRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Detalle eliminado correctamente';
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
