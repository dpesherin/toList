<?
require('./core/config.php');
require('./core/classes/Request.php');

$rq = new Request;

$arFields = [
    'IBLOCK_TYPE_ID'=>'lists'
];

$data = $rq->make('lists.get', $arFields);

$res = json_decode($data)->result;

$opt = [];
$row = [];

foreach($res as $el){
    array_push($row, $el->ID);
    array_push($row, $el->NAME);
    $row = array_combine(["ID", "NAME"], $row);
    array_push($opt, $row);
    $row = [];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <title>Document</title>
</head>
<body>

    <header>
        <div class="logo">
            <h1 id="logo">LOGO</h1>
        </div>
    </header>

    <main>
        <div class="form-place">
            <h2>Форма для загрузки в списки</h2>
            <form method="post" id='form' enctype="multipart/form-data">
                <label for="list">Выберите список</label>
                <select name="list" id="list-selector" class="form-select">
                    <option value="none">Не выбрано</option>
                    <?
                    foreach($opt as $el){
                        echo('<option value="'.$el["ID"].'">'.$el["NAME"].'</option>');
                    }
                    ?>
                </select>
                <input type="file" class="form-control" id="inputGroupFile01" name="file">
                <input class="btn btn-primary" type="submit" id='bnt-submit' value="Отправить">
            </form>
            <div id="message">
                
            </div>
            <div id="loader">
                <div class="d-flex align-items-center" id="loader">
                    <strong>Loading...</strong>
                    <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                </div>
            </div>            
            
        </div>

        <div class="getPreset">
            <h3>Скачать пресет</h3>
            <form method="post" id='form-preset'>
                <label for="list">Выберите список</label>
                <select name="list" id="list-selector-get" class="form-select">
                    <option value="none">Не выбрано</option>
                    <?
                    foreach($opt as $el){
                        echo('<option value="'.$el["ID"].'">'.$el["NAME"].'</option>');
                    }
                    ?>
                </select>
                <input class="btn btn-primary" type="submit" id='bnt-submit-list-get' value="Скачать пресет">
            </form>
            <div id="messageGet">
                
            </div>
        </div>
        
    </main>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="app.js"></script>
</html>
