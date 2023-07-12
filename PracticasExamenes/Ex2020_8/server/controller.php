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
        if(isset($_GET["func"]) && $_GET["func"] === "updatefather"){
            $this->updateFatherName();
        }else if(isset($_GET["func"]) && $_GET["func"] === "updatemother"){
            $this->updateMotherName();
        }else if(isset($_GET["func"]) && $_GET["func"] === "fatherline"){
            $this->fatherDescendingLine();
        }else if(isset($_GET["func"]) && $_GET["func"] === "motherline"){
            $this->motherDescendingLine();
        }
    }

    private function fatherDescendingLine(){
        
        echo $this->service->fatherDescendingLine($_SESSION["username"]);
    }

    private function motherDescendingLine(){
        
        echo $this->service->motherDescendingLine($_SESSION["username"]);
    }

    private function updateFatherName(){
        
        echo $this->service->updateFatherName($_SESSION["username"],$_GET["fathername"]);
    }

    private function updateMotherName(){
        
        echo $this->service->updateMotherName($_SESSION["username"],$_GET["mothername"]);
    }

    /*private function serveCheckUpdates(){
        
        echo $this->service->checkUpdates();
    }


    private function serveSelect() {
       if ( !isset($_GET["journalname"]))
            return ;
        echo $this->service->selectJournals($_SESSION["username"],$_GET["journalname"]);
    }

    private function serveInsert(){

        //Check if exists
        if (!isset($_POST["journalname"]) || !isset($_POST["articlesummary"]))
            return;
        
        $this->service->insertLog($_SESSION["username"],$_POST["journalname"],$_POST["articlesummary"],date('Y-m-d H:i:s'));
    }*/
        
}

$controller = new Controller();
session_start();
$controller->serve();

?>