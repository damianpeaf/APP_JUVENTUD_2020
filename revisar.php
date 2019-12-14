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

include './php/conexion.php';
include './php/validacionUsuario.php';

if ($userId != null && $userId != '') {

    $resultados1 = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM Usuario WHERE idUsuario = '" . $userId . "' "));
    $verificacion = $resultados1['idTipoUsuario'] == 1;

    if ($verificacion) {


        // TODO: INSERTAR 

        if (isset($_POST["btnAceptar"])) {
            echo "<script> alert('haz aceptado'); </script>";

            
        } else if (isset($_POST["btnRechazar"])) {
            echo "<script> alert('haz rechazado'); </script>";
        }

        if (isset($_GET["idEvento"])) {

            $idEvento = $_GET["idEvento"];

            $stmt = mysqli_prepare($cn, "SELECT * FROM evento where idEvento = ?");

            mysqli_stmt_bind_param($stmt, 'i', $idEvento);

            if (mysqli_stmt_execute($stmt)) {

                // CODIGO DE MOSTRAR Y VERFIICAR

                $result = mysqli_stmt_get_result($stmt);

                $datosPost = mysqli_fetch_array($result);

                $query = mysqli_query($cn, "SELECT usuario, email from usuario where idUsuario = '" . $datosPost['idUsuario'] . "' ");
                $datosAutor = mysqli_fetch_array($query);

                $datosCategoria = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM categoria where idCategoria = '" . $datosPost['idCategoria'] . "' "))

                ?>

    <br>
    <h2> <button type="button" class="btn btn-dark" onclick="location.href='./tableroA.php'">Volver</button>Revisión de
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
            <td><?php echo date('d-m-Y H:i:s', strtotime($datosPost['fechaDePublicacion'])); ?></td>
        </tr>
        <tr>
            <td class="titulo">Fecha de Incio</td>
            <td><?php echo date('d-m-Y H:i:s', strtotime($datosPost['inicia'])); ?></td>
        </tr>
        <tr>
            <td class="titulo">Fecha de Finalización</td>
            <td><?php echo date('d-m-Y H:i:s', strtotime($datosPost['termina'])); ?></td>
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
                echo "<script> alert('Hubo un error'); </script>";
            }

            #FIN COD EVENTOS

        } elseif (isset($_GET["idPost"])) {

            $idPost = $_GET["idPost"];

            $stmt = mysqli_prepare($cn, "SELECT * FROM post where idPost = ?");

            mysqli_stmt_bind_param($stmt, 'i', $idPost);

            if (mysqli_stmt_execute($stmt)) {

                // CODIGO DE MOSTRAR Y VERFIICAR

                $result = mysqli_stmt_get_result($stmt);

                $datosPost = mysqli_fetch_array($result);

                $query = mysqli_query($cn, "SELECT usuario, email from usuario where idUsuario = '" . $datosPost['idUsuario'] . "' ");
                $datosAutor = mysqli_fetch_array($query);

                $datosCategoria = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM categoria where idCategoria = '" . $datosPost['idCategoria'] . "' "))

                ?>

    <br>
    <h2> <button type="button" class="btn btn-dark" onclick="location.href='./tableroA.php'">Volver</button>Revisión de
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
            <td><?php echo date('d-m-Y H:i:s', strtotime($datosPost['fechaDePublicacion'])); ?></td>
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
                echo "<script> alert('Hubo un error'); </script>";
            }

        } else {
            echo "<script> alert('No Tiene autorización'); ";
            exit();
        }

    } else {
        echo "<script> alert('No Tiene autorización'); ";
    }
} else {
    echo "<script> alert('No Tiene autorización'); ";
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

                        <textarea name="mensaje" style=" width: 100%; "
                            placeholder="coloca las razones de la no publicación del post o evento"></textarea>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <form action="" method="post" name="formRechazar">
                        <button type="submit" name="btnRechazar" class="btn btn-primary">Aceptar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>