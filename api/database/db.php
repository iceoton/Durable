<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__ . '/../../core/config.core.php';
/*
 * Google API Key
 */
define("GOOGLE_API_KEY", ""); // Place your Google API Key

class DBConnection
{
    public $db_conn;
    public $db_name = DB_NAME;
    public $db_user = DB_USERNAME;
    public $db_pass = DB_PASSWORD;
    public $db_host = DB_HOST;

    function connect()
    {
        try {
            $this->db_conn = new PDO("mysql:host = $this->db_host;dbname=$this->db_name;charset=utf8", $this->db_user, $this->db_pass);
            return $this->db_conn;
        } catch (PDOException $e) {
            return $e->getMessage();

        }
    }
}
