<?php

require_once './php/ingresar.inc.php';

?>

<!DOCTYPE html>
<html lang="es">

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
            <a href="index.php"><img src="./img/desktop/logo.png" alt="" class="imgs"></a>
            <a href="#"><img src="./img/desktop/logo2.png" alt="" class="imgs"></a>
        </nav>
    </header>

    <form method="post">

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