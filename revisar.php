<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Revisar</title>

    <link rel="stylesheet" href="./css/estilosRevision.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>


    <!-- Bootsrap modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


</head>

<body>

    <?php

    if (setlocale(LC_TIME, "es_GT.UTF-8")){
        var_dump(localeconv());
    }else {echo "<h2>ERROR</h2>";var_dump(setlocale(LC_ALL, 0));}

    require_once './php/conexion.php';
    require_once './php/validacionUsuario.php';


    if ($userId != null && $userId != '') {

        if ($_SESSION['idTipoUsuario'] == 1) {

            if (isset($_GET["idEvento"])) {

                $idEvento = $_GET["idEvento"];

                $stmt = mysqli_prepare($cn, "SELECT * FROM evento where idEvento = ? and idStatus = '2' ");

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
    <h2> <button type="button" class="btn btn-dark" onclick="location.href='./tablero.php'">Volver</button>Revisión de
        Eventos</h2>

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

            $stmt = mysqli_prepare($cn, "SELECT * FROM post where idPost = ? and idStatus = 2 ");

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
    <h2> <button type="button" class="btn btn-dark" onclick="location.href='./tablero.php'">Volver</button>Revisión de
        Noticia</h2>

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
                echo "<script> alert('Hubo un error, posiblemente este post ya ha sido revisado o no existe'); window.location.href='tablero.php'; </script>";
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

#CODIGO PARA HACER EL UPDATE AL ESTATUS

if (isset($_POST["btnAceptar"])) {

    if (isset($idEvento)) {

        $stmt = mysqli_prepare($cn, "UPDATE evento SET idStatus = '1' where idEvento = ?");

        mysqli_stmt_bind_param($stmt, 'i', $idEvento);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script> alert('Haz aceptado'); window.location.href='tablero.php'; </script>";
        } else {
            echo "<script> alert('Hubo un error'); window.location.href='tablero.php'; </script>";
        }

    } else if (isset($idPost)) {
        $stmt = mysqli_prepare($cn, "UPDATE post SET idStatus = '1' where idPost = ?");

        mysqli_stmt_bind_param($stmt, 'i', $idPost);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script> alert('Haz aceptado'); window.location.href='tablero.php'; </script>";
        } else {
            echo "<script> alert('Hubo un error'); window.location.href='tablero.php'; </script>";
        }
    }

} else if (isset($_POST["btnRechazar"])) {

    $razon = $_POST["mensaje"]; //este campo llegaria como notificacion a el redactor

    echo var_dump($razon);

    if (isset($idEvento)) {

        if (!empty($razon)) {

            $stmt = mysqli_prepare($cn, "UPDATE evento SET idStatus = '3' where idEvento = ?");
            $stmt2 = mysqli_prepare($cn, "INSERT INTO notificacion (idNotificacion, idAdmin, idCreador, idEvento, mensaje) VALUES (null, ?, ?, ?, ?)");

            mysqli_stmt_bind_param($stmt2, 'iiis', $userId, $datosPost['idUsuario'], $idEvento, $razon);
            mysqli_stmt_execute($stmt2);

            if (mysqli_stmt_affected_rows($stmt2) > 0) {
                mysqli_stmt_bind_param($stmt, 'i', $idEvento);
                mysqli_stmt_execute($stmt);

                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    echo "<script> alert('Haz rechazado'); window.location.href='tableroA.php'; </script>";

                }else{
                    echo "<script> alert('Hubo un error');</script>";
                    echo mysqli_error($cn);
                }

            } else {
                echo "<script> alert('Hubo un error');</script>";
                echo mysqli_error($cn) . " jajaj ";
            }
        } else {
            echo "<script> alert('No haz escrito una razón'); </script>";
        }

    } else if (isset($idPost)) {

        if (!empty($razon)) {

            $stmt = mysqli_prepare($cn, "UPDATE post SET idStatus = '3' where idPost = ?");
            $stmt2 = mysqli_prepare($cn, "INSERT INTO notificacion (idNotificacion, idAdmin, idCreador, idPost, mensaje) VALUES (null, ?, ?, ?, ?)");

            mysqli_stmt_bind_param($stmt2, 'iiis', $userId, $datosPost['idUsuario'], $idPost, $razon);
            mysqli_stmt_execute($stmt2);

            if (mysqli_stmt_affected_rows($stmt2) > 0) {
                mysqli_stmt_bind_param($stmt, 'i', $idPost);
                mysqli_stmt_execute($stmt);

                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    echo "<script> alert('Haz rechazado'); window.location.href='tableroA.php'; </script>";

                }else{
                    echo "<script> alert('Hubo un error');</script>";
                }

            } else {
                echo "<script> alert('Hubo un error');</script>";
            }
        } else {
            echo "<script> alert('No haz escrito una razón'); </script>";
        }
    }

}

?>
    <footer>
        <button type="button" class="btn btn-primary  btn-lg btn-success" data-toggle="modal"
            data-target="#formModal1">Aceptar</button>
        <button type="button" class="btn btn-primary  btn-lg btn-danger" data-toggle="modal"
            data-target="#formModal2">Rechazar</button>
    </footer>

    <!-- Modal 1 -->
    <div class=" modal fade" id="formModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Aceptar Publicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás Seguro de querer aceptar la publicación de este post o evento?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <form action="" name="formAceptar" method="post"><button type="submit" name="btnAceptar"
                            class="btn btn-primary">Aceptar</button></form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class=" modal fade" id="formModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Rechazar Publicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="" method="post" name="formRechazar">

                        <p>¿Estás Seguro de querer rechazar la publicación de este post o evento?</p>

                        <br>

                        <p>Para ello debes llenar el formulario para saber cual es el motivo de tu decisión</p>

                        <textarea name="mensaje" style=" width: 100%; " placeholder="coloca las razones de la no publicación del post o evento"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="btnRechazar" class="btn btn-primary">Aceptar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>