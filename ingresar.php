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
            <a href="#"><img src="./img/desktop/logo.png" alt="" class="imgs"></a>
            <a href="#"><img src="./img/desktop/logo2.png" alt="" class="imgs"></a>
        </nav>
    </header>

    <form action="" method="post">

        <div class="main_container">
            <div class="container">
                <h1 class="item">Ingresar</h1>
                <label for="username" class="item">Usuario
                    <input type="text" name="username" type="text">
                </label>
                <label for="password" class="item"> Contraseña
                    <input type="password" name="password" type="text">
                </label>
                <input type="submit" name="btnIngresar" value="Ingresar" class="item">
            </div>
        </div>
    </form>

</body>

</html>

<?php

include('./php/conexion.php');

if (isset($_POST["btnIngresar"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == '' || $username == null) {
        echo "<p class='error' > Debe escribir algo en el username </p>";
    } elseif ($password == '' || $password == null) {
        echo "<p class='error' > Debe escribir algo en el password </p>";
    } else {

        // $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = mysqli_prepare($cn, "SELECT * FROM USUARIO WHERE USUARIO = ? AND CONTRASEÑA = ?");
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
        $result = mysqli_stmt_execute($stmt);

        if (mysqli_stmt_fetch($stmt)) {
            echo 'correcto';

            // abrir variable de sesion y redireccionar a otra pagina

        }else{
            echo "Usuario y/o contraseña incorrectos";
        }

    }
}

?>