<?php

require_once './php/conexion.php';
require_once './php/validacionUsuario.php';
require_once './php/functions.php';

if ($userId != null && $userId != '') {

    $resultados1 = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM Usuario WHERE idUsuario = '" . $userId . "' "));
    $verificacion = $resultados1['idTipoUsuario'] == 1 || $resultados1['idTipoUsuario'] == 2;

    if ($verificacion) {

        if (isset($_POST["btn"])) {
            $idStatus = 2;
            $idUsuario = $userId;
            $idCategoria = $_POST["categoria"];
            $idEvento = null;
            $inicio = $_POST["inicio"];
            $final = $_POST["final"];

            $titulo = $_POST["titulo"];
            $descripcion = $_POST["descripcion"];

            $archivosPermitidos = array('image/png', 'image/jpeg', 'application/pdf', 'application/msword', 'application/vnd.ms-powerpoint');

            $pesoMaximo = 5000; //en KB

            $arrayAdjuntos = [];

            if (!empty($titulo)) {
                if (!empty($descripcion)) {
                    if ($idCategoria >= 1 && $idCategoria <= 4) {
                        if (strlen($titulo) <= 45) {

                            require_once './php/functions.php';

                            if (validateDate($inicio, 'Y-m-d\TH:i')) {
                                if (validateDate($final, 'Y-m-d\TH:i')) {
                                    if ($inicio <= $final) {

                                        #CODIGO DE SUBIDA DE ARCHIVOS

                                        foreach ($_FILES["archivo"]['tmp_name'] as $key => $tmp_name) {

                                            if ($_FILES["archivo"]["error"][$key]) {
                                                echo "<script> alert('Error al cargar archivo/s'); </script>";
                                            } else {

                                                if (in_array($_FILES["archivo"]["type"][$key], $archivosPermitidos) && $_FILES["archivo"]["size"][$key] <= $pesoMaximo * 1024) {
                                                    if ($_FILES["archivo"]["name"][$key]) {
                                                        $filename = $_FILES["archivo"]["name"][$key];
                                                        $source = $_FILES["archivo"]["tmp_name"][$key];

                                                        $directorio = './docs/';

                                                        $dir = opendir($directorio);
                                                        $target_path = $directorio . '/' . $filename;
                                                        $target_path = $directorio . '/' . $idUsuario . "_" . $filename;

                                                        if (!file_exists($target_path)) {

                                                        } else {
                                                            echo "<script> alert('El archivo " . $filename . " ya está guardado. Por favor cambie el nombre si cree que es incorrecto'); </script>";
                                                        }

                                                        if (move_uploaded_file($source, $target_path)) {

                                                            echo "<script> alert('El archivo " . $filename . " se ha almacenado en forma exitosa'); </script>";

                                                            $arrayAdjuntos[] = $idUsuario . "_" . $filename;

                                                        } else {
                                                            echo "<script> alert('Ha ocurrido un error, por favor inténtelo de nuevo.<br>'); </script>";
                                                        }
                                                        closedir($dir);
                                                    }
                                                } else {
                                                    echo "<script> alert('El archivo " . $filename . " no permitido, o es demasiado pesado'); </script>";
                                                }
                                            }
                                        }

                                        if (isset($arrayAdjuntos)) {
                                            $adjuntos = json_encode($arrayAdjuntos);
                                        }else{
                                            $adjuntos = null;
                                        }

                                        #FIN CODIGO DE SUBIDA DE ARCHIVOS

                                        #codigo de insercion

                                        $stmt = mysqli_prepare($cn, "INSERT INTO evento (idStatus, idUsuario, idCategoria, idEvento, titulo, descripcion, inicia, termina, adjuntos) values (?, ?, ?, ?, ?, ?, ?, ?, ?) ");

                                        mysqli_stmt_bind_param($stmt, 'iiiisssss', $idStatus, $idUsuario, $idCategoria, $idPost, $titulo, $descripcion, $inicio, $final, $adjuntos);
                                        mysqli_stmt_execute($stmt);
                                        
                                        if (mysqli_stmt_affected_rows($stmt) > 0) {
                                            echo "<script> alert('Evento ingresado, esperando revision'); </script>";
                                        } else {
                                            echo "<script> alert('Hubo un error'); </script>";
                                        }

                                    } else {
                                        echo "<script> alert('La Fecha de Inicio es mayor que la de finalización'); </script>";
                                    }
                                } else {
                                    echo "<script> alert('Fecha de Finalización Incorrecta'); </script>";
                                }
                            } else {
                                echo "<script> alert('Fecha de Inicio Incorrecta'); </script>";
                            }
                        } else {
                            echo "<script> alert('El título debe contener menos de 45 caracteres'); </script>";
                        }
                    } else {
                        echo "<script> alert('Categoria Inválida'); </script>";
                    }
                } else {
                    echo "<script> alert('La descripcion está vacío'); </script>";
                }
            } else {
                echo "<script> alert('Título vacío'); </script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ingresar Evento</title>

    <!-- estilos -->
    <link rel="stylesheet" href="./css/estilosFormularios.css">

</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <h2>Crear Evento</h2>
            <p>
                Categoria
                <select name="categoria">
                    <option value="1">Ciencias</option>
                    <option value="2">Deportes</option>
                    <option value="3">Religión</option>
                    <option value="4">Arte</option>
                </select>
            </p>
            <p>Título <input type="text" name="titulo" placeholder="Título"></p>
            <p>Descripción</p>
            <p><textarea name="descripcion" cols="30" rows="10" placeholder="La descripción del evento va aquí"></textarea></p>

            <p><label for="inicio"> Inicio </label><input type="datetime-local"  id="inicio" name="inicio"></p>

            <p><label for="clockpicker1"> Finalización </label><input type="datetime-local"  id="final" name="final"></p>

            <br>

            <h4>Cargar Archivos</h4>
            <p>Archivos<input type="file" name="archivo[]" multiple="" accept=".jpg, .png,.pdf, .pptx"></p>

            <p><input type="submit" name="btn" value="Enviar"></p>
    </form>

    <div class="footer">
        <button onclick="location.href='./tableroA.php';">Volver</button>
    </div>

</body>
</html>

    
