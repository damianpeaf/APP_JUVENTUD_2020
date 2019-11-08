<?php

session_start();

    $userId = $_SESSION['userId'] ?? null;

    if ($userId == null || $userId== '') {
        echo "<script>
        alert('NO TIENE AUTORIZACION');
        window.location.href='ingresar.php';
        </script>";
    }

?>