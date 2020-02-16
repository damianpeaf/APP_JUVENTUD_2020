<?php

require_once('./validacionUsuario.php');
require_once('./conexion.php');

if ($userId != null && $userId != '') {

    if ($_SESSION['idTipoUsuario'] == 1) {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar</title>
</head>
<body>
    <?php

        $idUsuario = $_GET["idUsuario"] ?? null;

        if($stmt = mysqli_prepare($cn, "UPDATE usuario set idStatus = 3 where idUsuario = ?")){
            
            mysqli_stmt_bind_param($stmt, 'i', $idUsuario);
            mysqli_stmt_execute($stmt);

            if(mysqli_stmt_affected_rows($stmt) > 0){

                echo "<script> alert('Usuario Eliminado'); window.location.href='../more-options.php'; </script>";

            }else{
                echo "<script> alert('Hubo un error'); window.location.href='../more-options.php'; </script>";
            }
        }


    ?>
</body>
</html>

<?php
    }
}
?>