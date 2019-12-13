<?php

/* ===============================================================================
  Description:      Valida una fecha según el formato dado.
  Parameter(s):     $date - Fecha a evaluar.
                    $format - Formato con el que se evaluará
  Requirement(s):   None
  Return Value(s):  On Success - True
                    On Failure - False
  Author(s):        Pipa
===============================================================================*/
function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

/* ===============================================================================
  Description:      Obtiene la URL del archivo actual (sin contar dominio)
  Parameter(s):     $directory  - Usar getcwd() en el archivo que lo llama
  Requirement(s):   None
  Return Value(s):  On Success - String
  Author(s):        Flavio Galán
===============================================================================*/
function getURL($directory)
{
  $dir = explode("\\", $directory);
  $htdocsPosition = array_search("htdocs", $dir, true);
  $dir = "/".join("/", array_slice($dir, $htdocsPosition+1));
  return $dir;
}