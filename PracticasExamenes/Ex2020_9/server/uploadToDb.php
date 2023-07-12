<?php

require_once "dbmanager.php";
class UploadToDb{

    private $dbmanager;

    public function __construct()
    {
        $this->dbmanager = new DBManager();
    }

    public function uploadProducts(){
        $array=$_SESSION['products'];
        $username=$_SESSION['username'];
        $delimiter = ";";
        $usersSeparated = explode($delimiter, $array);
        foreach($usersSeparated as $prodData){
            $delimiter = ",";
            $userDataSeparated = explode($delimiter, $prodData);
            $query = "INSERT INTO orders9 (user,productid,quantity) VALUES ('$username','$userDataSeparated[0]','$userDataSeparated[1]')";
            $productsResult = $this->dbmanager->connection->query($query);
            $_SESSION['products']="";
        }
    }

    
        
}

$uploadDb = new UploadToDb();
session_start();
$uploadDb->uploadProducts();
header("Location: .././frontend/pages/homePage.html");

?>