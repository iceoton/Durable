<?php
header('Content-type:application/json;charset=utf-8');
date_default_timezone_set('Asia/Bangkok');
// 0 :Turn off all error reporting
error_reporting(1);
ini_set('display_errors', 'on');

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
if (isset($_POST['tag'])) {
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

    } elseif ($tag == 'getAllAsset') {
        $result = $assetController->getAll();
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่พบข้อมูล';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }

    } elseif ($tag == 'getAssetByType') {
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
    } elseif ($tag == 'getAssetByCategory') {
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

    } elseif ($tag == 'getAssetDetail') {
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

    } elseif ($tag == 'getAllAssetType') {
        $result = $assetTypeController->getAll();
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่พบข้อมูล';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }

    } elseif ($tag == 'getAllAssetLocation') {
        $result = $assetLocationController->getAll();
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่พบข้อมูล';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }

    } elseif ($tag == 'getAllAssetStatus') {
        $result = $assetStatusController->getAll();
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่พบข้อมูล';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }

    } elseif ($tag == 'getAllAssetCategory') {
        $result = $categoryController->getAll();
        if ($result == 0) {
            $response['error'] = 1;
            $response['error_msg'] = 'ไม่พบข้อมูล';
        } else {
            $response['result'] = $result;
            $response['success'] = 1;
        }

    } elseif ($tag == 'manageAsset') {
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

    } elseif ($tag == 'editAsset') {
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

    } elseif ($tag == 'getReport') {
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

