<?
 function getJSON($path){
    $json = file_get_contents($path);
    $json = json_decode((string)$json);
    return $json;
 }