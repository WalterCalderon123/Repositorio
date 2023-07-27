
// Constante para completar la ruta de la API.
const PRODUCTO_API = 'business/dashboard/producto.php';
const PEDIDO_API = 'business/dashboard/pedido.php';

// Método manejador de eventos para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', () => {
    graficoBarrasMarca();
    graficoPastelTipo();
    graficoBarrasGenero();
    graficoDonaEstado();
});

/*
*   Función asíncrona para mostrar en un gráfico de barras segun la cantidad de productos por marca.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
async function graficoBarrasMarca() {
    // Petición para obtener los datos del gráfico.
    const JSON = await dataFetch(PRODUCTO_API, 'cantidadProductosMarca');
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas.
    if (JSON.status) {
        // Se declaran los arreglos para guardar los datos a graficar.
        let marcas = [];
        let cantidades = [];
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        JSON.dataset.forEach(row => {
            // Se agregan los datos a los arreglos.
            marcas.push(row.nombre_marca);
            cantidades.push(row.cantidad);
        });
        // Llamada a la función que genera y muestra un gráfico de barras. Se encuentra en el archivo components.js
        barGraphY('chart1', marcas, cantidades, 'Cantidad de productos', 'Cantidad de productos por marca');
    } else {
        document.getElementById('chart1').remove();
        console.log(JSON.exception);
    }
}

/*
*   Función asíncrona para mostrar en un gráfico de pastel segun  la cantidad de productos por tipo.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
async function graficoPastelTipo() {
    // Petición para obtener los datos del gráfico.
    const JSON = await dataFetch(PRODUCTO_API, 'cantidadProductosTipo');
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas.
    if (JSON.status) {
        // Se declaran los arreglos para guardar los datos a gráficar.
        let tipo_productos = [];
        let cantidades = [];
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        JSON.dataset.forEach(row => {
            // Se agregan los datos a los arreglos.
            tipo_productos.push(row.tipo_producto);
            cantidades.push(row.cantidad);
        });
        // Llamada a la función que genera y muestra un gráfico de pastel. Se encuentra en el archivo components.js
        pieGraph('chart2', tipo_productos, cantidades, 'Cantidad de productos por tipo');
    } else {
        document.getElementById('chart2').remove();
        console.log(JSON.exception);
    }
}


/*
*   Función asíncrona para mostrar en un gráfico de barras segun la cantidad de productos por genero.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
async function graficoBarrasGenero() {
    // Petición para obtener los datos del gráfico.
    const JSON = await dataFetch(PRODUCTO_API, 'cantidadProductosGenero');
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas.
    if (JSON.status) {
        // Se declaran los arreglos para guardar los datos a graficar.
        let generos_productos = [];
        let cantidades = [];
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        JSON.dataset.forEach(row => {
            // Se agregan los datos a los arreglos.
            generos_productos.push(row.nombre_genero);
            cantidades.push(row.cantidad);
        });
        // Llamada a la función que genera y muestra un gráfico de barras. Se encuentra en el archivo components.js
        barGraphX('chart3', generos_productos, cantidades, 'Cantidad de productos', 'Cantidad de productos por genero');
    } else {
        document.getElementById('chart3').remove();
        console.log(JSON.exception);
    }
}


/*
*   Función asíncrona para mostrar en un gráfico de donut segun la cantidad de pedidos con un estado en especifico.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
async function graficoDonaEstado() {
    // Petición para obtener los datos del gráfico.
    const JSON = await dataFetch(PEDIDO_API, 'cantidadPedidosEstado');
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas.
    if (JSON.status) {
        // Se declaran los arreglos para guardar los datos a gráficar.
        let estado_pedidos = [];
        let cantidades = [];
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        JSON.dataset.forEach(row => {
            // Se agregan los datos a los arreglos.
            estado_pedidos.push(row.estado_pedido);
            cantidades.push(row.cantidad);
        });
        // Llamada a la función que genera y muestra un gráfico de pastel. Se encuentra en el archivo components.js
        doughnutGraph('chart4', estado_pedidos, cantidades, 'Cantidad de pedidos por estado');
    } else {
        document.getElementById('chart4').remove();
        console.log(JSON.exception);
    }
}