<?php

$contraseña = 'hola';
$hash = '$2y$10$zLcvQTtFiW21U5we1lsFcORUZo3hs.Irsm53l6Wx/AxTJHwaPfBxC';

$result = password_verify($contraseña, $hash);


echo var_dump($result);
echo $result;