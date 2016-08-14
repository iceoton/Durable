<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__ . '/../database/db.php';

class StatusController
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new DBConnection();
    }

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