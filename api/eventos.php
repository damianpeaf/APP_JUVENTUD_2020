<?php

    // header('Content-Type: application/json');
    require_once '../php/conexion.php';
    require_once '../php/functions.php';

    $start = (isset($_GET['start']))? $_GET['start']: false;
    $end = (isset($_GET['end']))? $_GET['end']: false;
    if (!$start || !$end) {
        echo json_encode(["mensaje"=> "Alguna fecha no esta definida!"]);
        exit;
    }
    if (!validateDate($start, "Y-m-d") || !validateDate($end, "Y-m-d")) {
        echo json_encode(["mensaje"=> "Fechas en formato incorrecto!"]);
        exit;
    }

    //Trayendo solo los eventos revisados y dentro del tiempo debido
    $res = mysqli_query($cn, "SELECT * FROM evento WHERE inicia>='{$start}' AND termina<='{$end}' AND idStatus=1");
    $eventos = mysqli_fetch_all($res, MYSQLI_ASSOC);
    // var_dump($eventos);

    $res = mysqli_query($cn, "SELECT color FROM Categoria");
    $colores = mysqli_fetch_all($res, MYSQLI_ASSOC);

    $eventosFormateados = [];
    foreach ($eventos as $evento) {
        $eventosFormateados[] = [
            "id"=> $evento['idEvento'],
            "groupId"=>$evento['idCategoria'],
            "start"=>$evento['inicia'],
            "end"=>$evento['termina'],
            "title"=>$evento['titulo'],
            "editable"=>false,
            "backgroundColor"=>$colores[$evento['idCategoria']-1]['color']
        ];

    }

    echo json_encode($eventosFormateados)

?>