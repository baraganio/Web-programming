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
        if(isset($_GET["func"]) && $_GET["func"] === "selectall"){
            $this->selectAllProjects();
        }else if(isset($_GET["func"]) && $_GET["func"] === "selectmember"){
            $this->selectMemberProjects();
        }else if(isset($_POST["func"]) && $_POST["func"] === "assigndeveloper"){
            $this->assignDeveloper();
        }else if(isset($_GET["func"]) && $_GET["func"] === "selectskilleddevs"){
            $this->selectSkilledDevs();
        }
    }

    private function selectSkilledDevs(){
        if (!isset($_GET["skill"]))
            return;
        echo $this->service->selectSkilledDevs($_GET["skill"]);
    }

    private function assignDeveloper(){
        echo $this->service->assignDeveloper($_POST["developername"],$_POST["projectstoadd"]);
    }

    /*private function serveCheckUpdates(){
        
        echo $this->service->checkUpdates();
    }*/

    private function selectMemberProjects(){
        echo $this->service->selectMemberProjects($_SESSION["username"]);
    }


    private function selectAllProjects() {
        echo $this->service->selectAllProjects();
    }

    /*private function serveInsert(){

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