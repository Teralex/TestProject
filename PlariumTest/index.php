<?php

header('Content-Type: text/html; utf-8; charset=UTF-8');
mb_internal_encoding("UTF-8");
$testMessage = 'Мой замок был ограблен
На меня напал высокоуровневый замок
Ограблен замок моего товарища';

//require_once '/Service/Finder.php';

if (isset($_POST['word'])) {
    require_once '/Service/Declination.php';
    require_once '/Service/config.php';
    $res = new Declination($_POST['word'], $_POST['sex']);
    $test = $res->GetDeclination();
} elseif (isset($_POST['message'])) {
    require_once '/Service/Finder.php';
    $res = new Finder($_POST['message']);
    $test = $res->CheckWords();
    
    //$test = $_POST['message'];
}
//$res = new Finder($testMessage);
//$test = $res->CheckWords();
//var_dump($test);
echo (json_encode($test));
