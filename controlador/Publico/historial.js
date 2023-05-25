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
                </tr>
            `;
        });
        // Se muestra el total a pagar con dos decimales.
        // Se inicializa el componente Tooltip para que funcionen las sugerencias textuales.
    } else {
        sweetAlert(4, JSON.exception, false, 'index.html');
    }
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
