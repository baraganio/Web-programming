<?php
class Upload{

    public function __construct()
    {
        
    }

    public function uploadProducts(){
        if (!isset($_POST["productName2"]) || !isset($_POST["productQuantity"]))
            return;

        if (!isset($_SESSION['products']) || $_SESSION['products']==null){
            $_SESSION['products']=$_SESSION['products'] . $_POST["productName2"] . "," . $_POST["productQuantity"];
        }else{
            $_SESSION['products']=$_SESSION['products'] . ";" . $_POST["productName2"] . "," . $_POST["productQuantity"];
        }        
    }

    
        
}

$upload = new Upload();
session_start();
$upload->uploadProducts();
header("Location: .././frontend/pages/homePage.html");

?>