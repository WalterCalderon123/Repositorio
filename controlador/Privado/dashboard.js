
// Constante para completar la ruta de la API.
const PRODUCTO_API = 'business/dashboard/producto.php';

// Método manejador de eventos para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', () => {
    graficoBarrasMarca();
    graficoPastelMarca();
});

/*
*   Función asíncrona para mostrar en un gráfico de barras la cantidad de productos por categoría.
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
        barGraph('chart1', marcas, cantidades, 'Cantidad de productos', 'Cantidad de productos por marca');
    } else {
        document.getElementById('chart1').remove();
        console.log(JSON.exception);
    }
}

/*
*   Función asíncrona para mostrar en un gráfico de pastel el porcentaje de productos por categoría.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
async function graficoPastelMarca() {
    // Petición para obtener los datos del gráfico.
    const JSON = await dataFetch(PRODUCTO_API, 'cantidadProductosTipo');
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas.
    if (JSON.status) {
        // Se declaran los arreglos para guardar los datos a gráficar.
        let marcas = [];
        let cantidades = [];
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        JSON.dataset.forEach(row => {
            // Se agregan los datos a los arreglos.
            marcas.push(row.tipo_producto);
            cantidades.push(row.porcentaje);
        });
        // Llamada a la función que genera y muestra un gráfico de pastel. Se encuentra en el archivo components.js
        pieGraph('chart2', tipo_productos, cantidades, 'Cantidad de productos por tipo');
    } else {
        document.getElementById('chart2').remove();
        console.log(JSON.exception);
    }
}