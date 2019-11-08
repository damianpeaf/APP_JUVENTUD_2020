<?php

    if (isset($_POST["btn"])) {
        $pass = $_POST["btn"];


        $hash = password_hash($pass, PASSWORD_BCRYPT);

        echo $hash ."<br>";

        echo var_dump(password_verify($pass,$hash));

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <p> password <input type="texto" name="password"></p>
        
        <p><input type="submit" name="btn" value="ENCRIPTAR"></p>
    </form>
</body>
</html>