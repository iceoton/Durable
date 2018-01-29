<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__ . '/../database/db.php';

class ReportController
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new DBConnection();
    }

    function getReportByManageType($manageType, $queryAssetCode)
    {
        $conn = $this->pdo->connect();
        $queryAssetCode = $queryAssetCode."%";
        $query = $conn->prepare("SELECT asset.id, asset.code, asset.name, asset.detail, asset_management.quantity, asset_management.create_date, asset_management.update_date FROM asset_management INNER JOIN asset ON  asset_management.asset_id = asset.id WHERE asset_management.manage_type=$manageType AND asset.code like '$queryAssetCode' ORDER BY asset_management.create_date");
        $query->execute();
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