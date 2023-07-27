<?php
// Se incluye la clase con las plantillas para generar reportes.
require_once('../../helpers/report.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se verifica si existe un valor para la categoría, de lo contrario se muestra un mensaje.
if (isset($_GET['idtipo_producto'])) {
    // Se incluyen las clases para la transferencia y acceso a datos.
    require_once('../../entities/dto/tipo.php');
    require_once('../../entities/dto/producto.php');
    // Se instancian las entidades correspondientes.
    $tipo = new Tipo_prod;
    $producto = new Producto;
    // Se establece el valor de la categoría, de lo contrario se muestra un mensaje.
    if ($tipo->setId($_GET['idtipo_producto']) && $producto->setTipo($_GET['idtipo_producto'])) {
        // Se verifica si la categoría existe, de lo contrario se muestra un mensaje.
        if ($rowTipo = $tipo->readOne()) {
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Productos de la categoría ' . $rowTipo['tipo_producto']);
            // Se verifica si existen registros para mostrar, de lo contrario se imprime un mensaje.
            if ($dataProductos = $producto->productosTipo()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->setFillColor(64, 127, 176);
                // Se establece la fuente para los encabezados.
                $pdf->setFont('Times', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->cell(30, 10, 'Nombre', 1, 0, 'C', 1);
                $pdf->cell(96, 10, 'Descripcion', 1, 0, 'C', 1);
                $pdf->cell(30, 10, 'Precio (US$)', 1, 0, 'C', 1);
                $pdf->cell(30, 10, 'Descuento (%)', 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->setFont('Times', '', 11);
                // Se recorren los registros fila por fila.
                foreach ($dataProductos as $rowProducto) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->cell(30, 10, $pdf->encodeString($rowProducto['nombre_producto']), 1, 0);
                    $pdf->cell(96, 10, $rowProducto['descripcion'], 1, 0);
                    $pdf->cell(30, 10, $rowProducto['precio'], 1, 0);
                    $pdf->cell(30, 10, $rowProducto['descuento'], 1, 0);
                }
            } else {
                $pdf->cell(0, 10, $pdf->encodeString('No hay productos para la categoría'), 1, 1);
            }
            // Se llama implícitamente al método footer() y se envía el documento al navegador web.
            $pdf->output('I', 'tipos.pdf');
        } else {
            print('Tipo de producto inexistente');
        }
    } else {
        print('Categoría incorrecta');
    }
} else {
    print('Debe seleccionar una categoría');
}
