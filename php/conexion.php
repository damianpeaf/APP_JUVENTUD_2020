<?php

    // Conexion de Pipa
    // $cn = mysqli_connect('localhost', 'root', '1234', 'app juventud', '3307');

    // Conexion de Flavio 
    $cn = mysqli_connect('localhost', 'root', 'g@l@nd0nis', 'app juventud');

    if (!$cn) {
        $error = mysqli_connect_error();
        echo " <script> alert('Hubo un error en la conexion al servidor, {$error}'); </script>";
        exit();
    }