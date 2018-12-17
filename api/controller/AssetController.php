<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__ . '/../database/db.php';
require_once __DIR__ . '/CategoryController.php';
require_once __DIR__ . '/StatusController.php';
require_once __DIR__ . '/LocationController.php';
require_once __DIR__ . '/SourceController.php';
require_once __DIR__ . '/UnitController.php';

/**
 * Class AssetController
 * รวมฟังก์ชันสำหรับจัดการเรื่องที่เกี่ยวกับครุภัณฑ์ เช่น ดึงรายการทครุภัณฑ์ทั้งหมด
 */
class AssetController
{
    public $link;
    public $categoryController;
    public $statusController;

    function __construct()
    {
        $this->link = new DBConnection();
        $this->categoryController = new CategoryController();
        $this->statusController = new StatusController();
    }

    /**
     * ดึงรายการครุภัณฑ์ทั้งหมด
     * @return array|int หากอ่านข้อมูลจาก Database สำเร็จจะส่งรายการครุภัณฑ์
     * หากไม่สำเร็จจะส่งเลข 0 กลับไป
     */
    function getAll()
    {
        $conn = $this->link->connect();
        $query = $conn->prepare("SELECT asset.id, asset.code, asset.name, detail, quantity, come_date, update_date, status.code as status_code FROM asset INNER JOIN status ON asset.status_id = status.id ORDER BY update_date DESC");
        $values = array();
        $query->execute($values);
        $rowCount = $query->rowCount();
        $result = 0;
        if ($rowCount > 0) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $query->closeCursor();
            $conn = null;
        }

