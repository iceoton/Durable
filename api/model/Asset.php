<?php

class Asset
{
    public $id;
    public $code;
    public $name;
    public $detail;
    public $category;
    public $location;
    public $source;
    public $status;
    public $unit;
    public $quantity;
    public $come_date;
    public $update_date;

    static function create(){
        $instance = new self();
        return $instance;
    }
}