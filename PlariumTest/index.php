<?php

header('Content-Type: text/html; utf-8; charset=UTF-8');
mb_internal_encoding("UTF-8");


if (isset($_POST['word'])) {
    require_once '/Service/Declination.php';
    require_once '/Service/config.php';
    $res = new Declination($_POST['word'], $_POST['sex']);
    $test = $res->GetDeclination();
} elseif (isset($_POST['message'])) {

    require_once '/Service/Finder.php';
    $strings = explode('/n', $_POST['message']);
    $res = new Finder($strings);

    $test = $res->CheckWords();
}
////$res = new Finder($testArray);
//$unique = $res->CheckWords();

echo (json_encode($test));
