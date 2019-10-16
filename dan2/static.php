<?php

class User {

    public static $f_name = 'Pero';
    public static $l_name = 'Perić';

    public static function addUser($fn, $ln){
        self::$f_name = $fn;
        self::$l_name = $ln;
    }
}

/* OVO NE RADI
$user = new User();
echo $user->f_name;
*/


/*
User::addUser('Marko', 'Markić');
echo User::$f_name."\t";
echo User::$l_name;
*/