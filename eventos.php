<?php

    // header('Content-Type: application/json');
    include './php/conexion.php';
    
    $res = mysqli_query($cn, 'SELECT * FROM evento');
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