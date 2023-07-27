<?php
// Se incluye la clase con las plantillas para generar reportes.
require_once('../../helpers/report.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se verifica si existe un valor para la categoría, de lo contrario se muestra un mensaje.
if (isset($_GET['iddetalle_pedido'])) {
    // Se incluyen las clases para la transferencia y acceso a datos.
    require_once('../../entities/dto/pedidos.php');
    require_once('../../entities/dto/detalle_pedido.php');
    require_once('../../entities/dto/producto.php');
    // Se instancian las entidades correspondientes.
    $pedido = new Pedido;
    $producto = new Producto;
    $detalle = new Detalle;

    // Se establece el valor de la categoría, de lo contrario se muestra un mensaje.
    if ($detalle->setId($_GET['iddetalle_pedido']) && $pedido->setIdDetalle($_GET['iddetalle_pedido'])) {
        // Se verifica si la categoría existe, de lo contrario se muestra un mensaje.
        if ($rowDetalle = $detalle->readOne()) {
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Factura del pedido ' . $rowDetalle['fecha_pedido']);
            // Se verifica si existen registros para mostrar, de lo contrario se imprime un mensaje.
            if ($dataDetalle = $detalle->FacturaOrder()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->setFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->setFont('Times', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->cell(60, 10, 'Producto', 1, 0, 'C', 1);
                $pdf->cell(40, 10, 'Precio (US$)', 1, 0, 'C', 1);
                $pdf->cell(40, 10, 'Cantidad', 1, 0, 'C', 1);
                $pdf->cell(46, 10, 'Total (US$)', 1, 1
                , 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->setFont('Times', '', 11);
                // Se recorren los registros fila por fila.
                foreach ($dataDetalle as $rowProducto) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->cell(60, 10, $pdf->encodeString($rowProducto['nombre_producto']), 1, 0);
                    $pdf->cell(40, 10, $rowProducto['precio'], 1, 0);
                    $pdf->cell(40, 10, $rowProducto['cantidad_producto'], 1, 0);
                    $pdf->cell(46, 10, $rowProducto['total'], 1, 0);

                }
            } else {
                $pdf->cell(0, 10, $pdf->encodeString('No hay productos para el genero'), 1, 1);
            }
            // Se llama implícitamente al método footer() y se envía el documento al navegador web.
            $pdf->output('I', 'Factura.pdf');
        } else {
            print('Factura de producto inexistente');
        }
    } else {
        print('Factura incorrecto');
    }
} else {
    print('Debe realizar un pedido');
}
