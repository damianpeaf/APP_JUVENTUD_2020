<?php

require_once('./php/validacionUsuario.php');

if ($userId != null && $userId != '') {

    if ($_SESSION['idTipoUsuario'] == 1) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar POST</title>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="./css/librerias/bootstrap4/bootstrap.min.css">

    <!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>

</head>
<body class="bg-dark">
<a href="more-options.php" class="btn btn-secondary">Regresar</a>
<br>
<table class="table table-hover table-bordered table-dark">
    <?php
    
        require_once('./php/conexion.php');


        $sql = mysqli_query($cn, "SELECT * from post where idStatus = 1");


        while ($postActivos = mysqli_fetch_array($sql)) {
            
            echo "<tr class='text-center'><td>" . $postActivos['titulo'] . "</td><td><a href='./php/eliminarPOst.php?idPost=". $postActivos['idPost']."' class='btn btn-danger'>Eliminar</a></td></tr>"; 

        }
    
    ?>
</table>
</body>
</html>

<?php

    }
}

?>