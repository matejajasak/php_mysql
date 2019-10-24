<?php
class DB{
    private static $instance = null;
    private $connection;
    private $connection_prepare;
    private $error;
    private $results;
    private $count = 0;
    private $config;

    private function __construct(){

        $this->config = Config::get('database');
        $driver = $this->config['driver'];

        $host = $this->config[$driver]['host'];
        $user = $this->config[$driver]['user'];
        $pass = $this->config[$driver]['pass'];
        $db = $this->config[$driver]['db'];
        $charset = $this->config[$driver]['charset'];
        $dsn = "$driver:dbname=$db;host=$host";

        try {
            $this->connection = new PDO($dsn,$user,$pass);
            echo "Connected successfully";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
    }
    public static function getInstance(){
        
        if(!self::$instance){
            self::$instance = new DB();
        }
        return self::$instance;
    }
    private function action($action, $table, $where = array()){
        if ($where) {
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];
            $sql = "$action FROM $table WHERE $field $operator ?";
            if(!$this->query($sql, array($value))->error){
                return $this;
            }
            
        }else{
            $sql = "$action FROM $table";
            if(!$this->query($sql)->error){
                return $this;
            }
        }
        return false;
    }
    private function query($sql, $params = array()){
        $this->error = false;
        if($this->connection_prepare = $this->connection->prepare($sql)){
            $counter = 1;
            if (!empty($params)) {
                foreach ($params as $param) {
                    $this->connection_prepare->bindValue($counter, $param);
                    $counter++;
                }
            }
            if ($this->connection_prepare->execute()) {
                $this->results = $this->connection_prepare->fetchAll(Config::get('database')['fetch']);
                $this->count = $this->connection_prepare->rowCount();
            }else{
                $this->error = true;
                die($this->connection_prepare->errorInfo()[2]);
            }
        }
        return $this;
    }
    public function delete($table, $where){
        return $this->action('DELETE', $table, $where);
    }
    public function select($fields, $table, $where = array()){
        return $this->action("SELECT $fields", $table, $where);
    }
    public function insert($table, $columns){
        // INSERT INTO users (name,username,password) VALUES (?,?,?);
        $sql = "INSERT INTO $table ($columns->ključevi) VALUES ($columns->vrijednosti)";
        //DZ - složiti $sql i $values array sa vrijednostima
        if(!$this->query($sql, $values)->error){
            return $this;
        }
        return false;
    }

    public function update($table, $id, $fields){
        //UPDATE $table SET $fields WHERE id=$id;
    }


    /* GETTERI */
    public function error(){
        return $this->error;
    }
    public function results(){
        return $this->results;
    }
    public function count(){
        return $this->count;
    }
    
}
$db = DB::getInstance();
//$result = $db->delete('users', ['id', '=', 1]);
//$result = $db->select('name', 'users', ['id', '=', 3]);
//$result = $db->select('*', 'users');
//var_dump($result);

 /* 
 DOMAĆA ZADAĆA
$result = $db->insert('users', [
    'username'  => 'alex',
    'password'  => 'pass',
    'salt'      => 'asdfasdasdasdsadas',
    'name'      => 'Aleksandar',
    'role_id'   => 1
]);


$result = $db->update('users', 3, 'ime=Ivan');
*/
