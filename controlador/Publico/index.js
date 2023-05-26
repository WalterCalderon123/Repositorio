// Constante para completar la ruta de la API.
const PRODUCTO_API = 'business/public/producto.php';
const MARCA_API = 'business/public/marcas.php';

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

    // Petición para obtener los productos disponibles.
  fillProductos();

   // Petición para obtener las marcas disponibles.
   fillMarcas();
});

async function fillProductos() {

    const JSON = await dataFetch(PRODUCTO_API, 'readAll');

    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (JSON.status) {
        // Se inicializa el contenedor de categorías.
        PRODUCTOS.innerHTML = '';
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        JSON.dataset.forEach(row => {
            // Se establece la página web de destino con los parámetros.
            url = `producto_info.html?id=${row.idproducto}`;
            // Se crean y concatenan las tarjetas con los datos de cada categoría.
            PRODUCTOS.innerHTML += /*
                <div class="col s12 m6 l4">
                    <div class="card hoverable">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img src="${SERVER_URL}images/categorias/${row.imagen_categoria}" class="activator">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">
                                <b>${row.nombre_categoria}</b>
                                <i class="material-icons right tooltipped" data-tooltip="Descripción">more_vert</i>
                            </span>
                            <p class="center">
                                <a href="${url}" class="tooltipped" data-tooltip="Ver productos">
                                    <i class="material-icons">local_cafe</i>
                                </a>
                            </p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">
                                <b>${row.nombre_categoria}</b>
                                <i class="material-icons right tooltipped" data-tooltip="Cerrar">close</i>
                            </span>
                            <p>${row.descripcion_categoria}</p>
                        </div>
                    </div>
                </div>
                */               
                `
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
        // Se inicializa el componente Tooltip para que funcionen las sugerencias textuales.
    } else {
        // Se asigna al título del contenido de la excepción cuando no existen datos para mostrar.
        document.getElementById('title').textContent = JSON.exception;
    }
}

async function fillMarcas() {

    const JSON = await dataFetch(MARCA_API, 'readAll');

    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (JSON.status) {
        // Se inicializa el contenedor de categorías.
        MARCAS.innerHTML = '';
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        JSON.dataset.forEach(row => {
            // Se establece la página web de destino con los parámetros.
            urlmarca = `catalogo.html?id=${row.idmarca}&nombre=${row.nombre_marca}`;
            // Se crean y concatenan las tarjetas con los datos de cada categoría.
            MARCAS.innerHTML += /*
                <div class="col s12 m6 l4">
                    <div class="card hoverable">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img src="${SERVER_URL}images/categorias/${row.imagen_categoria}" class="activator">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">
                                <b>${row.nombre_categoria}</b>
                                <i class="material-icons right tooltipped" data-tooltip="Descripción">more_vert</i>
                            </span>
                            <p class="center">
                                <a href="${url}" class="tooltipped" data-tooltip="Ver productos">
                                    <i class="material-icons">local_cafe</i>
                                </a>
                            </p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">
                                <b>${row.nombre_categoria}</b>
                                <i class="material-icons right tooltipped" data-tooltip="Cerrar">close</i>
                            </span>
                            <p>${row.descripcion_categoria}</p>
                        </div>
                    </div>
                </div>
                */               
                `
                <a href="${urlmarca}" class="text-dark" data-producto="ID-del-producto">
                <div class="card" style="width: 18rem;">
                  <img src="${SERVER_URL}images/marcas/${row.logo}" class="card-img-top">
                  <div class="card-body text-center">
                    <h4 id="titulo-marca" class="text-dark">${row.nombre_marca}</h4>
                  </div>
                </div>
              </a>
            `;
        });
        // Se inicializa el componente Tooltip para que funcionen las sugerencias textuales.
    } else {
        // Se asigna al título del contenido de la excepción cuando no existen datos para mostrar.
        document.getElementById('title').textContent = JSON.exception;
    }
}