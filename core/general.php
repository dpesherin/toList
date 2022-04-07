<?
 function getJSON($path){
   $json = file_get_contents($path);
   $json = json_decode((string)$json, true);
   return $json;
 }

 function getBySchema($schema, $data){

   $headers = array_keys($schema);
   $count = count($headers);

   $row = [];
   $fieldId = [];

  for($i = 0; $i<$count; $i++){  
    array_push($row, $data[$headers[$i]]);
    array_push($fieldId, $schema[$headers[$i]]['FIELD_ID']);
    
  }
  $row = array_combine($fieldId, $row);

  
  return($row);
 }

 function getHash(array $data){
   $row = '';
   foreach($data as $el){
    $row = (string)$row.(string)$el;
   }

   return(md5($row));
 }