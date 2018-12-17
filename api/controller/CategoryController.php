<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__ . '/../database/db.php';
require_once __DIR__ . '/../model/Category.php';

/**
 * Class CategoryController
 * รวมฟังก์ชันสำหรับจัดการเรื่องที่เกี่ยวกับหมวดหมูของครุภัณฑ์
 */
class CategoryController
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new DBConnection();
    }

    /**
     * ดึงรายการหมวดหมู่ครุภัณฑ์ทั้งหมด
     * @return array|int หากอ่านข้อมูลจาก Database สำเร็จจะส่งรายการหมวดหมู่ครุภัณฑ์ทั้งหมดกลับไป
     * หากไม่สำเร็จจะส่งเลข 0 กลับไป
     */
    public function getAll(){
        $categoryList = array();
        $conn = $this->pdo->connect();
        $query = $conn->prepare("SELECT * FROM category");
        $values = array();
        $query->execute($values);
        $rowCount = $query->rowCount();
        $result = 0;
        if ($rowCount > 0) {
            // วน loop fetch ออกมาทีละตัว
            // ยัดใส่ object
            // เอา object ยัดใส่ array
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $query->closeCursor();
            $conn = null;
        }

        return $result;
    }

    /**
     * ดึงรายละเอียดของหมวดหมู่ครุภัณฑ์นั้น ๆ
     * @param $id ไอดีของหมวดหมู่ครุภัณฑ์ที่ต้องการรายละเอียด
     * @return array|int หากสำเร็จจะส่งรายละเอียดของหมวดหมู่ครุภัณฑ์กลับ หากไม่สำเร็จจะส่งค่า 0 กลับ
     */
    public function getDetail($id){
        $conn = $this->pdo->connect();
        $query = $conn->prepare("SELECT * FROM category WHERE id = ?");
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