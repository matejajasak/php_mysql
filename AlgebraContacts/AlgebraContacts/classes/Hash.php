<?php

class Hash{

    public static function make($input, $salt = ''){
        return hash('sha256', $input . $salt);
    }

    public static function salt(){
        return uniqid();
    }

    public static function unique(){
        return self::make(uniqid());
    }
}


