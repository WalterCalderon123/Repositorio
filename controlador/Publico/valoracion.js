// Constantes para completar las rutas de la API.
const VALORACION_API = 'business/dashboard/valoraciones.php';
const DETALLEPED_API = 'business/dashboard/detalleprod.php';


// Constante para establecer el formulario de buscar.
const SEARCH_FORM = document.getElementById('search-form');
// Constante para establecer el formulario de guardar.
const SAVE_FORM = document.getElementById('save-form');
// Constante para establecer el título de la modal.
const MODAL_TITLE = document.getElementById('modal-title');
// Constantes para establecer el contenido de la tabla.
const TBODY_ROWS = document.getElementById('tbody-rows');
const RECORDS = document.getElementById('records');
// Constante tipo objeto para establecer las opciones del componente Modal.
const OPTIONS = {
    dismissible: false
}
// Inicialización del componente Modal para que funcionen las cajas de diálogo.
// Constante para establecer la modal de guardar.
const SAVE_MODAL = document.getElementById('save-modal');

// Método manejador de eventos para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', () => {
    // Llamada a la función para llenar la tabla con los registros disponibles.
    fillTable();
});

// Método manejador de eventos para cuando se envía el formulario de buscar.
SEARCH_FORM.addEventListener('submit', (event) => {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Constante tipo objeto con los datos del formulario.
    const FORM = new FormData(SEARCH_FORM);
    // Llamada a la función para llenar la tabla con los resultados de la búsqueda.
    fillTable(FORM);
});

// Método manejador de eventos para cuando se envía el formulario de guardar.
SAVE_FORM.addEventListener('submit', async (event) => {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se verifica la acción a realizar.
    (document.getElementById('id').value) ? action = 'update' : action = 'create';
    // Constante tipo objeto con los datos del formulario.
    const FORM = new FormData(SAVE_FORM);
    // Petición para guardar los datos del formulario.
    const JSON = await dataFetch(VALORACION_API, action, FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (JSON.status) {
        // Se carga nuevamente la tabla para visualizar los cambios.
        fillTable();
        // Se cierra la caja de diálogo.
        
        // Se muestra un mensaje de éxito.
        sweetAlert(1, JSON.message, true);
    } else {
        sweetAlert(2, JSON.exception, false);
    }
});


document.addEventListener('DOMContentLoaded', async () => {
    // Petición para obtener las valoraciones disponibles.
  fillValoracion();
});

async function fillValoracion() {

    const JSON = await dataFetch(VALORACION_API, 'readAll');

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

/*
*   Función asíncrona para llenar la tabla con los registros disponibles.
*   Parámetros: form (objeto opcional con los datos de búsqueda).
*   Retorno: ninguno.
*/
async function fillTable(form = null) {
    // Se inicializa el contenido de la tabla.
    TBODY_ROWS.innerHTML = '';
    RECORDS.textContent = '';
    // Se verifica la acción a realizar.
    (form) ? action = 'search' : action = 'readAll';
    // Petición para obtener los registros disponibles.
    const JSON = await dataFetch(VALORACION_API, action, form);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (JSON.status) {
        // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
        JSON.dataset.forEach(row => {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            TBODY_ROWS.innerHTML += `
                <tr>
                    <td>${row.calificacion_producto}</td>
                    <td>${row.fecha_comentario}</td>
                    <td>${row.idcliente}</td>
                    <td>${row.titulo}</td>
                    <td>${row.resenia}</td>
                    <td>
                    <a onclick="openUpdate(${row.idvaloracion})" data-bs-toggle="modal" data-bs-target="#save-modal" class="btn btn-primary tooltipped" data-tooltip="Actualizar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-recycle" viewBox="0 0 16 16">
                    <path d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242-2.532-4.431zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24l2.552-4.467zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.498.498 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244l-1.716-3.004z"/>
                    </svg>
                    </a>
                </td> 
                </td> 
                </tr>
            `;
        });
        // Se inicializa el componente Material Box para que funcione el efecto Lightbox.
        // Se inicializa el componente Tooltip para que funcionen las sugerencias textuales.
        // Se muestra un mensaje de acuerdo con el resultado.
        RECORDS.textContent = JSON.message;
    } else {
        sweetAlert(4, JSON.exception, true);
    }
}

/*
*   Función para preparar el formulario al momento de insertar un registro.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
function openCreate() {
    // Se abre la caja de diálogo que contiene el formulario.
    // Se restauran los elementos del formulario.
    SAVE_FORM.reset();
    // Se asigna el título a la caja de diálogo.
    MODAL_TITLE.textContent = 'Crear valoracion';
    // Llamada a la función para llenar el select del formulario. Se encuentra en el archivo components.js
    fillSelect(DETALLEPED_API, 'readAll', 'detalle');

}

/*
*   Función asíncrona para preparar el formulario al momento de actualizar un registro.
*   Parámetros: id (identificador del registro seleccionado).
*   Retorno: ninguno.
*/
async function openUpdate(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const FORM = new FormData();
    FORM.append('id', id);
    // Petición para obtener los datos del registro solicitado.
    const JSON = await dataFetch(VALORACION_API, 'readOne', FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (JSON.status) {
        // Se abre la caja de diálogo que contiene el formulario.
        // Se restauran los elementos del formulario.
        SAVE_FORM.reset();
        // Se asigna el título para la caja de diálogo (modal).
        MODAL_TITLE.textContent = 'Actualizar valoracion';
        // Se inicializan los campos del formulario.
        document.getElementById('id').value = JSON.dataset.idproducto;
        fillSelect(DETALLEPED_API, 'readAll', 'detalle', JSON.dataset.iddetalle_pedido);
        document.getElementById('calificacion').value = JSON.dataset.calificacion_producto;
        document.getElementById('cliente').value = JSON.dataset.idcliente;
        document.getElementById('titulo').value = JSON.dataset.titulo;
        document.getElementById('resenia').value = JSON.dataset.resenia;
        document.getElementById('fecha').value = JSON.dataset.fecha_comentario;
        // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
    } else {
        sweetAlert(2, JSON.exception, false);
    }
}
