<?php
require_once '../php/conexion.php';
require_once '../php/functions.php';

// header("Acces-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Acces-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Acces-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$maximoPorPagina = 6;
// var_dump(getURL(getcwd()));
if (isset($_GET['p'])&&is_numeric($_GET['p'])&&$_GET['p']>0) {
  $cantidadRegistros = mysqli_fetch_assoc(mysqli_query($cn, "SELECT COUNT(*) as CantidadPosts FROM Post WHERE idStatus=1"));
  $comienzo = ($_GET['p']==1)? 0: ($_GET['p']-1)*$maximoPorPagina;
  $stmt = mysqli_prepare($cn, "SELECT * FROM POST WHERE idStatus=1 order by idPost desc LIMIT ?, {$maximoPorPagina}");
  
  mysqli_stmt_bind_param($stmt, "i", $comienzo);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $idStatus, $idUsuario, $idCategoria, $idEvento, $idPost, $titulo, $fechaDePublicacion, $contenido, $adjuntos);


  $result = [];
  while (mysqli_stmt_fetch($stmt)) {
    $result[] = [
      "idStatus"=>$idStatus,
      "idUsuario"=>$idUsuario,
      "idCategoria"=>$idCategoria,
      "idEvento"=>$idEvento,
      "idPost"=>$idPost,
      "titulo"=>$titulo,
      "fechaDePublicacion"=>$fechaDePublicacion,
      "contenido"=>$contenido,
      "adjuntos"=>$adjuntos,

    ];
  }
  // var_dump($result);
  echo json_encode($result);
}


?>