<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__ . '/../database/db.php';

/**
 * Class AssetLocationController
 * รวมฟังก์ชันสำหรับจัดการเรื่องที่เกี่ยวกับสถานที่เก็บครุภัณฑ์
 */
class AssetLocationController
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new DBConnection();
    }

    /**
     * ดึงรายการสถานที่เก็บครุภัณฑ์ทั้งหมด
     * @return array|int หากอ่านข้อมูลจาก Database สำเร็จจะส่งรายการสถานที่เก็บครุภัณฑ์กลับไป
     * หากไม่สำเร็จจะส่งเลข 0 กลับไป
     */
    public function getAll(){
        $conn = $this->pdo->connect();
        $query = $conn->prepare("SELECT * FROM location");
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
     * ดึงรายละเอียดของสถานที่เก็บครุภัณฑ์นั้น ๆ
     * @param $id ไอดีของสถานที่เก็บครุภัณฑ์ที่ต้องการรายละเอียด
     * @return array|int หากสำเร็จจะส่งรายละเอียดของสถานที่เก็บครุภัณฑ์กลับ หากไม่สำเร็จจะส่งค่า 0 กลับ
     */
    public static function getDetailById($id){
        $pdo = new DBConnection();
        $conn = $pdo->connect();
        $query = $conn->prepare("SELECT * FROM location WHERE id = ?");
        $values = array($id);
        $query->execute($values);
        $rowCount = $query->rowCount();
        $result = 0;
        if($rowCount > 0) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            $query->closeCursor();
            $conn = null;
        }

        return $result;
    }
}