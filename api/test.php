<?php
date_default_timezone_set('Asia/Bangkok');
header('Content-type:application/json;charset=utf-8');
ini_set('display_errors', 'on');

$db_name = 'durable';
$db_user = 'adminfUMeDEG';
$db_pass = '6i9iEuF6xE3w';
$db_host = '127.4.145.2';

try {
    echo "mysql:host=$db_host;dbname=$db_name;charset=utf8";
    $db_conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    // set the PDO error mode to exception
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db_conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    echo "มัน success <br>";
} catch (PDOException $e) {
    echo "มัน error <br>";
    echo $e->getMessage();
}