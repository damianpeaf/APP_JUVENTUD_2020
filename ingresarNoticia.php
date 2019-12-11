<?php

include './php/conexion.php';
include './php/validacionUsuario.php';

if ($userId != null && $userId != '') {

    $resultados1 = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM Usuario WHERE idUsuario = '" . $userId . "' "));
    $verificacion = $resultados1['idTipoUsuario'] == 1;

    if ($verificacion) {

        $ultimasNoticiasPublicadas = mysqli_query($cn, "SELECT * FROM post where idStatus = 1 order by idPost limit 6");
        $ultimasEventosPublicados = mysqli_query($cn, "SELECT * FROM evento where idStatus = 1 order by idEvento limit 6");

        if (isset($_POST["btn"])) {
            $idStatus = 2;
            $idUsuario = $userId;
            $idCategoria = $_POST["categoria"];
            $idPost = null;

            $titulo = $_POST["titulo"];
            $contenido = $_POST["contenido"];

            $archivosPermitidos = array('image/png', 'image/jpeg', 'application/pdf', 'application/msword', 'application/vnd.ms-powerpoint');

            $pesoMaximo = 50000; //en KB

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

                            if (!file_exists($target_path)) {
                                
                            }else{
                                echo "<script> alert('El archivo ". $filename ." ya está guardado. Por favor cambie el nombre si cree que es incorrecto'); </script>";
                            }

                            if (move_uploaded_file($source, $target_path)) {

                                echo "<script> alert('El archivo ".$filename." se ha almacenado en forma exitosa'); </script>";
                            } else {
                                echo "<script> alert('Ha ocurrido un error, por favor inténtelo de nuevo.<br>'); </script>";
                            }
                            closedir($dir);
                        }
                    } else {
                        echo "<script> alert('El archivo ". $filename ." no permitido, o es demasiado pesado'); </script>";
                    }
                }
            }


            if (strlen($titulo) <= 45) {

                $stmt = mysqli_prepare($cn, "INSERT INTO Post (idStatus, idUsuario, idCategoria, idPost, titulo, contenido) values (?, ?, ?, ?, ?, ?) ");

                mysqli_stmt_bind_param($stmt, 'iiiiss', $idStatus, $idUsuario, $idCategoria, $idPost, $titulo, $contenido);
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script> alert('Post ingresado, esperando revision'); </script>";
                } else {
                    echo "<script> alert('Hubo un error'); </script>";
                }
            } else {
                echo "<script> alert('El título debe contener menos de 45 caracteres'); </script>";
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
    <title>Ingresar Noticia</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <p>
            Categoria
            <select name="categoria">
                <option value="1">Ciencias</option>
                <option value="2">Deportes</option>
                <option value="3">Religión</option>
                <option value="4">Arte</option>
            </select>
        </p>
        <p>Título <input type="text" name="titulo"></p>
        <p>Contenido<textarea name="contenido" cols="30" rows="10"></textarea></p>

        <h4>Cargar Archivos</h4>
        <p>Archivos <input type="file" name="archivo[]" multiple="" accept=".jpg, .png,.pdf, .pptx"></p>

        <p><input type="submit" name="btn" value="Enviar"></p>
    </form>

    <button class="button" onclick="location.href='./tableroA.php';">Volver</button>
</body>

</html>