// Constante para completar la ruta de la API.
const PRODUCTO_API = 'business/public/producto.php';
const MARCA_API = 'business/public/marcas.php';
const PARAMS = new URLSearchParams(location.search);
// Constantes para establecer las etiquetas de encabezado y pie de la página web.
const TITULO = document.getElementById('titulomarca');

// Constante para establecer el contenedor de categorías.
const PRODUCTOS = document.getElementById('productos');
const MARCAS = document.getElementById('marcas');

// Constante tipo objeto para establecer las opciones del componente Slider.
const OPTIONS = {
    height: 300
}
// Se inicializa el componente Slider para que funcione el carrusel de imágenes.

// Método manejador de eventos para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', async () => {
// Se define un objeto con los datos de la categoría seleccionada.
const FORM = new FormData();
FORM.append('idmarca', PARAMS.get('id'));
// Petición para solicitar los productos de la categoría seleccionada.
const JSON = await dataFetch(PRODUCTO_API, 'readProductosMarca', FORM);
// Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.

if (JSON.status) {
    // Se inicializa el contenedor de productos.
    PRODUCTOS.innerHTML = '';

    // Se recorre el conjunto de registros fila por fila a través del objeto row.
    JSON.dataset.forEach(row => {
        // Se crean y concatenan las tarjetas con los datos de cada producto.
        url = `producto_info.html?id=${row.idproducto}`;
        PRODUCTOS.innerHTML += `
            <a href="${url}" class="text-dark" data-producto="ID-del-producto">
            <div class="card" style="width: 18rem;">
              <img src="${SERVER_URL}images/productos/${row.imagen}" height="288px" class="card-img-top">
              <div class="card-body">
                <h5 id="titulo-marca" class="text-secondary">${row.nombre_marca}</h5>
                <h4  id="titulo-producto">${row.nombre_producto}</h4>
                <h5 id="precio" class="text-secondary">${row.precio}</h5>
              </div>
            </div>
          </a>
        `;
    });
    // Se asigna como título la categoría de los productos.
    TITULO.textContent = PARAMS.get('nombre');
    
} else {
    // Se presenta un mensaje de error cuando no existen datos para mostrar.
    TITULO.textContent = JSON.exception;
}
    

   
});



