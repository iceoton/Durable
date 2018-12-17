<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__ . '/../database/db.php';

/**
 * Class StatusController
 * รวมฟังก์ชันสำหรับจัดการเรื่องที่เกี่ยวกับสถานะครุภัณฑ์
 */
class StatusController
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new DBConnection();
    }

    /**
     * ดึงรายละเอียดของสถานะครุภัณฑ์นั้น ๆ
     * @param $id ไอดีของสถานะครุภัณฑ์ที่ต้องการรายละเอียด
     * @return array|int หากสำเร็จจะส่งรายละเอียดของสถานะครุภัณฑ์กลับ หากไม่สำเร็จจะส่งค่า 0 กลับ
     */
    public function getDetail($id){
        $conn = $this->pdo->connect();
        $query = $conn->prepare("SELECT * FROM status WHERE id = ?");
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