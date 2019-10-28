<?php


spl_autoload_register(function ($class){
    require_once "classes/$class.php";
});

require_once 'functions/helpers.php';

error_reporting(Config::get('app')['error_reporting']);

$host = Config::get('database')['mysql']['host'];
// DZ napraviti da ovaj način dohvaćamo propertije iz konfiguracije

//$host = Config::get('database.mysql.host'];
//for, foreach, switch


?>