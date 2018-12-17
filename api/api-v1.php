<?php
// ตั้งค่าให้ output ที่ sent ออกไปเป็นแบบ JSON ที่ใช้อักขระ UTF-8
header('Content-type:application/json;charset=utf-8');
date_default_timezone_set('Asia/Bangkok');
// 0 :Turn off all error reporting
error_reporting(1);
ini_set('display_errors', 'on');
// เป็นการนำเข้าฟังก์ชันจากไฟล์อื่นเข้ามา
require_once 'controller/UserController.php';
require_once 'controller/AssetController.php';
require_once 'controller/AssetTypeController.php';
require_once 'controller/AssetLocationController.php';
require_once 'controller/AssetStatusController.php';
require_once 'controller/CategoryController.php';
require_once 'controller/ReportController.php';
require_once 'model/ManageAssetRequest.php';
require_once 'model/Asset.php';

$userController = new UserController();
$assetController = new AssetController();
$assetTypeController = new AssetTypeController();
$assetLocationController = new AssetLocationController();
$assetStatusController = new AssetStatusController();
$categoryController = new CategoryController();
$reportController = new ReportController();
// ประกาศค่า default ของผลลัพธ์ที่จะส่งกลับไป
$response = array();
$response['success'] = 0;
$response['error'] = 0;
$response['error_msg'] = '';
$response['result'] = null;
$data_json = array();

/*เช็คก่อนว่า เมื่อมีการเรียกเข้ามาต้องเป็น Post method เท่านั้น*/
if (!isset($_POST)) {
    $response['error'] = 1;
    $response['error_msg'] = "ไม่มีการส่งข้อมูลด้วยวิธี POST";
    $json_response = json_encode($response);
    echo $json_response;
    exit();
}
/*เมื่อผ่านการเช็ค method แล้วจะเป็นดึงค่า tag ที่ส่งมา
tag เป็นค่าสำหรับระบุว่า client เรียกใช้ api อะไร*/
if (isset($_POST['tag'])) { // คำสั่ง isset สำหรับตรวจว่ามีค่า tag ส่งมาหรือไม่?
    $tag = $_POST['tag'];
    $data_json = $_POST['data'];// ดึงค่า Json String ในตัวแปล data ที่ส่งมา

    if ($tag == 'userLogin') { // มีการเรียกใช้ api สำหรับการ login
        $result = $userController->getUser($data_json);
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }
    } elseif ($tag == 'forgetPassword') { // มีการเรียกใช้ api สำหรับการลืมรหัสผ่าน

    } elseif ($tag == 'getAllAsset') { // มีการเรียกใช้ api สำหรับการขอรายการครุภัณฑ์ทั้งหมด
        $result = $assetController->getAll();
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่พบข้อมูล';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }

    } elseif ($tag == 'getAssetByType') { // มีการเรียกใช้ api สำหรับการขอรายการครุภัณฑ์แยกตามชนิด
        $data = json_decode($data_json);
        $typeId= $data->typeId;
        $queryAssetCode = $data->queryAssetCode;
        $result = $assetController->getAssetListByType($typeId, $queryAssetCode);
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่พบข้อมูล';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }
    } elseif ($tag == 'getAssetByCategory') { // มีการเรียกใช้ api สำหรับการขอรายการครุภัณฑ์แยกตามหมวดหมู่
        $data = json_decode($data_json);
        $categoryId = $data->categoryId;
        $result = $assetController->getAssetListByCategory($categoryId);
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่พบข้อมูล';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }

    } elseif ($tag == 'getAssetDetail') { // มีการเรียกใช้ api สำหรับการขอรายละเอียดครุภัณฑ์
        $data = json_decode($data_json);
        $assetCode = $data->code;
        $result = $assetController->getAssetDetail($assetCode);
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่พบข้อมูล';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }

    } elseif ($tag == 'getAllAssetType') { // มีการเรียกใช้ api สำหรับการขอรายการชนิดของครุภัณฑ์
        $result = $assetTypeController->getAll();
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่พบข้อมูล';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }

    } elseif ($tag == 'getAllAssetLocation') { // มีการเรียกใช้ api สำหรับการขอรายการที่เก็บครุภัณฑ์
        $result = $assetLocationController->getAll();
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่พบข้อมูล';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }

    } elseif ($tag == 'getAllAssetStatus') { // มีการเรียกใช้ api สำหรับการขอรายการสถานะของครุภัณฑ์
        $result = $assetStatusController->getAll();
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่พบข้อมูล';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }

    } elseif ($tag == 'getAllAssetCategory') { // มีการเรียกใช้ api สำหรับการขอรายการหมวดหมู่ของครุภัณฑ์
        $result = $categoryController->getAll();
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่พบข้อมูล';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }

    } elseif ($tag == 'manageAsset') { // มีการเรียกใช้ api สำหรับการจัดการครุภัณฑ์
        $data = json_decode($data_json);
        $manageAssetRequest = ManageAssetRequest::create();
        $manageAssetRequest->userKey = $data->user_key;
        $manageAssetRequest->assetId = $data->asset_id;
        $manageAssetRequest->manageType = $data->manage_type;
        $manageAssetRequest->quantity = $data->quantity;
        $result = $assetController->mangeAsset($manageAssetRequest);
        if ($result == false) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่สามารถจัดการครุภัณฑ์ได้';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }

    } elseif ($tag == 'editAsset') { // มีการเรียกใช้ api สำหรับการแก้ไขครุภัณฑ์
        $data = json_decode($data_json);
        $asset = Asset::create();
        $asset->id = $data->id;
        if(!empty($data->location_id)) {
            $asset->location = $data->location_id;
        }
        if(!empty($data->status_id)) {
            $asset->status = $data->status_id;
        }
        $result = $assetController->editAsset($asset);
        if ($result == false) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่สามารถจัดการครุภัณฑ์ได้';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }

    } elseif ($tag == 'getReport') { // มีการเรียกใช้ api สำหรับการขอรายงานครุภัณฑ์
        $data = json_decode($data_json);
        $manageType = $data->manageType;
        $queryAssetCode = $data->queryAssetCode;
        $result = $reportController->getReportByManageType($manageType, $queryAssetCode);
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่พบข้อมูล';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }
    } else { // จะเข้าเงื่อไขนี้หากไม่พบ tag ที่ตรงกับที่ส่งมา
        $response['error'] = 1;
        $response['error_msg'] = "ไม่พบ tag ที่คุณต้องการ";
    }
} else {
    $response['error'] = 1;
    $response['error_msg'] = "parameter ที่ส่งมาไม่ครบ";
}
// ทำการส่งผลลัพธ์กลับไปในรูปแบบ JSON String
$json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
echo $json_response;

