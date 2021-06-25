<?php
include_once 'SelectTrait.php';
include_once 'UpdateTrait.php';
include_once 'InsertTrait.php';
include_once 'DeleteTrait.php';
class Database
{
    use Select,Update,Insert,Delete;
    private $tableName;
    private $conn;
    private const HOST='localhost';
    private $prepare;
    private $errors=null;

    public function __construct($tableName)
        {
            $this->tableName=$tableName;
            $this -> connect(); 
        }
    private function connect()
        {
            try {
                $dsn = "mysql:host=". self::HOST .";dbname=test;charset=utf8";
                $options=[
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION , 
                    PDO::ATTR_PERSISTENT => true ,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ];
                $this -> conn = new PDO($dsn , 'root' , '' , $options);
            } catch (PDOException $e) {
                echo $e -> getMessage();
            }
        }
    private function query($sql)
        {
            $this -> prepare =  $this -> conn -> prepare($sql);
        }
    private function bind($key , $value){
            $this -> prepare -> bindParam($key , $value);
        }
    private function execute(){
            return  $this -> prepare -> execute();
        }
    private function bindValues($data)
        {
            $data=array_values($data);
            for ($i=0; $i <count($data) ; $i++) 
            {
                $this->bind($i+1,$data[$i]); 
            }
        }
    private function count(){
            $this -> execute();
            return $this -> prepare ->rowCount();
        }
    private function cheakValues($data)
        {
            foreach ($data as $key => $value) {
            $val = trim($value);
            $val = htmlspecialchars(strip_tags($val));
            if(empty($val)){
                $this -> setError($key , $key.' can`t be empty' );
            } 
            }
            return $this->errors;
        }
    private function setError($key , $value) {
            $this -> errors[$key] = $value ;
        }
}
