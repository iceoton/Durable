<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__ . '/../database/db.php';

/**
 * Class ReportController
 * รวมฟังก์ชันสำหรับจัดการเรื่องที่เกี่ยวกับรายงานครุภัณฑ์
 */
class ReportController
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new DBConnection();
    }

    /**
     * ดึงรายงานครุภัณฑ์ตามชนิดการจัดการ และรหัสครุภัณฑ์นั้น ๆ
     * @param $manageType ชนิดการจัดการครุภัณฑ์
     * @param $queryAssetCode รหัสครุภัณฑ์สำหรับกรองเฉพาะครุภัณฑ์ที่ต้องการ
     * @return array|int หากสำเร็จจะส่งรายการครุภัณฑ์ที่เกี่ยวข้องกับเงื่อนไขที่ส่งมากลับ
     * หากไม่สำเร็จจะส่งค่า 0 กลับ
     */
    function getReportByManageType($manageType, $queryAssetCode)
    {
        $conn = $this->pdo->connect();
        $queryAssetCode = $queryAssetCode."%";
        $query = $conn->prepare("SELECT asset.id, asset.code, asset.name, asset.detail, asset_management.quantity, asset_management.create_date, asset_management.update_date FROM asset_management INNER JOIN asset ON  asset_management.asset_id = asset.id WHERE asset_management.manage_type=$manageType AND asset.code like '$queryAssetCode' ORDER BY asset_management.create_date");
        $query->execute();
        $rowCount = $query->rowCount();
        $result = 0;
        if ($rowCount > 0) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $query->closeCursor();
            $conn = null;
        }

        return $result;
    }

}