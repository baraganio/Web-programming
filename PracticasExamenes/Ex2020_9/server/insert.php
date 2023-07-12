<?php
require_once "dbmanager.php";

class Insert{

    private $dbmanager;

    public function __construct()
    {
        $this->dbmanager = new DBManager();
    }

    public function insertProduct(){
        if (!isset($_POST["productName"]) || !isset($_POST["productDescription"]))
            return;
        
        $this->dbmanager->insertProduct($_POST["productName"],$_POST["productDescription"]);
    }

    
        
}

$insert = new Insert();
session_start();
$insert->insertProduct();
header("Location: .././frontend/pages/homePage.html");

?>