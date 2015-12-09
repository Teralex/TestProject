<?php

header('Content-Type: text/html; utf-8; charset=UTF-8');
mb_internal_encoding("UTF-8");

$testArray = array('Мой замок был ограблен',
    'На меня напал высокоуровневый замок',
    'Ограблен замок моего товарища',
);

require_once '/Service/ServiceAbstract.php';
require_once '/Service/Finder.php';
require_once '/Service/Declination.php';
require_once '/Service/config.php';
if (isset($_POST['word'])) {
    $testWord = $_POST['word'];
    $sex = $_POST['sex'];
}
////$res = new Finder($testArray);
//$unique = $res->CheckWords();
$res = new Declination($testWord, $sex);
$test = $res->GetDeclination();
var_dump($test);
//var_dump($unique);
