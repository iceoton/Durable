<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__.'/../database/db.php';
require_once __DIR__.'/../model/User.php';

/**
 * Class UserController
 * รวมฟังก์ชันสำหรับจัดการเรื่องที่เกี่ยวกับผู้ใช้งาน
 */
Class UserController
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new DBConnection();
    }

    /**
     * ดึงข้อมูลรายละเอียดของผู้ใช้งาน
     * @param $data_json ชื่อ รหัสผ่าน ของผู้ใช้งานที่ต้องการ
     * @return array|int หากสำเร็จจะส่งรายละเอียดของผู้ใช้งานกลับ
     * หากไม่สำเร็จจะส่งค่า 0 กลับ
     */
    public function getUser($data_json){
        $user = User::createLogin($data_json);
        $conn = $this->pdo->connect();
        $query = $conn->prepare("SELECT * FROM user WHERE (username = ? OR email = ?) AND password = ? AND user_status = 1");
        $values = array($user->username,$user->username, $user->password);
        $query->execute($values);
        $rowCount = $query->rowCount();
        $result = 0;
        if($rowCount > 0){
            $result = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            $query->closeCursor();
            $conn = null;
        }
        return $result;

    }
}