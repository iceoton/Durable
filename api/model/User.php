<?php

class User
{
    public $user_key;
    public $username;
    public $password;
    public $email;
    public $name;
    public $lastname;
    public $user_photo;
    public $user_class;
    public $user_status;

    static function create(){
        $instance = new self();
        return $instance;
    }

    /**
     * แปลงข้อความ json ที่รับมาไปเป็น object ของ class user
     * @param $data_json ข้อความ json
     * @return User ที่มี username และ password
     */
    static function createLogin($data_json){
        $data = json_decode($data_json);
        $instance = new self();
        $instance->username =$data->username;
        $instance->password = md5($data->password); //เข้ารหัสข้อความที่รับมาให้เป็น MD5

        return $instance;
    }


}