        return $result;
    }

    /**
     * ดึงรายการครุภัณฑ์โดยแยกตามชนิดของครุภัณฑ์
     * @param $assetType ชนิดของครุภัณฑ์
     * @param $queryAssetCode รหัสครุภัณฑ์ที่ต้องการทำการกรอง
     * @return array|int หากอ่านข้อมูลจาก Database สำเร็จจะส่งรายการครุภัณฑ์
     * หากไม่สำเร็จจะส่งเลข 0 กลับไป
     */
    function getAssetListByType($assetType, $queryAssetCode)
    {
        $conn = $this->link->connect();
        $query = $conn->prepare("SELECT asset.id, asset.code, asset.name, detail, quantity, come_date, update_date, unit.name as unit 
                                           FROM asset INNER JOIN unit ON asset.unit_id = unit.id WHERE asset.type_id=? AND asset.code like ?");
        $values = array($assetType, "$queryAssetCode%");
        $query->execute($values);
        $rowCount = $query->rowCount();
        $result = 0;
        if ($rowCount > 0) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $query->closeCursor();
            $conn = null;
        }

        return $result;
    }

    /**
     * ดึงรายการครุภัณฑ์โดยแยกตามหมวดหมู่ของครุภัณฑ์
     * @param $categoryId ไอดีของหมวดหมู่ครุภัณฑ์
     * @return array|int หากอ่านข้อมูลจาก Database สำเร็จจะส่งรายการครุภัณฑ์
     * หากไม่สำเร็จจะส่งเลข 0 กลับไป
     */
    function getAssetListByCategory($categoryId)
    {
        $conn = $this->link->connect();
        $query = $conn->prepare("SELECT asset.id, asset.code, asset.name, detail, quantity, come_date, update_date, unit.name as unit 
                                           FROM asset INNER JOIN unit ON asset.unit_id = unit.id WHERE asset.category_id=? ");
        $values = array($categoryId);
        $query->execute($values);
        $rowCount = $query->rowCount();
        $result = 0;
        if ($rowCount > 0) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $query->closeCursor();
            $conn = null;
        }

        return $result;
    }

    /**
     * ดึงข้อมูลรายละเอียดของครุภัณฑ์ตามรหัสครุภัณฑ์ที่ส่งมา
     * @param $assetCode รหัสครุภัณฑ์ที่ต้องการข้อมูล
     * @return array|int หากพบข้อมูลจะส่ง array ของรายละเอียดครุภัณฑ์กลับไป
     * หากไม่สำเร็จจะส่งเลข 0 กลับไป
     */
    function getAssetDetail($assetCode)
    {
        $conn = $this->link->connect();
        $query = $conn->prepare("SELECT * FROM asset WHERE code = ?");
        $values = array($assetCode);
        $query->execute($values);
        $rowCount = $query->rowCount();
        $result = 0;
        if ($rowCount > 0) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            $query->closeCursor();
            $conn = null;

            $category = $this->categoryController->getDetail($result["category_id"]);
            unset($result["category_id"]);
            $result["category"] = $category;

            $status = $this->statusController->getDetail($result["status_id"]);
            unset($result["status_id"]);
            $result["status"] = $status;

            $location = LocationController::getDetail($result["location_id"]);
            unset($result["location_id"]);
            $result["location"] = $location;

            $source = SourceController::getDetail($result["source_id"]);
            unset($result["source_id"]);
            $result["source"] = $source;

            $unit = UnitController::getDetail($result["unit_id"]);
            unset($result["unit_id"]);
            $result["unit"] = $unit;
        }
        return $result;
    }

    /**
     * ดึงข้อมูลรายละเอียดของครุภัณฑ์ตามไอดีครุภัณฑ์ที่ส่งมา
     * @param $assetId ไอดีของครุภัณฑ์ที่ต้องการข้อมูล
     * @return array|int หากพบข้อมูลจะส่ง array ของรายละเอียดครุภัณฑ์กลับไป
     * หากไม่สำเร็จจะส่งเลข 0 กลับไป
     */
    function getAssetDetailById($assetId)
    {
        $conn = $this->link->connect();
        $query = $conn->prepare("SELECT * FROM asset WHERE id = ?");
        $values = array($assetId);
        $query->execute($values);
        $rowCount = $query->rowCount();
        $result = 0;
        if ($rowCount > 0) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            $query->closeCursor();
            $conn = null;

            $category = $this->categoryController->getDetail($result["category_id"]);
            unset($result["category_id"]);
            $result["category"] = $category;

            $status = $this->statusController->getDetail($result["status_id"]);
            unset($result["status_id"]);
            $result["status"] = $status;

            $location = LocationController::getDetail($result["location_id"]);
            unset($result["location_id"]);
            $result["location"] = $location;

            $source = SourceController::getDetail($result["source_id"]);
            unset($result["source_id"]);
            $result["source"] = $source;

            $unit = UnitController::getDetail($result["unit_id"]);
            unset($result["unit_id"]);
            $result["unit"] = $unit;
        }
        return $result;
    }

    /**
     * จักการข้อมูลครุภัณฑ์ ตามชนิดการจัดการที่ส่งมา เช่น ยืม คืน ส่งซ่อม
     * @param $manageAssetRequest คำร้องขอจัดการข้อมูลที่ประกอบไปด้วย ไอดีของครุภัณฑ์ ชนิดการจัดการ ปริมาณ และผู้ใช้งานที่จัดการครุภัณฑ์
     * @return bool หากสำเร็จจะส่งค่า true หากไม่สำเร็จจะส่งค่า false กลับ
     */
    function mangeAsset($manageAssetRequest)
    {
        $currentDateTime = date('Y-m-d H:i:s');
        $conn = $this->link->connect();
        $query = $conn->prepare("INSERT INTO asset_management (user_key, asset_id, manage_type, quantity, create_date, update_date) 
                                           VALUES (?, ?, ?, ?, ?, ?)");
        $values = array($manageAssetRequest->userKey,
            $manageAssetRequest->assetId,
            $manageAssetRequest->manageType,
            $manageAssetRequest->quantity,
            $currentDateTime,
            $currentDateTime);

        $query->execute($values);
        $rowCount = $query->rowCount();
        echo "count row insert =" . $rowCount;
        $result = false;
        if ($rowCount > 0) {
            $result = true;
            $query->closeCursor();
            $conn = null;
        }

        return $result;
    }

    /**
     * แก้ไขข้อมูลครุภัณฑ์
     * @param $assetChange ข้อมูลครุภัณฑ์ที่จะทำการแก้ไข
     * @return array|bool หากสำเร็จจะส่งรายละเอียดครุภัณฑ์ที่แก้ไขสำเร็จกลับไป
     * หากไม่สำเร็จจะส่งค่า false กลับไป
     */
    function editAsset($assetChange)
    {
        $currentDateTime = date('Y-m-d H:i:s');
        $conn = $this->link->connect();
        $stmt = $conn->prepare("UPDATE asset SET location_id=? , status_id=? , update_date=? WHERE id=?");
        $values = array(
            $assetChange->location,
            $assetChange->status,
            $currentDateTime,
            $assetChange->id);

        $stmt->execute($values);
        $rowCount = $stmt->rowCount();
        //echo "count row update =" . $rowCount;
        $result = false;
        if ($rowCount > 0) {
            $result = $this->getAssetDetailById($assetChange->id);
            $stmt->closeCursor();
            $conn = null;
        }

        return $result;
    }
}