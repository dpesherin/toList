<? 
require_once("./simplexlsx/simplexlsx.class.php");
require('./classes/Request.php');
require('./config.php');

$listId = $_POST['list'];
$file =$_FILES['file']['tmp_name'];
$path = './uploads/'.$_FILES['file']['name'];

move_uploaded_file($file, $path);

$xlsx = new SimpleXLSX($path);

$sheet = $xlsx->rows(1);

$HeaderCols = [];
$countHeader = 0;
$header = $sheet[0];
$row = [];
$data = [];

//Считаем реальное число колонок с данными

for($i=0; $i<count($header); $i++){
	if($header[$i]!=''){
		array_push($HeaderCols, $header[$i]);
		$countHeader = $countHeader + 1;
	}
}

unset($sheet[0]);

foreach($sheet as $el){
	for($i=0; $i<count($el); $i++){
		if($el[$i]!=''){
			array_push($row, $el[$i]);
		}
	}
	if($row!=[]){
		$row = array_combine($HeaderCols, $row);
		array_push($data, $row);
		$row = [];
	}
	
}


$rq = new Request;

foreach($data as $el){
	$hash = md5($el['FIELD_NAME'].$el['EDIT_FORM_LABEL']);
	$arFields = [
		'IBLOCK_TYPE_ID'=>'lists',
		'IBLOCK_ID'=> $listId,
		'ELEMENT_CODE'=> $hash,
		'FIELDS'=> [
			'NAME'=> $el['ENTITY_ID'],
			'PROPERTY_72'=> $el['FIELD_NAME'],
			'PROPERTY_74'=> $el['USER_TYPE_ID'],
			'PROPERTY_73' => $el['EDIT_FORM_LABEL']
		]
	];


	$res = $rq->make('lists.element.add', $arFields);
}


unlink($path);

echo("Success ");









    




