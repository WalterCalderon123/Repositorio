// Constante para completar la ruta de la API.
const PEDIDO_API = 'business/public/pedido.php';
// Constante para establecer el formulario de cambiar producto.
// Constante para establecer el cuerpo de la tabla.
const TBODY_ROWS = document.getElementById('tbody-rows');
// Constante tipo objeto para establecer las opciones del componente Modal.
const OPTIONS = {
    dismissible: false
}
// Se inicializa el componente Modal para que funcionen las cajas de diálogo.
// Constante para establecer la caja de diálogo de cambiar producto.

// Método manejador de eventos para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', () => {
    // Llamada a la función para mostrar los productos del carrito de compras.
    readHistoryDetail();
});

// Método manejador de eventos para cuando se envía el formulario de cambiar cantidad de producto.


/*
*   Función para obtener el detalle del carrito de compras.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
async function readHistoryDetail() {
    // Petición para obtener los datos del pedido en proceso.
    const JSON = await dataFetch(PEDIDO_API, 'readHistoryOrder');
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (JSON.status) {
        // Se inicializa el cuerpo de la tabla.
        TBODY_ROWS.innerHTML = '';
        // Se declara e inicializa una variable para calcular el importe por cada producto.
        let subtotal = 0;
        // Se declara e inicializa una variable para sumar cada subtotal y obtener el monto final a pagar.
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        JSON.dataset.forEach(row => {
            subtotal = row.precio * row.cantidad_producto;
            (row.estado_producto) ? icon = '<i class="fa-solid fa-check"></i>' : icon = '<i class="fa-sharp fa-regular fa-ban"></i>';

            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            TBODY_ROWS.innerHTML += `
                <tr>
                    <td>${row.nombre_producto}</td>
                    <td>${row.precio}</td>
                    <td>${row.cantidad_producto}</td>
                    <td>${row.fecha_pedido}</td>
                    <td>${icon}</td>
                    <td>${subtotal.toFixed(2)}</td>
                    <td>
                    <a onclick="openReport(${row.iddetalle_pedido})" class="btn btn-primary tooltipped" data-tooltip="Reporte">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-check-fill" viewBox="0 0 16 16">
                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm1.354 4.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                    </svg>
                    </a>
                </td>
                </tr>
            `;
        });
        // Se muestra el total a pagar con dos decimales.
        // Se inicializa el componente Tooltip para que funcionen las sugerencias textuales.
    } else {
        sweetAlert(4, JSON.exception, false, 'index.html');
    }
}

function openReport(id) {
    // Se declara una constante tipo objeto con la ruta específica del reporte en el servidor.
    const PATH = new URL(`${SERVER_URL}reports/public/pedido_factura.php`);
    PATH.searchParams.append('iddetalle_pedido', id);

    // Se abre el reporte en una nueva pestaña del navegador web.
    window.open(PATH.href);
}


/*
*   Función para abrir la caja de diálogo con el formulario de cambiar cantidad de producto.
*   Parámetros: id (identificador del producto) y quantity (cantidad actual del producto).
*   Retorno: ninguno.
*/

/*
*   Función asíncrona para mostrar un mensaje de confirmación al momento de eliminar un producto del carrito.
*   Parámetros: id (identificador del producto).
*   Retorno: ninguno.
*/
