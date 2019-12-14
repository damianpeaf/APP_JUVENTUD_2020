<?php

include './php/conexion.php';
include './php/validacionUsuario.php';

if ($userId != null && $userId != '') {

    $resultados1 = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM Usuario WHERE idUsuario = '" . $userId . "' "));
    $verificacion = $resultados1['idTipoUsuario'] == 1;

    if ($verificacion) {

        $ultimasNoticiasPublicadas = mysqli_query($cn, "SELECT * FROM post where idStatus = 1 order by idPost limit 6");
        $ultimasEventosPublicados = mysqli_query($cn, "SELECT * FROM evento where idStatus = 1 order by idEvento limit 6");
        
        $ultimasEventosSinRevisar = mysqli_query($cn, "SELECT * FROM evento where idStatus = 2 order by idEvento limit 15");       
        $ultimasNoticiasSinRevisar = mysqli_query($cn, "SELECT * FROM post where idStatus = 2 order by idPost limit 15");       

        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Tablero de funciones</title>

            <!-- Estilos -->
            <link rel="stylesheet" href="./css/estilosTablero.css">

        </head>

        <body>
            <header>
                <div></div>
                <div id="saludo"> Bienvenido <?php echo $resultados1['usuario'] ?></div>
                <div id="cerrar"><a href="./php/cerrarSesion.php">Cerrar sesión</a></div>
            </header>
            <main>
                <div class="acciones">
                    <div class="main-actions">
                        <div id="acciones-titulo">
                            <h2>Acciones</h2>
                        </div>
                        <div class="botones">
                            <button class="button" onclick="location.href='./ingresarNoticia.php';">Crear noticia</button>
                            <button onclick="location.href='./ingresarEvento.php';">Crear evento</button>
                        </div>
                    </div>
                    <div class="publicacion">
                        <div class="titulo">Últimas publicaciones</div>
                        <div class="publicacion-noticias">
                            <h3>Noticias</h3>
                            <div class="datos-publicacion">
                                <?php
                                        while ($res = mysqli_fetch_array($ultimasNoticiasPublicadas)) {

                                            $usuario = mysqli_fetch_array(mysqli_query($cn, " SELECT usuario from usuario Where idUsuario = '" . $res['idUsuario'] . "' "));
                                            $categoria = mysqli_fetch_array(mysqli_query($cn, " SELECT nombre from categoria Where idCategoria = '" . $res['idCategoria'] . "' "));

                                            echo "<p><span class='autor'>" . $usuario[0] . "</span> publicó para <span class='categoria'>" . $categoria[0] . "<a href='#'> VER </a></p>";
                                        }

                                        ?>
                            </div>
                            <a href="#">VER TODOS</a>
                        </div>
                        <div class="publicacion-eventos">
                            <h3>Eventos</h3>
                            <div class="datos-publicacion">
                                <?php
                                        while ($res2 = mysqli_fetch_array($ultimasEventosPublicados)) {

                                            $usuario = mysqli_fetch_array(mysqli_query($cn, " SELECT usuario from usuario Where idUsuario = '" . $res2['idUsuario'] . "' "));
                                            $categoria = mysqli_fetch_array(mysqli_query($cn, " SELECT nombre from categoria Where idCategoria = '" . $res2['idCategoria'] . "' "));

                                            echo "<p><span class='autor'>" . $usuario[0] . "</span> publicó para <span class='categoria'>" . $categoria[0] . "<a href='#'> VER </a></p>";
                                        }

                                ?>
                            </div>
                            <a href="#">VER TODOS</a>
                        </div>
                    </div>
                </div>
                </div>

                <?php 

                    $eventosSinRevisar = mysqli_num_rows(mysqli_query($cn, "SELECT * FROM evento where idStatus = 2"));
                    $noticiasSinRevisar = mysqli_num_rows(mysqli_query($cn, "SELECT * FROM post where idStatus = 2"));

                ?>

                <div class="revision">
                    <div class="revision-noticias">
                        <div class="titulo">Hay <?php echo $noticiasSinRevisar; ?> noticias sin revisar</div>
                        <div class="datos-publicacion">
                                <?php
                                        while ($res2 = mysqli_fetch_array($ultimasNoticiasSinRevisar)) {

                                            $usuario = mysqli_fetch_array(mysqli_query($cn, " SELECT usuario from usuario Where idUsuario = '" . $res2['idUsuario'] . "' "));
                                            $categoria = mysqli_fetch_array(mysqli_query($cn, " SELECT nombre from categoria Where idCategoria = '" . $res2['idCategoria'] . "' "));

                                            $idPost = $res2['idPost'];
                                                                                        
                                            echo "<p><span class='autor'>" . $usuario[0] . "</span> publicó para <span class='categoria'>" . $categoria[0] . "<a href='revisar.php?idPost=".$idPost."'> VER </a></p>";

                                        }

                                ?>
                            </div>
                            <a href="#">VER TODOS</a>
                        </div>

                        <div class="revision-eventos">
                        <div class="titulo">Hay <?php echo $eventosSinRevisar; ?> eventos sin revisar</div>
                        <div class="datos-publicacion">
                                <?php
                                        while ($res2 = mysqli_fetch_array($ultimasEventosSinRevisar)) {

                                            $usuario = mysqli_fetch_array(mysqli_query($cn, " SELECT usuario from usuario Where idUsuario = '" . $res2['idUsuario'] . "' "));
                                            $categoria = mysqli_fetch_array(mysqli_query($cn, " SELECT nombre from categoria Where idCategoria = '" . $res2['idCategoria'] . "' "));

                                            $idEvento = $res2['idEvento'];

                                            echo "<p><span class='autor'>" . $usuario[0] . "</span> publicó para <span class='categoria'>" . $categoria[0] . "<a href='revisar.php?idEvento=".$idEvento."'> VER </a></p>";
                                        }

                                ?>
                            </div>
                            <a href="#">VER TODOS</a>
                        </div>

                    </div>
                    
                    </div>
                </div>
            </main>
        </body>

        </html>

<?php

    }
}

?>