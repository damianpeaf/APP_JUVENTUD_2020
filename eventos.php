<?php

    header('Content-Type: application/json');

    $cn = mysqli_connect('localhost', 'root', '', 'calendario');

    $sql = mysqli_query($cn, 'SELECT * FROM eventos');

    $arreglo = array();

    while($result = mysqli_fetch_assoc($sql)){
        $arreglo[] = $result;
    }

    echo json_encode($arreglo)

    
?>