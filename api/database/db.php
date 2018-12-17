<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__.'/../../core/config.core.php';
/*
 * Google API Key
 * สำหรับใช้งานการส่ง notification
 */
define("GOOGLE_API_KEY", ""); // Place your Google API Key

/**
 * Class DBConnection
 * รวมฟังก์ชันสำหรับเชื่อมต่อฐานข้อมูล
 */
class DBConnection
{
    public $db_name = DB_NAME; //ชื่อฐานข้อมูล
    public $db_user = DB_USERNAME; // ชื่อเข้าใช้งาน
    public $db_pass = DB_PASSWORD; // รหัสผ่าน
    public $db_host = DB_HOST; // Url ที่อยู่ของฐานข้อมูล

    function connect()
    {
        try {
            $db_conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name;charset=utf8", $this->db_user, $this->db_pass);
            // set the PDO error mode to exception
            $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db_conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $db_conn;
        } catch (PDOException $e) {
            echo "มัน error $e->getMessage()";
            return false;
        }
    }
}
