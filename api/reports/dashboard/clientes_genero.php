<?php
// Se incluye la clase con las plantillas para generar reportes.
require_once('../../helpers/report.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se verifica si existe un valor para la categoría, de lo contrario se muestra un mensaje.
if (isset($_GET['idgenero_cliente'])) {
    // Se incluyen las clases para la transferencia y acceso a datos.
    require_once('../../entities/dto/genero_cliente.php');
    require_once('../../entities/dto/cliente.php');
    // Se instancian las entidades correspondientes.
    $genero = new Genero;
    $cliente = new Cliente;
    // Se establece el valor de la categoría, de lo contrario se muestra un mensaje.
    if ($genero->setId($_GET['idgenero_cliente']) && $cliente->setGenero($_GET['idgenero_cliente'])) {
        // Se verifica si la categoría existe, de lo contrario se muestra un mensaje.
        if ($rowGenero = $genero->readOne()) {
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Clientes de un genero' . $rowGenero['genero_cliente']);
            // Se verifica si existen registros para mostrar, de lo contrario se imprime un mensaje.
            if ($dataClientes = $cliente->clientesGenero()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->setFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->setFont('Times', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->cell(126, 10, 'Nombre', 1, 0, 'C', 1);
                $pdf->cell(30, 10, 'DUI', 1, 0, 'C', 1);
                $pdf->cell(30, 10, 'Estado', 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->setFont('Times', '', 11);
                // Se recorren los registros fila por fila.
                foreach ($dataClientes as $rowCliente) {
                    ($rowCliente['estado_producto']) ? $estado = 'Activo' : $estado = 'Inactivo';
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->cell(126, 10, $pdf->encodeString($rowCliente['nombre_producto']), 1, 0);
                    $pdf->cell(30, 10, $rowCliente['precio_producto'], 1, 0);
                    $pdf->cell(30, 10, $estado, 1, 1);
                }
            } else {
                $pdf->cell(0, 10, $pdf->encodeString('No hay clientes para el genero'), 1, 1);
            }
            // Se llama implícitamente al método footer() y se envía el documento al navegador web.
            $pdf->output('I', 'genero.pdf');
        } else {
            print('Genero inexistente');
        }
    } else {
        print('Genero incorrecto');
    }
} else {
    print('Debe seleccionar un Genero');
}
