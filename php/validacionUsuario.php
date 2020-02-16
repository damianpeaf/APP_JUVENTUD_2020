<?php

session_start();
$userId = $_SESSION['idUsuario'] ?? null;

if ($userId == null || $userId == '') {
    echo "<script>
        alert('NO TIENE AUTORIZACION');
        window.location.href='ingresar.php';
        </script>";
}

    if ($_SESSION['idStatus'] == 3) {
        echo "<script>
        alert('Este usuario ha sido eliminado');
        window.location.href='ingresar.php';
        </script>";
    }


?>