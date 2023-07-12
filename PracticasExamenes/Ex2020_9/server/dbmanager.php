<?php
require_once "product.php";

class DBManager{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "practicasexamen";
    public $connection=Null;

    public function __construct(){
        $this->makeConnection();
    }

    public function __destruct(){
         $this->connection->close();
    }

    private function makeConnection(){
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->connection->connect_error) {
            die("Connection to DB failed due to an error: " + $this->connection->connect_error);
        }
    }

    public function insertProduct(string $productName, string $productDescription){
        $query = "INSERT INTO products9 (name,description) VALUES ('$productName','$productDescription')";
        $articleResult = $this->connection->query($query);
    }
    
}

?>