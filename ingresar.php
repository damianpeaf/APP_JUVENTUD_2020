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

        if($stmt = mysqli_prepare($cn, "SELECT contraseña FROM Usuario WHERE usuario = ?")){

            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $numUsuarios = mysqli_num_rows($result);

            if ($numUsuarios>0) {

                $counter = 0;

                while ($row = mysqli_fetch_array($result)) {
                    if (password_verify($password, $row['contraseña'])) {
                        echo " CORRECTO ";
                    }else{
                        $counter++;
                        if ($counter == $numUsuarios) {

                            // depuracion ¿?
                            echo $counter . "      ". $numUsuarios . "<br>";
                            echo $row['contraseña'] . "     ". $password. "<br>";
                            echo var_dump($row['contraseña']) . "     ". var_dump($password). " ". var_dump(password_verify($password, $row['contraseña'])) ."<br>";
                            // fin depuracion ¿?

                            echo "Contraseña incorrecta";
                        }
                    }
                } 
            }else {
                echo "Usuario Incorrecto";
            }            
        }
    }
}

?>