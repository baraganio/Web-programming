<?php
require_once "service.php";

class Controller{

    private $service;

    public function __construct()
    {
        $this->service = new Service();
    }

    public function serve(){
        
        //Check the type of request and what we want to do
        if(isset($_POST["func"]) && $_POST["func"] === "insertfamilyrelation"){
            $this->insertFamilyRelation();
        }else if(isset($_GET["func"]) && $_GET["func"] === "displaysiblings"){
            $this->displaySiblings();
        }else if(isset($_GET["func"]) && $_GET["func"] === "displayfatherline"){
            $this->displayFahterLine();
        }else if(isset($_GET["func"]) && $_GET["func"] === "displaymotherline"){
            $this->displayMotherLine();
        }
    }

    private function displayFahterLine(){
        if (!isset($_SESSION['username']))
            return;
        echo $this->service->displayFahterLine($_SESSION['username']);
    }

    private function displayMotherLine(){
        if (!isset($_SESSION['username']))
            return;
        echo $this->service->displayMotherLine($_SESSION['username']);
    }

    private function displaySiblings(){
        if (!isset($_SESSION['username']))
            return;
        echo $this->service->displaySiblings($_SESSION['username']);
    }

    private function insertFamilyRelation(){
        if (!isset($_POST["usernametoadd"]) || !isset($_POST["userfathertoadd"]) || !isset($_POST["usermothertoadd"]))
            return;
        echo $this->service->insertFamilyRelation($_POST["usernametoadd"],$_POST["userfathertoadd"],$_POST["usermothertoadd"]);
    }
        
}

$controller = new Controller();
session_start();
$controller->serve();

?>