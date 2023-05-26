// Constantes para completar las rutas de la API.
const VALORACION_API = 'business/public/valoraciones.php';
const DETALLEPED_API = 'business/dashboard/detalleprod.php';


// Constante para establecer el contenedor de categorías.
const VALORACION = document.getElementById('valoraciones');

// Constante tipo objeto para establecer las opciones del componente Slider.
const OPTIONS = {
    height: 300
}
// Método manejador de eventos para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', async () => {
    // Petición para obtener las valoraciones disponibles.
    fillValoracion();
});

async function fillValoracion() {

    const JSON = await dataFetch(VALORACION_API, 'readAll');

    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (JSON.status) {
        // Se inicializa el contenedor de categorías.
        VALORACION.innerHTML = '';
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        JSON.dataset.forEach(row => {
            // Se establece la página web de destino con los parámetros.
            url = `producto_info.html?id=${row.idvaloracion}`;
            // Se crean y concatenan las tarjetas con los datos de cada categoría.
            VALORACION.innerHTML += /*
                <div class="col s12 m6 l4">
                    <div class="card hoverable">
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">
                                <b>${row.titulo}</b>
                                <i class="material-icons right tooltipped" data-tooltip="titulo">more_vert</i>
                            </span>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">
                                <b>${row.calificacion_producto}</b>
                            </span>
                            <p>${row.idcliente}</p>
                            <p>${row.resenia}</p>
                            <p>${row.fecha_comentario}</p>
                        </div>
                    </div>
                </div>
                */               
                `
                <a href="${url}" class="text-dark" data-producto="ID-de-valoracion">
                <div class="card" style="width: 18rem;">
                  <div class="card-body">
                    <h4 id="titulo" class="text-secondary">${row.titulo}</h4>
                    <h5 id="cliente" class="text-secondary">Hecha por: ${row.nombre_cliente}</h5>
                    <br>
                    <h5 id="calificacion" class="text-secondary">Calificacion: ${row.calificacion_producto}</h5>
                    <br>
                    <h5 id="resenia" class="text-secondary">${row.resenia}</h5>
                    <br>
                    <h6 id="fecha" class="text-secondary">Subido el: ${row.fecha_comentario}</h6>
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
        document.getElementById('cliente').value = JSON.dataset.nombre_cliente;
        document.getElementById('titulo').value = JSON.dataset.titulo;
        document.getElementById('resenia').value = JSON.dataset.resenia;
        document.getElementById('fecha').value = JSON.dataset.fecha_comentario;
        if (JSON.dataset.estado_valoracion) {
            document.getElementById('estado').checked = true;
        } else {
            document.getElementById('estado').checked = false;
        }
        // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
    } else {
        sweetAlert(2, JSON.exception, false);
    }
}

