<?php

require_once './php/validacionUsuario.php';
require_once './php/conexion.php';

$error = (isset($_GET['e']))? $_GET['e']: "";

switch($error){
  case 'empty':
    $error = "No has llenado algún campo!";
  break;
  case 'succes':
    $error = "Usuario insertado correctamente!";
  break;
  // case 'insert':
  //   $error = "Error al insertar el usuario!";
  // break;
}

$tipos = mysqli_fetch_all(mysqli_query($cn, "SELECT * FROM TipoUsuario"), MYSQLI_ASSOC);
if ($_SESSION['idTipoUsuario']!=1) {//Si no es Administrador
  header("Location: tablero.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Crear Usuario</title>
  <link rel="stylesheet" href="./css/estilosFormularios.css">
</head>
<body>
<div class="custom-scroll">
  <form action="./php/crearusuario.inc.php" method="POST">
    <h2>Crear Usuario</h2>
    <p for="nombre">Usuario:
      <input type="text" name="usuario[nombre]" placeholder="Nombre:" required>
    </p>
    <p for="contraseña">Contraseña:
      <input type="text" name="usuario[contraseña]" placeholder="Contraseña:" required>
    </p>
    <p>Email:
      <input type="email" name="usuario[email]" placeholder="E-mail:">
    </p>
    <p for="tipo">Tipo:
      <select name="usuario[tipo]" id="tipo">
        <?php foreach($tipos as $tipo): ?>
          <option value="<?=$tipo['idTipoUsuario']?>" title="<?=$tipo['descripcion']?>"><?=$tipo['nombre']?></option>
        <?php endforeach ?>
      </select>
    </p>
    <div class="error">
      <?php if (!empty($error)): ?>
        <h3><?=$error?></h3>
      <?php endif ?>
    </div>
    <button type="submit" name="submit">Enviar</button>
  </form>
</div>
  <footer class="footer">
    <button onclick="location.href='more-options.php'  ">Volver</button>
  </footer>
</body>
</html>