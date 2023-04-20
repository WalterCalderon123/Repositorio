<?php
require_once('../../entities/dto/genero_prod.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $Genero_prod = new Genero_prod;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null, 'dataset' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['idusuario'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $Genero_prod->readAll()) {
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
                } elseif ($result['dataset'] = $Genero_prod->searchRows($_POST['search'])) {
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
                if (!$Genero_prod->setNombre($_POST['nombre'])) {
                    $result['exception'] = 'Nombre incorrecto';
                } elseif ($Genero_prod->createRow()) {
                    $result['status'] = 1;
                    if () {
                        $result['message'] = 'Genero de producto creado correctamente';
                    } 
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            case 'readOne':
                if (!$Genero_prod->setId($_POST['idgenero_producto'])) {
                    $result['exception'] = 'Genero de producto incorrecto';
                } elseif ($result['dataset'] = $Genero_prod->readOne()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'Genero de producto inexistente';
                }
                break;
            case 'update':
                $_POST = Validator::validateForm($_POST);
                if (!$Genero_prod->setId($_POST['id'])) {
                    $result['exception'] = 'Genero de producto incorrecta';
                } elseif (!$data = $Genero_prod->readOne()) {
                    $result['exception'] = 'Genero de producto inexistente';
                } elseif (!$Genero_prod->setNombre($_POST['nombre'])) {
                    $result['exception'] = 'Nombre de genero incorrecto';
                } 
                    if () {
                        $result['status'] = 1;
                        $result['message'] = 'Genero de producto modificado correctamente';
                    } else {
                        $result['exception'] = Database::getException();
                    }
                
                    if () {
                        $result['message'] = 'Categoría modificada correctamente';
                    } 
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            case 'delete':
                if (!$Genero_prod->setId($_POST['idgenero_producto'])) {
                    $result['exception'] = 'Genero de producto incorrecto';
                } elseif (!$data = $Genero_prod->readOne()) {
                    $result['exception'] = 'Genero de producto inexistente';
                } elseif ($Genero_prod->deleteRow()) {
                    $result['status'] = 1;
                    if () {
                        $result['message'] = 'Genero de producto eliminado correctamente';
                    }
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
    } else {
    print(json_encode('Recurso no disponible'));
}
