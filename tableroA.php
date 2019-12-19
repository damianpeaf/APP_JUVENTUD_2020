<?php

include './php/conexion.php';
include './php/validacionUsuario.php';

if ($userId != null && $userId != '') {

    $resultados1 = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM Usuario WHERE idUsuario = '" . $userId . "' "));
    $verificacion = $resultados1['idTipoUsuario'] == 1;

    if ($verificacion) {

        $ultimasNoticiasPublicadas = mysqli_query($cn, "SELECT * FROM post where idStatus = 1 order by idPost DESC limit 6");
        $ultimasEventosPublicados = mysqli_query($cn, "SELECT * FROM evento where idStatus = 1 order by idEvento DESC limit 6");

        $ultimasEventosSinRevisar = mysqli_query($cn, "SELECT * FROM evento where idStatus = 2 order by idEvento DESC limit 15");
        $ultimasNoticiasSinRevisar = mysqli_query($cn, "SELECT * FROM post where idStatus = 2 order by idPost DESC limit 15");

        $stmt = mysqli_prepare($cn, "SELECT * FROM notificacion where idCreador = ? and leido = false");

        mysqli_stmt_bind_param($stmt, 'i', $userId);

        if (mysqli_execute($stmt)) {

            $resultadoNotificaciones = mysqli_stmt_get_result($stmt);

            $numeroNotificaciones = mysqli_num_rows($resultadoNotificaciones);

        }

        ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tablero de funciones</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Estilos -->
    <link rel="stylesheet" href="./css/estilosTablero.css">

    <!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>

</head>

<body>

    <header>
        <div id="notificaciones">
            <details id="detalles-notificaciones" ontoggle="leido()">
                <summary><i class="fa fa-bell" style="font-size:24px"> </i> Notificaciones: <span class="numNoti">
                        <?php echo $numeroNotificaciones; ?> </span></summary>

                <p></p>

                <?php

        while ($datosNotificaciones = mysqli_fetch_array($resultadoNotificaciones)) {

            $idPost = $datosNotificaciones['idPost'] ?? null;
            $idEvento = $datosNotificaciones['idEvento'] ?? null;

            if ($idPost != null) {
                $datosPublicacion = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM post where idPost = $idPost"));
            } else if ($idEvento != null) {
                $datosPublicacion = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM evento where idEvento = $idEvento"));
            }

            $datosAdmin = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM usuario where idUsuario = '" . $datosNotificaciones['idAdmin'] . "' "));
            $nombreAdmin = $datosAdmin['usuario'];
            $emailAdmin = $datosAdmin['email'];

            echo "<br><p> Sobre la publicación: <span class='amarillo'>\"" . $datosPublicacion['titulo'] . "\"</span>. Fue rechazada por: <span class='azul'>" . $nombreAdmin . "</span>. Puedes comunicarte a: <span class='azul'> " . $emailAdmin . "</span></p>";
            echo "<details class='razones'><summary>Por la siguiente razón</summary><br>\"" . $datosNotificaciones['mensaje'] . "\"</details><hr><br>";

        }

        ?>

            </details>
        </div>
        <div id="saludo"> Bienvenido <?php echo $resultados1['usuario'] ?></div>
        <div id="cerrar"><a href="./php/cerrarSesion.php">Cerrar sesión</a></div>
    </header>

    <script>

    function leido() {

        document.querySelector('.numNoti').innerHTML = '0';

        $.ajax({

            data: {userId: "<?php echo $userId ?>"},
            url: './php/marcarLeido.php',
            type: 'POST',
            success: function(response) {
                console.log(response)
            },
            error: function() {
                console.log("error al marcar como leido")
            }
        });

    }
    </script>

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

            echo "<p><span class='autor'>" . $usuario[0] . "</span> publicó para <span class='categoria'>" . $categoria[0] . "<a href='revisar.php?idPost=" . $idPost . "'> Revisar </a></p>";

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

            echo "<p><span class='autor'>" . $usuario[0] . "</span> publicó para <span class='categoria'>" . $categoria[0] . "<a href='revisar.php?idEvento=" . $idEvento . "'> Revisar </a></p>";
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