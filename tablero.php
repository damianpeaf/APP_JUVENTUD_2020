<?php

session_start();
include './php/conexion.php';
$userId = $_SESSION['userId'] ?? null;

if ($userId == null || $userId == '') {
    echo "<script>
        alert('NO TIENE AUTORIZACION');
        window.location.href='ingresar.php';
        </script>";
}

$resultados = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM Usuario WHERE idUsuario = '" . $userId . "' "));

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
        <div id="saludo"> Bienvenido <?php echo $resultados['usuario'] ?></div>
        <div id="cerrar"><a href="./php/cerrarSesion.php">Cerrar sesión</a></div>
    </header>
    <main>
        <div class="acciones">
            <div class="main-actions">
                <div id="acciones-titulo">
                    <h2>Acciones</h2>
                </div>
                <div class="botones">
                    <button onclick="location.href='#';" >Crear noticia</button>
                    <button onclick="location.href='#';" >Crear evento</button>
                </div>
            </div>
        </div>
        <div class="revision">

        </div>
    </main>
</body>

</html>