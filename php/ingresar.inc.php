<?php

require_once './php/conexion.php';

$error = null;

// verificacion

session_start();
session_regenerate_id(true);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {//Chequea si se accedió por medio de POST

    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == '' || $username == null) {
        $error = "*Debe escribir algo en el campo username*";
    } elseif ($password == '' || $password == null) {
        $error = "*Debe escribir algo en el campo password*";
    } else {

        if ($stmt = mysqli_prepare($cn, "SELECT * FROM Usuario WHERE usuario = ?")) {

            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $numUsuarios = mysqli_num_rows($result);

            if ($numUsuarios > 0) {

                $counter = 0;

                while ($row = mysqli_fetch_array($result)) {
                    if (password_verify($password, $row['contraseña'])) {
                        session_start();

                        $_SESSION = $row;
                        unset($_SESSION['contraseña']);
                        // $_SESSION['userId'] = $row['idUsuario'];
                        // $_SESSION['userType'] = $row['idTipoUsuario'];
                        // if ($row['idTipoUsuario'] == 1) {
                        //     header("Location: tableroAdministrador.php");

                        // } elseif ($row['idTipoUsuario'] == 2) {
                            
                        // } else {
                        //     echo "<script> alert('Error de autenticacion'); window.location.href='./ingresar.php'; </script>";
                        // }
                        header("Location: tablero.php");
                    } else {
                        $counter++;
                        if ($counter == $numUsuarios) {
                            $error = "Contraseña incorrecta*";
                        }
                    }
                }
            } else {
                $error = "Usuario incorrecto*";
            }
        }
    }
}
