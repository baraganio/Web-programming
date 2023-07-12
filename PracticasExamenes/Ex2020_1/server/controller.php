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
        if(isset($_GET["func"]) && $_GET["func"] === "select"){
            $this->serveSelect();
        }else if(isset($_POST["func"]) && $_POST["func"] === "insert"){
            $this->serveInsert();
        }else if(isset($_GET["func"]) && $_GET["func"] === "checkupdates"){
            $this->serveCheckUpdates();
        }
    }

    private function serveCheckUpdates(){
        
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
    }
        
}

$controller = new Controller();
session_start();
$controller->serve();

?>