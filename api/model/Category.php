<?php

class Category
{
    public $id;
    public $code;
    public $name;

    static function create(){
        $instance = new self();
        return $instance;
    }
}