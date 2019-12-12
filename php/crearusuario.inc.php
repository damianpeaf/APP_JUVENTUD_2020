<?php
require_once './conexion.php';

$e = "empty";
var_dump($_POST);
if (!isset($_POST['usuario'])||empty($_POST['usuario']['nombre'])||empty($_POST['usuario']['contraseña'])) {
  header("Location: ../crearusuario.php?e={$e}");
  exit;
}
$tipo = mysqli_real_escape_string($cn, $_POST['usuario']['tipo']);
$usuario = mysqli_real_escape_string($cn, $_POST['usuario']['nombre']);
$contraseña = mysqli_real_escape_string($cn, $_POST['usuario']['contraseña']);
$contraseña = password_hash($contraseña, PASSWORD_BCRYPT);
$email = mysqli_real_escape_string($cn, $_POST['usuario']['email']);

$stmt = mysqli_prepare($cn, "INSERT INTO `Usuario`(`idStatus`, `idTipoUsuario`, `usuario`, `email`, `contraseña`) VALUES (1,?,?,?,?)");
if ($stmt) {
  mysqli_stmt_bind_param($stmt, "isss", $tipo, $usuario, $email, $contraseña);
  $e = (mysqli_stmt_execute($stmt))? "succes": mysqli_error($cn);
}
mysqli_stmt_close($stmt);
mysqli_close($cn);
header("Location: ../crearusuario.php?e={$e}");
?>