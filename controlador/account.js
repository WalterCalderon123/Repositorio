/*
*   Controlador de uso general en las páginas web del sitio privado.
*   Sirve para manejar las plantillas del encabezado y pie del documento.
*/

// Constante para completar la ruta de la API.
const USER_API = 'business/dashboard/usuario.php';
// Constantes para establecer las etiquetas de encabezado y pie de la página web.
const HEADER = document.querySelector('header');
const FOOTER = document.querySelector('footer');

// Método manejador de eventos para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    // Se verifica si el usuario está autenticado, de lo contrario se envía a iniciar sesión.
    if (JSON.session) {
        // Se comprueba si existe un alias definido para el usuario, de lo contrario se muestra un mensaje con la excepción.
        if (JSON.status) {
            HEADER.innerHTML = `
            <div class="navbar">
            <div class="logo">
              <img src="Imagenes/Zeladinha Sneakers Logo.jpg" alt="Logo" width="60" height="54"
                class="d-inline-block align-text-top">
            </div>
            <div class="buscar">
              <form>
                <input type="text" placeholder="">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
              </form>
            </div>
        
            <div class="icons">
              <div class="user">
                <i class="fa-solid fa-user"></i>
              </div>
              <div class="carrito">
                <i class="fa-solid fa-cart-shopping"></i>
              </div>
        
            </div>
        
          </div>
        
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
            <div class="container-fluid d-flex flex-column align-items-center justify-content-between">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Productos
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                      <li><a class="dropdown-item" href="#">Separated link</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Pedidos
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                      <li><a class="dropdown-item" href="#">Separated link</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Tallas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Marcas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Usuarios</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
            `;
            FOOTER.innerHTML = `
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6">
                            <h6 class="white-text">Dashboard</h6>
                            <a class="white-text" href="mailto:dacasoft@outlook.com">
                                <i class="material-icons left">email</i>Ayuda
                            </a>
                        </div>
                        <div class="col s12 m6">
                            <h6 class="white-text">Enlaces</h6>
                            <a class="white-text" href="../public/" target="_blank">
                                <i class="material-icons left">store</i>Sitio público
                            </a>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="container">
                        <span>© 2018-2023 Copyright CoffeeShop. Todos los derechos reservados.</span>
                        <span class="right">Diseñado con
                            <a href="http://materializecss.com/" target="_blank">
                                <img src="../../resources/img/materialize.png" height="20" style="vertical-align:middle" alt="Materialize">
                            </a>
                        </span>
                    </div>
                </div>
            `;
            // Se inicializa el componente Dropdown para que funcione la lista desplegable en los menús.
            M.Dropdown.init(document.querySelectorAll('.dropdown-trigger'));
            // Se inicializa el componente Sidenav para que funcione la navegación lateral.
            M.Sidenav.init(document.querySelectorAll('.sidenav'));
        } else {
            sweetAlert(3, JSON.exception, false, 'index.html');
        }
    } else {
        // Se comprueba si la página web es la principal, de lo contrario se direcciona a iniciar sesión.
        if (location.pathname == '/Repositorio/Repositorio/sitio_privado/index.html') {
            HEADER.innerHTML = `
                <div class="navbar-fixed">
                    <nav>
                        <div class="nav-wrapper center-align">
                            <a href="index.html" class="brand-logo"><i class="material-icons">dashboard</i></a>
                        </div>
                    </nav>
                </div>
            `;
            FOOTER.innerHTML = `
                <div class="container">
                    <div class="row">
                        <b>Dashboard de CoffeeShop</b>
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="container">
                        <span>© 2018-2023 Copyright CoffeeShop. Todos los derechos reservados.</span>
                        <span class="right">Diseñado con
                            <a href="http://materializecss.com/" target="_blank">
                                <img src="../../resources/img/materialize.png" height="20" style="vertical-align:middle" alt="Materialize">
                            </a>
                        </span>
                    </div>
                </div>
            `;
            // Se inicializa el componente Tooltip para que funcionen las sugerencias textuales.
            M.Tooltip.init(document.querySelectorAll('.tooltipped'));
        } else {
            location.href = 'index.html';
        }
    }
});