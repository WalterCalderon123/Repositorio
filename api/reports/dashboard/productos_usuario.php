<?php
// Se incluye la clase con las plantillas para generar reportes.
require_once('../../helpers/report.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se verifica si existe un valor para la categoría, de lo contrario se muestra un mensaje.
if (isset($_GET['idusuario'])) {
    // Se incluyen las clases para la transferencia y acceso a datos.
    require_once('../../entities/dto/usuario.php');
    require_once('../../entities/dto/producto.php');
    // Se instancian las entidades correspondientes.
    $usuario = new Usuario;
    $producto = new Producto;
    // Se establece el valor de la categoría, de lo contrario se muestra un mensaje.
    if ($usuario->setId($_GET['idusuario']) && $producto->setUsuario($_GET['idusuario'])) {
        // Se verifica si la categoría existe, de lo contrario se muestra un mensaje.
        if ($rowUsuario = $usuario->readOne()) {
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Productos subidos por el usuario ' . $rowUsuario['alias_usuario']);
            // Se verifica si existen registros para mostrar, de lo contrario se imprime un mensaje.
            if ($dataProductos = $producto->productosUsuario()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->setFillColor(64, 127, 176);
                // Se establece la fuente para los encabezados.
                $pdf->setFont('Times', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->cell(126, 10, 'Nombre', 1, 0, 'C', 1);
                $pdf->cell(30, 10, 'Precio (US$)', 1, 0, 'C', 1);
                $pdf->cell(30, 10, 'Descuento (%)', 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->setFont('Times', '', 11);
                // Se recorren los registros fila por fila.
                foreach ($dataProductos as $rowProducto) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->cell(126, 10, $pdf->encodeString($rowProducto['nombre_producto']), 1, 0);
                    $pdf->cell(30, 10, $rowProducto['precio'], 1, 0);
                    $pdf->cell(30, 10, $rowProducto['descuento'], 1, 0);
                }
            } else {
                $pdf->cell(0, 10, $pdf->encodeString('No hay productos subidos por el usuario'), 1, 1);
            }
            // Se llama implícitamente al método footer() y se envía el documento al navegador web.
            $pdf->output('I', 'usuario.pdf');
        } else {
            print('Usuario inexistente');
        }
    } else {
        print('Usuario incorrecto');
    }
} else {
    print('Debe seleccionar un usuario');
}
