<?php

    session_start();


    if (isset($_SESSION['idUsuario'])) {
        session_destroy();
        $_SESSION = [];
        echo "<script>
        alert('Sesión cerrada');
        window.location.href='../ingresar.php';
        </script>";
    }else{
        echo "<script>
        alert('No hay ninguna sesión abierta');
        </script>"; 
    }

?>