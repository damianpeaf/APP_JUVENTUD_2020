<?php
require_once './php/functions.php';
require_once './php/conexion.php';

$dir = getURL(getcwd());
$page = (isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p'] > 0) ? $_GET['p'] : 1;

$url = "http://localhost/{$dir}/api/posts.php"; //NOTE Tenemos que cambiar esto cuando usemos ya el host
$posts = false;
$mensaje = false;
$posts = apiCall("{$url}?p={$page}", "GET");
$mensaje = (is_string($posts)) ? $posts : false;

?>
<!DOCTYPE html>
<html lang="es">

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
    <link rel="stylesheet" href="./css/librerias/bootstrap4/bootstrap.min.css">

    <!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>

    <!-- Full calendar 3.8.2 -->
    <script src="js/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <script src="js/es.js"></script>

    <!-- Bootsrap modal -->
    <script src="./js/librerias/popper.min.js"></script>
    <script src="./js/librerias/boostrap 4/bootstrap.min.js"></script>

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
        $(window).on('load', function() {
            $('.loader').delay(20).fadeOut(
                'slow'); //Pienso que deberia ser un poco menos el tiempo que se muestre esto
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
            <img src="./img/desktop/logo.png" onclick="location.href='./index.php';"><span id="logo-nombre" onclick="location.href='./index.php';">PeriódicoDB</span>
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
            <div><span>Religión</span></div>
            <div><span>Deporte</span></div>
            <div><span>Ciencia</span></div>
            <div><span>Arte</span></div>
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
            <div><span>Religión</span></div>
            <div><span>Deporte</span></div>
            <div><span>Ciencia</span></div>
            <div><span>Arte</span></div>
        </div>
    </div>

    <!-- Fin  -->

    <main class="contenedorCalendario">
        <div class="inclusion-calendario" id="calendario"></div>
    </main>

    <main class="contenedorNoticias" id="noticias">
        <span class="ir-arriba icon-arrow-up2"></span>
        <div class="header-noticias">
            <a href="?p=<?= $page - 1 ?>#noticias" class="button">
                < <a name="noticias">
                    <h1>Noticias</h1>
            </a>
            <a href="?p=<?= $page + 1 ?>#noticias" class="button">></a>
        </div>
        <?php if ($mensaje) : ?>
            <div class="noticias">
                <h3><?= $mensaje ?></h3>
            </div>
        <?php elseif ($posts) : ?>
            <div class="noticias">
                <?php foreach ($posts as $post) : ?>
                    <?php $datosCategoria = mysqli_fetch_array(mysqli_query($cn, "SELECT nombre, color from Categoria where idCategoria = ". $post->idCategoria ."")); ?>

                    <!-- Parte a modificar -->

                    <div class="noticia">
                        <div class="datos">
                            <div class="encabezado-noticia">
                                <div class="titulo-noticia"> <?= $post->titulo ?> </div>
                                <div class="btn-ver">
                                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#info-noticia<?php echo $post->idPost ?>" aria-expanded="false" aria-controls="collapseExample">
                                        Ver Noticia
                                    </button>
                                </div>
                            </div>
                            <div class="collapse" id="info-noticia<?php echo $post->idPost ?>">
                                <div class="card card-body post-content">
                <p style=" background: <?php echo $datosCategoria['color']; ?> " class="categoria"><span style="font-weight: bold;">Categoria: </span><span><?php  echo $datosCategoria["nombre"]; ?></span></p>
                                    <div class="post-description"><?php echo $post->contenido; ?></div>
                                    <div class="adjuntos">
                                        <?php

                                        // echo $post->adjuntos;

                                        if ($post->adjuntos != null) {
                                            
                                            echo "<br><p style='font-weight: bold;'> Archivos adjuntos: </p>";
                                            
                                            $arrayAdjuntos = json_decode($post->adjuntos);

                                            foreach ($arrayAdjuntos as $archivo) {


                                                $path = "./docs/" . $archivo;
                                                $datosDelPath = pathinfo($path);

                                                if ($datosDelPath['extension'] == 'jpg' || $datosDelPath['extension'] == 'jpeg' || $datosDelPath['extension'] == 'png') {

                                                    echo "<p><img src='" . $path . "' style=' max-width: 100%; '/></p>";
                                                } else {
                                                    echo "<p><a  href='" . $path . "' download='" . $datosDelPath['filename'] . "'><img class='iconoDescargar' src='./img/desktop/iconoDescargar.png' >" . $datosDelPath['filename'] . "</a></p>";
                                                }
                                            }
                                        } else {
                                            echo "<p> No hay archivos adjuntos </p>";
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                <?php endforeach ?>
            </div>
        <?php endif ?>
        <!-- <button id="BackArrow"><</button>
        <button id="NextArrow">></button> -->
        <!-- NOTE: Esto funciona, pero recarga toda la página -->

    </main>

    <footer class="contenedorFooter">
        <div class="copyright">
            <h6 id="footer-text">©Copyright Juventud 2020</h6>
        </div>
    </footer>
    <script src="./js/calendar.js"></script>
    <!-- <script src="">
        function AjaxCall(pag) {
            return function(e){
                $.ajax(
                {
                    url: `./api/posts.php?p=${pag}`,
                    type: "GET",
                    success: (data)=>{
                        alert("SUCCESFULL");
                        console.log(JSON.parse(data));
                    },
                    error: (err)=>{
                        console.error(err);
                    }
                }
                );
            }
        }

        document.getElementById("BackArrow")
        // .onclick = AjaxCall(<?= $page - 1 ?>);
        .onclick = function (e){
            console.log(e);
        };

        document.getElementById("NextArrow").onclick = AjaxCall(<?= $page + 1 ?>);
    </script> -->
    <script src="./js/resize_vh.js"></script>

    <!-- Modal -->
    <div class=" modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                        <p id="des" style="color: black !important; overflow-x: hidden !important; "></p>
                    </div>

                    <div class="horario">
                        <h5>Inicio</h5>
                        <span>Fecha: <span id="diaI"></span></span><span> Hora: <span id="horaI"></span></span>

                        <br><br>

                        <h5>Final</h5>
                        <span>Fecha: <span id="diaF"></span></span><span> Hora: <span id="horaF"></span></span>
                    </div>

                    <br>

                    <div class="descargas">
                        <h5>Archivos Adjuntos</h5>
                        <div class="adjuntos"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>