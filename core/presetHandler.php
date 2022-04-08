<?

use Shuchkin\SimpleXLSXGen;

require($_SERVER['DOCUMENT_ROOT'].'/core/classes/Request.php');
require($_SERVER['DOCUMENT_ROOT'].'/core/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/core/general.php');
require($_SERVER['DOCUMENT_ROOT'].'/core/simplexlsxgen/SimpleXLSXGen.php');

$listId = $_POST['list'];

if($listId === 'none'){
    echo('Не выбран список');
    die();
}

$rq = new Request;
$arFields = [
    'IBLOCK_TYPE_ID'=> 'lists',
    'IBLOCK_ID'=>$listId
];

$res = $rq->make('lists.field.get', $arFields);
$res = (array)json_decode($res)->result;

$row = [];
$data = [];
$name = [];

foreach($res as $el){
    array_push($row, $el->FIELD_ID);
    array_push($row, $el->TYPE);
    array_push($name, $el->NAME);
    $row = array_combine(['FIELD_ID', 'TYPE'], $row);
    array_push($data, $row);
    $row = [];
}

$fileName = $_SERVER['DOCUMENT_ROOT'].'/core/uploads/list_structure/schema_list_'.$listId.'.json';

if(file_exists($fileName)){
    unlink($fileName);
}

$data = array_combine($name, $data);

$content = json_encode($data);

$file = fopen($fileName, 'w');
fwrite($file, $content);
fclose($file);

$json = getJSON($fileName);

$newFile = 'uploads/preset_list_'.$listId.'.xlsx';

if(file_exists($newFile)){
    unlink($newFile);
}

$books = [];
array_push($books, $name);

$xlsx = SimpleXLSXGen::fromArray($books);

$xlsx->saveAs($newFile);
echo("<a class='download' href=".DOMAIN."/core/".$newFile.">Скачать</a>");


