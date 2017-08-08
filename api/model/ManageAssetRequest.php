<?php

class ManageAssetRequest
{
    public $userKey;
    public $assetId;
    public $manageType;
    public $quantity;

    static function create(){
        $instance = new self();
        return $instance;
    }
}