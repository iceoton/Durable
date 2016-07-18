<?php
date_default_timezone_set('Asia/Bangkok');
ini_set('display_errors', 'on');

require_once __DIR__.'/../database/db.php';
require_once __DIR__.'/../model/User.php';

Class UserController
{
    public $link;

    function __construct()
    {
        $this->link = new DBConnection();
    }

    function getUser($data_json){
        $user = User::createLogin($data_json);
        $conn = $this->link->connect();
        $query = $conn->prepare("SELECT * FROM user WHERE username = ? OR email = ? AND password = ? AND user_status = 1");
        $values = array($user->username,$user->username, $user->password);
        $query->execute($values);
        $rowCount = $query->rowCount();
        if($rowCount > 0){
            return $query->fetchAll(PDO::FETCH_ASSOC)[0];
        }else{
            return 0;
        }

    }
}