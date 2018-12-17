<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__ . '/../database/db.php';

/**
 * Class SourceController
 * รวมฟังก์ชันสำหรับจัดการเรื่องที่เกี่ยวกับแหล่งที่มาครุภัณฑ์
 */
class SourceController
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new DBConnection();
    }

    /**
     * ดึงรายละเอียดของแหล่งที่มาของครุภัณฑ์นั้น ๆ
     * @param $id ไอดีของแหล่งที่มาครุภัณฑ์ที่ต้องการรายละเอียด
     * @return array|int หากสำเร็จจะส่งรายละเอียดของแหล่งที่มาครุภัณฑ์กลับ หากไม่สำเร็จจะส่งค่า 0 กลับ
     */
    public static function getDetail($id){
        $pdo = new DBConnection();
        $conn = $pdo->connect();
        $query = $conn->prepare("SELECT * FROM source WHERE id = ?");
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