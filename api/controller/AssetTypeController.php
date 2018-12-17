<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__ . '/../database/db.php';

/**
 * Class AssetTypeController
 * รวมฟังก์ชันสำหรับจัดการเรื่องที่เกี่ยวกับชนิดของครุภัณฑ์
 */
class AssetTypeController
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new DBConnection();
    }

    /**
     * ดึงรายการชนิดของครุภัณฑ์ทั้งหมด
     * @return array|int หากอ่านข้อมูลจาก Database สำเร็จจะส่งรายการชนิดของครุภัณฑ์กลับไป
     * หากไม่สำเร็จจะส่งเลข 0 กลับไป
     */
    public function getAll()
    {
        $conn = $this->pdo->connect();
        $query = $conn->prepare("SELECT * FROM asset_type");
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

    /** ดึงรายละเอียดของชนิดครุภัณฑ์นั้น ๆ
     * @param $id ไอดีของชนิดครุภัณฑ์ที่ต้องการรายละเอียด
     * @return array|int หากสำเร็จจะส่งรายละเอียดของชนิดครุภัณฑ์กลับ หากไม่สำเร็จจะส่งค่า 0 กลับ
     */
    public static function getDetail($id)
    {
        $pdo = new DBConnection();
        $conn = $pdo->connect();
        $query = $conn->prepare("SELECT * FROM asset_type WHERE id = ?");
        $values = array($id);
        $query->execute($values);
        $rowCount = $query->rowCount();
        $result = 0;
        if ($rowCount > 0) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            $query->closeCursor();
            $conn = null;
        }

        return $result;
    }
}