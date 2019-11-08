<?php

include('./php/conexion.php');

$error = null;

// verificacion

session_start();
session_destroy();
session_unset();

if (isset($_POST["btnIngresar"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == '' || $username == null) {
        $error = "Debe escribir algo en el campo username*";
    } elseif ($password == '' || $password == null) {
        $error = "Debe escribir algo en el campo password*";
    } else {

        if ($stmt = mysqli_prepare($cn, "SELECT idUsuario, contraseña FROM Usuario WHERE usuario = ?")) {

            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $numUsuarios = mysqli_num_rows($result);

            if ($numUsuarios > 0) {

                $counter = 0;

                while ($row = mysqli_fetch_array($result)) {
                    if (password_verify($password, $row['contraseña'])) {
                        session_start();

                        $_SESSION['userId'] = $row['idUsuario'];
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

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ingresar</title>

    <!-- Decora todos los elementos de este documento -->
    <link rel="stylesheet" href="./css/estilosLogin.css">

</head>
<body>

    <header>
        <nav>
            <a href="index.html"><img src="./img/desktop/logo.png" alt="" class="imgs"></a>
            <a href="#"><img src="./img/desktop/logo2.png" alt="" class="imgs"></a>
        </nav>
    </header>

    <form action="ingresar.php" method="post">

        <div class="main_container">
            <div class="container">
                <h1 class="item">Ingresar</h1>
                <label for="username" class="item">Usuario
                    <input type="text" name="username" type="text">
                </label>
                <label for="password" class="item"> Contraseña
                    <input type="password" name="password" type="text">
                </label>
                <input type="text" readonly value="<?php if (isset($error)) echo $error;  ?>" />
                <input type="submit" name="btnIngresar" value="Ingresar" class="item">
            </div>
        </div>
    </form>

</body>

</html>