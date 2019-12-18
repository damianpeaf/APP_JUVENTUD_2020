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
  $dir = join("/", array_slice($dir, $htdocsPosition+1));
  return $dir;
}

/* ===============================================================================
  Description:      Obtiene la respuesta de una API.
  Parameter(s):     $url  - URL donde hacer la llamada a la API
                    $method - POST/GET/PUT/DELETE, etc...
                    $options  - Array para configurar cURL
                    $values - En caso de no ser tipo GET y llevar valores
  Requirement(s):   None
  Return Value(s):  On Success - Response from API
                    On Failure - Curl Error
  Author(s):        Flavio Galán
===============================================================================*/
function apiCall(String $url, String $method, Array $options = [], Array $values = [])
{
  $ch = curl_init($url);
  $opt = array(
    CURLOPT_RETURNTRANSFER => true,         // return web page
    CURLOPT_HEADER         => false,        // don't return headers
    CURLOPT_FOLLOWLOCATION => true,         // follow redirects
    CURLOPT_ENCODING       => "",           // handle all encodings
    CURLOPT_USERAGENT      => "ELROHIRGT",     // who am i
    CURLOPT_AUTOREFERER    => true,         // set referer on redirect
    CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
    CURLOPT_TIMEOUT        => 120,          // timeout on response
    CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
    CURLOPT_POST           => 0,            // i am sending post data
    CURLOPT_POSTFIELDS     => $values,
    CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
    CURLOPT_SSL_VERIFYPEER => false,        //
    CURLOPT_VERBOSE        => 1                //
  );
  if (!empty($options)) {
    $opt = array_merge($options, $opt);
  }
  switch ($method){
    case 'POST':
      $opt[CURLOPT_POST] = 1;
      break;
  }
  curl_setopt_array($ch, $opt);
  $content = curl_exec($ch);
  if (!$content) {
    return curl_error($ch);
  }
  return json_decode($content);
}