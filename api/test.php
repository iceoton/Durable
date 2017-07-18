<?php
date_default_timezone_set('Asia/Bangkok');
header('Content-type:application/json;charset=utf-8');
ini_set('display_errors', 'on');
require_once __DIR__.'/../core/config.core.php';

$db_name = DB_NAME;
$db_user = DB_USERNAME;
$db_pass = DB_PASSWORD;
$db_host = DB_HOST;

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