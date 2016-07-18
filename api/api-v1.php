<?php
header('Content-type:application/json;charset=utf-8');
date_default_timezone_set('Asia/Bangkok');
// 0 :Turn off all error reporting
error_reporting(1);

require_once 'controller/UserController.php';

$userController = new UserController();

$response = array();
$response['success'] = 0;
$response['error'] = 0;
$response['error_msg'] = '';
$response['result'] = null;
$data_json = array();
if (!isset($_POST)) {
    $response['error'] = 1;
    $response['error_msg'] = "ไม่มีการส่งข้อมูลด้วยวิธี POST";
    $json_response = json_encode($response);
    echo $json_response;
    exit();
}
if (isset($_POST['tag']) && isset($_POST['data'])) {
    $tag = $_POST['tag'];
    $data_json = $_POST['data'];

    if ($tag == 'userLogin') {
        $result = $userController->getUser($data_json);
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }
    } elseif ($tag == 'forgetPassword') {

    } else {
        $response['error'] = 1;
        $response['error_msg'] = "ไม่พบ tag ที่คุณต้องการ";
    }
} else {
    $response['error'] = 1;
    $response['error_msg'] = "parameter ที่ส่งมาไม่ครบ";
}

$json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
echo $json_response;
