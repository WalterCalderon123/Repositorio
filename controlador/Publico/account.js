/*
*   Controlador es de uso general en las páginas web del sitio público.
*   Sirve para manejar las plantillas del encabezado y pie del documento.
*/

// Constante para completar la ruta de la API.
const USER_API = 'business/public/cliente.php';
// Constantes para establecer las etiquetas de encabezado y pie de la página web.
const HEADER = document.querySelector('header');

// Método manejador de eventos para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', async () => {
  // Petición para obtener en nombre del usuario que ha iniciado sesión.
  const JSON = await dataFetch(USER_API, 'getUser');
  // Se comprueba si el usuario está autenticado para establecer el encabezado respectivo.
  if (JSON.session) {
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
            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
            <li><a a onclick="logOut()" class="dropdown-item">Salir</a></li>
          </ul>
          </div>
          <div class="carrito mb-1 mr-1">
          <a href="carrito_clientes.html" class="text-dark">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
          <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg>               
         </a>
          </div>
    
        </div>
    
      </div>
    
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid d-flex flex-column align-items-center justify-content-between">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="">Categorias</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="">Destacados</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  Generos
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="">Hombre</a></li>
                  <li><a class="dropdown-item" href="">Mujer</a></li>
                  <li><a class="dropdown-item" href="">Niños</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="ofertas.html">Ofertas</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
        `;
  } else {
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
            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
            <li><a href="login.html" class="dropdown-item">Iniciar sesion</a></li>      
            <li><a a onclick="logOut()" class="dropdown-item">Salir</a></li>
          </ul>
          </div>
          <div class="carrito">
          <a href="carrito_clientes.html" class="text-dark">
           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
           <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
           </svg>               
          </a>
          </div>
    
        </div>
    
      </div>
    
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid d-flex flex-column align-items-center justify-content-between">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="">Categorias</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="">Destacados</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  Generos
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="">Hombre</a></li>
                  <li><a class="dropdown-item" href="">Mujer</a></li>
                  <li><a class="dropdown-item" href="">Niños</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="ofertas.html">Ofertas</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>    
        `;
  }

  /*
  // Se define el componente Parallax.
  const PARALLAX = `
          <div class="parallax-container">
              <div class="parallax">
                  <img id="parallax" src='../../resources/img/parallax/'>
              </div>
          </div>
      `;
  // Se agrega el componente Parallax antes de la etiqueta footer.
  FOOTER.insertAdjacentHTML('beforebegin', PARALLAX);
  // Se establece el pie del encabezado.
  FOOTER.innerHTML = `
      <div class="container">
          <div class="row">
              <div class="col s12 m6 l6">
                  <h5 class="white-text">Nosotros</h5>
                  <p>
                      <blockquote>
                          <a href="#" class="white-text"><b>Misión</b></a>
                          <span>|</span>
                          <a href="#" class="white-text"><b>Visión</b></a>
                          <span>|</span>
                          <a href="#" class="white-text"><b>Valores</b></a>
                      </blockquote>
                      <blockquote>
                          <a href="#" class="white-text"><b>Términos y condiciones</b></a>
                      </blockquote>
                  </p>
              </div>
              <div class="col s12 m6 l6">
                  <h5 class="white-text">Contáctanos</h5>
                  <p>
                      <blockquote>
                          <a href="https://www.facebook.com/" class="white-text" target="_blank"><b>facebook</b></a>
                          <span>|</span>
                          <a href="https://www.instagram.com/" class="white-text" target="_blank"><b>instagram</b></a>
                          <span>|</span>
                          <a href="https://www.youtube.com/" class="white-text" target="_blank"><b>youtube</b></a>
                      </blockquote>
                      <blockquote>
                          <a href="mailto:dacasoft@outlook.com" class="white-text"><b>Correo electrónico</b></a>
                          <span>|</span>
                          <a href="https://api.whatsapp.com/" class="white-text" target="_blank"><b>WhatsApp</b></a>
                      </blockquote>
                  </p>
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
  // Se inicializa el componente Sidenav para que funcione la navegación lateral.
  M.Sidenav.init(document.querySelectorAll('.sidenav'));
  // Se declara e inicializa un arreglo con los nombres de las imagenes que se pueden utilizar en el efecto parallax.
  const IMAGES = ['img01.jpg', 'img02.jpg', 'img03.jpg', 'img04.jpg', 'img05.jpg'];
  // Se declara e inicializa una constante para obtener un elemento del arreglo de forma aleatoria.
  const ELEMENT = Math.floor(Math.random() * IMAGES.length);
  // Se asigna la imagen a la etiqueta img por medio del atributo src.
  document.getElementById('parallax').src += IMAGES[ELEMENT];
  // Se inicializa el efecto Parallax.
  M.Parallax.init(document.querySelectorAll('.parallax'));
  */
});