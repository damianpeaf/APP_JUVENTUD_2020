<?php
require_once './php/functions.php';

$dir = getURL(getcwd());
$page = (isset($_GET['p'])&&is_numeric($_GET['p']))? $_GET['p'] : 1;

$url = "http://localhost{$dir}/api/posts.php?p={$page}";
// var_dump($url);

$ch = curl_init($url);//NOTE Tenemos que cambiar esto cuando usemos ya el host
$options = array(
    CURLOPT_RETURNTRANSFER => true,         // return web page
    CURLOPT_HEADER         => false,        // don't return headers
    CURLOPT_FOLLOWLOCATION => true,         // follow redirects
    CURLOPT_ENCODING       => "",           // handle all encodings
    CURLOPT_USERAGENT      => "ELROHIRGT",     // who am i
    CURLOPT_AUTOREFERER    => true,         // set referer on redirect
    CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
    CURLOPT_TIMEOUT        => 120,          // timeout on response
    CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
    CURLOPT_POST            => 0,            // i am sending post data
    CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
    CURLOPT_SSL_VERIFYPEER => false,        //
    CURLOPT_VERBOSE        => 1                //
);
curl_setopt_array($ch, $options);
$content = curl_exec($ch);
$posts = null;
$posts = json_decode($content);
// if ($posts) {
//     $mensaje = "Un error ocurrió al obtener los posts.";
// }
// var_dump($posts);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PeriódicoDB</title>

    <!-- Estilos -->

    <!-- Loader -->

    <link rel="stylesheet" href="./css/librerias/loaders.min.css">
    <link rel="stylesheet" href="./css/librerias/loader-custom.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>

    <!-- Full calendar 3.8.2 -->
    <script src="js/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <script src="js/es.js"></script>

    <!-- Bootsrap modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <!-- basicos -->
    <link rel="stylesheet" href="css/estilosBase.css">

    <!-- Icono Flecha -->
    <link rel="stylesheet" href="./fonts/css/fonts.css">

    <!-- Modal -->
    <link rel="stylesheet" href="./css/estilosModal.css">

</head>

<body>

    <!-- LOADER code -->

    <script>
        $(window).on('load', function () {
            $('.loader').delay(1000).fadeOut('slow');
        });
    </script>

    <div class="loader">
        <div class="loader-inner pacman">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div><span class="tooltip">
            <p></p>
        </span>
    </div>

    <header class="contenedorHeader">
        <div class="menu-item" id="logo">
            <img src="./img/desktop/logo.png" onclick="location.href='./index.html';"><span id="logo-nombre"
                onclick="location.href='./index.html';">PeriódicoDB</span>
        </div>
        <div class="menu-item" id="redes">
            <nav class="redes-container">

                <a href="https://www.instagram.com/movjuveoficial/?hl=es">
                    <img src="./img/desktop/instagram.png">
                </a>
                <!-- Twitter -->
                <a href="https://twitter.com/vidacolegiodb?lang=es">
                    <img src="./img/desktop/twitter.png">
                </a>
                <!-- Facebook -->
                <a href="https://www.facebook.com/movjuveoficial/">
                    <img src="./img/desktop/facebook.png">
                </a>
            </nav>
        </div>
        <div class="menu-item" id="categorias">
            <div><a href="">Religión</a></div>
            <div><a href="">Deporte</a></div>
            <div><a href="">Ciencia</a></div>
            <div><a href="">Arte</a></div>
        </div>
        <div class="menu-item" id="logoJuventud"><img src="./img/desktop/logo2.png"></div>
    </header>

    <!-- Menu para telefono Escondido -->

    <!-- Parte arriba -->

    <div class="phone-header">
        <div class="menu-item" id="logo">
            <img src="./img/desktop/logo.png">
        </div>
        <div class="menu-item" id="redes">
            <nav class="redes-container">

                <a href="https://www.instagram.com/movjuveoficial/?hl=es">
                    <img src="./img/desktop/instagram.png">
                </a>
                <!-- Twitter -->
                <a href="https://twitter.com/vidacolegiodb?lang=es">
                    <img src="./img/desktop/twitter.png">
                </a>
                <!-- Facebook -->
                <a href="https://www.facebook.com/movjuveoficial/">
                    <img src="./img/desktop/facebook.png">
                </a>
            </nav>
        </div>
        <div class="menu-item" id="logoJuventud"><img src="./img/desktop/logo2.png"></div>
    </div>
    <!-- Parte abajo -->
    <div class="phone-footer">
        <div class="categorias">
            <div><a href="">Religión</a></div>
            <div><a href="">Deporte</a></div>
            <div><a href="">Ciencia</a></div>
            <div><a href="">Arte</a></div>
        </div>
    </div>

    <!-- Fin  -->

    <main class="contenedorCalendario">
        <div class="inclusion-calendario" id="calendario"></div>
    </main>

    <main class="contenedorNoticias">
        <span class="ir-arriba icon-arrow-up2"></span>
        <div class="header-noticias">
            <h1>Noticias</h1>
        </div>

        <?php if ($posts): ?>
            <?php foreach($posts as $post): ?>
                <div class="noticia">
                    <div class="imagen-noticia"><img src=""></div>
                    <div class="informacion-noticia">
                        <div class="titulo-noticia"><?=$post->titulo?></div>
                        <div class="contenido-noticia"><?=substr($post->contenido, 0, 500)?></div>
                        <p><a href=''> Ver más. </a></p>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
        <!-- TODO: Poder cambiar de página -->
        <!-- <div class="navNoticias">
            <?php //for($i=$page;$i<=$page+$maximoPorPagina; $i++): ?>

            <?php //endfor ?>
        </div> -->
    </main>

    <footer class="contenedorFooter">
        <div class="copyright">
            <h1>COPYRIGHT</h1>
        </div>
    </footer>
    <script src="./js/calendar.js"></script>

    <script src="./js/resize_vh.js"></script>

<!-- Modal -->
<div class=" modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <div class="datos">
                    <h5>Descripción</h5>
                    <p id="des"></p>
                </div>

                <div class="horario">
                    <h5>Inicio</h5>
                    <span>Fecha: <span id="diaI"></span></span><span>  Hora: <span id="horaI"></span></span>

                    <br><br>

                    <h5>Final</h5>
                    <span>Fecha: <span id="diaF"></span></span><span>  Hora: <span id="horaF"></span></span>
                </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    
</body>

</html>