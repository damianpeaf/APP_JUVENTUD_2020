<?php

session_start();
include './php/conexion.php';
$userId = $_SESSION['userId'] ?? null;

if ($userId == null || $userId == '') {
    echo "<script>
        alert('NO TIENE AUTORIZACION');
        window.location.href='ingresar.php';
        </script>";
}else{

    $resultados1 = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM Usuario WHERE idUsuario = '" . $userId . "' "));
    $verificacion = $resultados1['idTipoUsuario'] == 1;

    if ($verificacion) {


    $ultimasNoticiasPublicadas = mysqli_query($cn, "SELECT * FROM post where idStatus = 1 order by idPost limit 3");

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
                    <button class="button" onclick="location.href='#';" >Crear noticia</button>
                    <button onclick="location.href='#';" >Crear evento</button>
                </div>
            </div>
            <div class="publicacion">
                <div class="titulo">Últimas publicaciones</div>
                <div class="publicacion-noticias">
                    <h3>Noticias</h3>
                    <?php 
                
                        while ($res = mysqli_fetch_array($ultimasNoticiasPublicadas)) {

                            $usuario = mysqli_fetch_array(mysqli_query($cn, " SELECT usuario from usuario Where idUsuario = '".$res['idUsuario']."' "));
                            $categoria = mysqli_fetch_array(mysqli_query($cn, " SELECT nombre from categoria Where idCategoria = '".$res['idCategoria']."' "));
                            $contenidoRecortado = substr($res['contenido'], 0, 25);
                            
                            echo "<p><span class='autor'>". $usuario[0] . "</span> publicó para <span class='categoria'>" . $categoria[0] . "</span> <span class='contenido'>" . $contenidoRecortado ." </span><a href='#'> VER </a></p>";

                        }
                     
                    ?>
                </div>
                <div class="publicacion-eventos">
                    <h3>Eventos</h3>
                </div>
            </div>
        </div>
        </div>
        <div class="revision">
            <div class="revision-noticias"></div>
            <div class="revision-eventos"></div>
        </div>
    </main>
</body>
</html>

<?php 
 
    }
}

?>