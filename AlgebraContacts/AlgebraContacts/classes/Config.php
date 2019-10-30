<?php

class Config{

    public static function get($path = null){

        if($path){
            $items = require "config/$path.php";
            return $items;
        }
        return false;
    }
}

?>