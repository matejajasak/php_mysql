<?php

class Input{

    // privatni konstruktor da se ne može
    // instrancirati objekt kao new Input()
    // već se metode koriste isključivo statičkim pozivanjem
    private function __construct(){}

    public static function exists($type = 'post'){

        switch ($type) {
            case 'post':
                return !empty($_POST) ? true : false;
                break;
            case 'get':
                return !empty($_GET) ? true : false;
                break;
            default:
                return false;
                break;
        }
    }

    public static function get($name){

        if (isset($_POST[$name])) {
            return $_POST[$name];
        }
        elseif(isset($_GET[$name])){
            return $_GET[$name];
        }
        return '';
    }
}