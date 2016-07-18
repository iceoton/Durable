<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__ . '/../database/db.php';

class AssetController
{
    public $link;

    function __construct()
    {
        $this->link = new DBConnection();
    }

    function getAll()
    {
        $conn = $this->link->connect();
        $query = $conn->prepare("SELECT * FROM asset");
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
}