<?php

session_start();
$userId = $_SESSION['idUsuario'] ?? null;

if ($userId == null || $userId == '') {
    echo "<script>
        alert('NO TIENE AUTORIZACION');
        window.location.href='ingresar.php';
        </script>";
}

?>