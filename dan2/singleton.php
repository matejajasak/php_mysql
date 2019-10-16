<?php

class DB{

    private static $instance = null;

//privatnu klasu ne možemo pozvati van objekt, već unutar 
    private function __construct(){} // ovaj dio se ne može instancirati u objekt
    
    public static function getInstance(){ 
        if (!self::$instance) {
            self::$instance = new DB(); //ovdje se poziva privatna klasa
        }
        return self::$instance;
    }
}

// $db = new DB(); => OVO NE
$db = DB::getInstance();