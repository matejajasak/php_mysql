<?php

class DB{

    private static $instance = null;
    private $connection;

    private function __construct(){

        $host = 'localhost';
        $user = 'root'; // ako ima _ to znači da je privatna
        $pass = '';
        $db = 'fakultet';
        $dsn = "mysql:dbname=$db;host=$host";

        try {
            $this->connection = new PDO($dsn, $user, $pass);
            echo "Connected successfully";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
    } 


    public static function getInstance(){ 
        if (!self::$instance) {
            self::$instance = new DB(); 
        }
        return self::$instance;
    }

        // predajemo query sql-u
    public function action($query){

        $result = $this->connection->prepare($query);

        $result->execute();

        return $result->fetchAll(PDO::FETCH_OBJ);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

$db = DB::getInstance();
$result = $db->action("select imeStud, prezStud from stud");

//print_r($result);

foreach ($result as $key => $student) {
    echo "<p>$student->imeStud</p>";
    echo "<p>$student->prezStud</p>";
}