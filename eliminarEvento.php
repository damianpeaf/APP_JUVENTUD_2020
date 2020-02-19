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
    <title>Elimnar usuario</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="./css/librerias/bootstrap4/bootstrap.min.css">

    <!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>


    <!-- Bootsrap modal -->
    <script src="./js/librerias/popper.min.js"></script>
    <script src="./js/librerias/boostrap 4/bootstrap.min.js"></script>

</head>
<body class="bg-dark">
<a href="more-options.php" class="btn btn-secondary">Regresar</a>
<br>
<table class="table table-hover table-bordered table-dark">
    <?php
    
        require_once('./php/conexion.php');


        $sql = mysqli_query($cn, "SELECT * from evento where idStatus = 1");


        while ($eventosActivos = mysqli_fetch_array($sql)) {
            
            echo "<tr class='text-center'><td>" . $eventosActivos['titulo'] . "</td><td><a href='./php/eliminarEvento.php?idEvento=". $eventosActivos['idEvento']."' class='btn btn-danger'>Eliminar</a></td></tr>"; 

        }
    
    ?>
</table>
</body>
</html>


<?php
    }
}

?>