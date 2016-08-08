<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__ . '/../database/db.php';
require_once __DIR__ . '/../model/Category.php';
class CategoryController
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new DBConnection();
    }

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
}