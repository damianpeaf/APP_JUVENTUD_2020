<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ver</title>

    <link rel="stylesheet" href="./css/estilosRevision.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="./css/librerias/bootstrap4/bootstrap.min.css">

    <!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>


    <!-- Bootsrap modal -->
    <script src="./js/librerias/popper.min.js"></script>
    <script src="./js/librerias/boostrap 4/bootstrap.min.js"></script>


</head>

<body>

    <?php

    // if (setlocale(LC_TIME, "es_GT.UTF-8")){
    //     var_dump(localeconv());
    // }else {echo "<h2>ERROR</h2>";var_dump(setlocale(LC_ALL, 0));}

    require_once './php/conexion.php';
    require_once './php/validacionUsuario.php';


    if ($userId != null && $userId != '') {

        if ($_SESSION['idTipoUsuario'] == 1 || $_SESSION['idTipoUsuario'] == 2) {

            if (isset($_GET["idEvento"])) {

                $idEvento = $_GET["idEvento"];

                $stmt = mysqli_prepare($cn, "SELECT * FROM evento where idEvento = ? and idStatus = '1' ");

                mysqli_stmt_bind_param($stmt, 'i', $idEvento);

                if (mysqli_stmt_execute($stmt)) {

                    $result = mysqli_stmt_get_result($stmt);

                }

                if (mysqli_num_rows($result) > 0) {

                    // CODIGO DE MOSTRAR Y VERFIICAR

                    $datosPost = mysqli_fetch_array($result);

                    $query = mysqli_query($cn, "SELECT usuario, email from usuario where idUsuario = '" . $datosPost['idUsuario'] . "' ");
                    $datosAutor = mysqli_fetch_array($query);

                    $datosCategoria = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM categoria where idCategoria = '" . $datosPost['idCategoria'] . "' "))

    ?>

    <br>
    <h2> <button type="button" class="btn btn-dark" onclick="location.href='./tablero.php'">Volver</button>Ver evento</h2>

    <table class="table table-dark">
        <tr>
            <td class="titulo">Nombre del Autor</td>
            <td><?php echo $datosAutor['usuario'] ?></td>
        </tr>
        <tr>
            <td class="titulo">Email del Autor</td>
            <td><?php echo $datosAutor['email'] ?></td>
        </tr>
        <tr>
            <td class="titulo">Fecha de Publicacion</td>
            <td><?php echo strftime("%c", strtotime($datosPost['fechaDePublicacion'])); ?></td>
        </tr>
        <tr>
            <td class="titulo">Fecha de Incio</td>
            <td><?php echo strftime("%c", strtotime($datosPost['inicia'])); ?></td>
        </tr>
        <tr>
            <td class="titulo">Fecha de Finalización</td>
            <td><?php echo strftime("%c", strtotime($datosPost['termina'])); ?></td>
        </tr>
        <tr>
            <td class="titulo">Categoria</td>
            <td><?php echo $datosCategoria['nombre']; ?></td>
        </tr>
        <tr>
            <td class="titulo">Título</td>
            <td><?php echo $datosPost['titulo'] ?></td>
        </tr>
        <tr class="descripcion" class="">
            <td class="titulo">Descripcion</td>
            <td><?php echo $datosPost['descripcion'] ?></td>
        </tr>
        <tr>
            <td colspan="2" class="adjuntos titulo">Adjuntos</td>
        </tr>
        <?php

                if ($datosPost['adjuntos'] != null) {

                    $arrayAdjuntos = json_decode($datosPost['adjuntos']);

                    foreach ($arrayAdjuntos as $archivo) {

                        $path = "./docs/" . $archivo;
                        $datosDelPath = pathinfo($path);

                        if ($datosDelPath['extension'] == 'jpg' || $datosDelPath['extension'] == 'jpeg' || $datosDelPath['extension'] == 'png') {

                            echo "<tr class='adjuntos'><td colspan='2'><img src='" . $path . "' /></td></tr>";

                        } else {
                            echo "<tr class='adjuntos' ><td colspan='2'><a  href=" . $path . " download=" . $datosDelPath['filename'] . "><img class='iconoDescargar' src='./img/desktop/iconoDescargar.png' >" . $datosDelPath['filename'] . "</a></td></tr>";
                        }

                    }
                } else {
                    echo "<tr class='adjuntos'><td colspan='2'> No hay archivos adjuntos </td></tr>";
                }

                ?>
    </table>


    <?php

            } else {

                echo "<script> alert('Hubo un error, posiblemente este post ya ha sido revisado o no existe');  window.location.href='tablero.php';</script>";
            }

            #FIN COD EVENTOS

        } elseif (isset($_GET["idPost"])) {

            $idPost = $_GET["idPost"];

            $stmt = mysqli_prepare($cn, "SELECT * FROM post where idPost = ? and idStatus = 1 ");

            mysqli_stmt_bind_param($stmt, 'i', $idPost);

            if (mysqli_stmt_execute($stmt)) {

                $result = mysqli_stmt_get_result($stmt);

            }

            if (mysqli_num_rows($result) > 0) {

                // CODIGO DE MOSTRAR Y VERFIICAR

                $datosPost = mysqli_fetch_array($result);

                $query = mysqli_query($cn, "SELECT usuario, email from usuario where idUsuario = '" . $datosPost['idUsuario'] . "' ");
                $datosAutor = mysqli_fetch_array($query);

                $datosCategoria = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM categoria where idCategoria = '" . $datosPost['idCategoria'] . "' "));

                ?>

    <br>
    <h2> <button type="button" class="btn btn-dark" onclick="location.href='./tablero.php'">Volver</button>Ver noticia</h2>

    <table class="table table-dark">
        <tr>
            <td class="titulo">Nombre del Autor</td>
            <td><?php echo $datosAutor['usuario'] ?></td>
        </tr>
        <tr>
            <td class="titulo">Email del Autor</td>
            <td><?php echo $datosAutor['email'] ?></td>
        </tr>
        <tr>
            <td class="titulo">Fecha de Publicacion</td>
            <td><?php echo strftime("%c", strtotime($datosPost['fechaDePublicacion'])); ?></td>
        </tr>
        <tr>
            <td class="titulo">Categoria</td>
            <td><?php echo $datosCategoria['nombre']; ?></td>
        </tr>
        <tr>
            <td class="titulo">Título</td>
            <td><?php echo $datosPost['titulo'] ?></td>
        </tr>
        <tr class="descripcion" class="">
            <td class="titulo">Contenido</td>
            <td><?php echo $datosPost['contenido'] ?></td>
        </tr>
        <tr>
            <td colspan="2" class="adjuntos titulo">Adjuntos</td>
        </tr>
        <?php

                if ($datosPost['adjuntos'] != null) {

                    $arrayAdjuntos = json_decode($datosPost['adjuntos']);

                    foreach ($arrayAdjuntos as $archivo) {

                        $path = "./docs/" . $archivo;
                        $datosDelPath = pathinfo($path);

                        if ($datosDelPath['extension'] == 'jpg' || $datosDelPath['extension'] == 'jpeg' || $datosDelPath['extension'] == 'png') {

                            echo "<tr class='adjuntos'><td colspan='2'><img src='" . $path . "' /></td></tr>";

                        } else {
                            echo "<tr class='adjuntos' ><td colspan='2'><a  href=" . $path . " download=" . $datosDelPath['filename'] . "><img class='iconoDescargar' src='./img/desktop/iconoDescargar.png' >" . $datosDelPath['filename'] . "</a></td></tr>";
                        }

                    }
                } else {
                    echo "<tr class='adjuntos'><td colspan='2'> No hay archivos adjuntos </td></tr>";
                }

                ?>
    </table>


    <?php

            } else {

                echo "<script> alert('Hubo un error, posiblemente este post NO ha sido revisado o no existe'); window.location.href='tablero.php'; </script>";
            }

        } else {
            echo "<script> alert('No Tiene autorización'); window.location.href='tablero.php';";
            exit();
        }

    } else {
        echo "<script> alert('No Tiene autorización'); window.location.href='tablero.php';";
    }
} else {
    echo "<script> alert('No Tiene autorización'); window.location.href='tablero.php';";
}

?>
</body>
</html>