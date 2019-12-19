<?php 

include_once('./conexion.php');

$userId = $_POST["userId"];


$stmt =mysqli_prepare($cn, "UPDATE notificacion SET leido = TRUE where idCreador = {$userId} or idAdmin = {$userId}");

if(mysqli_execute($stmt)){
    echo "marcando como leido";
}


?>