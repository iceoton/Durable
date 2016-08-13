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
        $query = $conn->prepare("SELECT asset.id, asset.code, asset.name, detail, quantity, come_date, update_date, unit.name as unit FROM asset INNER JOIN unit ON asset.unit_id = unit.id");
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