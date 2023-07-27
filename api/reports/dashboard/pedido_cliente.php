<?php
// Se incluye la clase con las plantillas para generar reportes.
require_once('../../helpers/report.php');
// Se incluyen las clases para la transferencia y acceso a datos.
require_once('../../entities/dto/pedidos.php');
require_once('../../entities/dto/cliente.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Pedidos por clientes');
// Se instancia el módelo Categoría para obtener los datos.
$cliente = new Cliente;
// Se verifica si existen registros para mostrar, de lo contrario se imprime un mensaje.
if ($dataCliente = $cliente->readAll()) {
    // Se establece un color de relleno para los encabezados.
    $pdf->setFillColor(64, 127, 176);
    // Se establece la fuente para los encabezados.
    $pdf->setFont('Times', 'B', 11);
    // Se imprimen las celdas con los encabezados.
    $pdf->cell(50, 10, 'Fecha de pedido', 1, 0, 'C', 1);
    $pdf->cell(136, 10, 'Direccion', 1, 1, 'C', 1);

    // Se establece un color de relleno para mostrar el nombre de la categoría.
    $pdf->setFillColor(255, 79, 79);
    // Se establece la fuente para los datos de los productos.
    $pdf->setFont('Times', '', 11);

    // Se recorren los registros fila por fila.
    foreach ($dataCliente as $rowCliente) {
        // Se imprime una celda con el nombre de la categoría.
        $pdf->cell(0, 10, $pdf->encodeString('Cliente: ' . $rowCliente['nombre_cliente']), 1, 1, 'C', 1);
        // Se instancia el módelo Producto para procesar los datos.
        $pedido = new Pedido;
        // Se establece la marca para obtener sus productos, de lo contrario se imprime un mensaje de error.
        if ($pedido->setCliente($rowCliente['idcliente'])) {
            // Se verifica si existen registros para mostrar, de lo contrario se imprime un mensaje.
            if ($dataPedido = $pedido->pedidosCliente()) {
                // Se recorren los registros fila por fila.
                foreach ($dataPedido as $rowPedido) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->cell(50, 10, $pdf->encodeString($rowPedido['fecha_pedido']), 1, 0);
                    $pdf->cell(136, 10, $rowPedido['direccion_pedido'], 1, 1);
                }
            } else {
                $pdf->cell(0, 10, $pdf->encodeString('No hay pedidos de clientes'), 1, 1);
            }
        } else {
            $pdf->cell(0, 10, $pdf->encodeString('Cliente incorrecto o inexistente'), 1, 1);
        }
    }
} else {
    $pdf->cell(0, 10, $pdf->encodeString('No hay clientes para mostrar'), 1, 1);
}
// Se llama implícitamente al método footer() y se envía el documento al navegador web.
$pdf->output('I', 'pedidos.pdf');
