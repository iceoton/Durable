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

    static function createLogin($data_json){
        $data = json_decode($data_json);
        $instance = new self();
        $instance->username =$data->username;
        $instance->password = md5($data->password);

        return $instance;
    }


}