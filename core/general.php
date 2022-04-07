<?
 function getJSON($path){
   $json = file_get_contents($path);
   $json = json_decode((string)$json, true);
   return $json;
 }

 function getBySchema($schema, $data){
   var_dump($schema);
   var_dump($data);
 }

 