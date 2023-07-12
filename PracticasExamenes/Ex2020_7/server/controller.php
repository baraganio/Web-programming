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
        if(isset($_GET["func"]) && $_GET["func"] === "updatekeywords"){
            $this->updateKeyWords();
        }else if(isset($_GET["func"]) && $_GET["func"] === "displaywebsites"){
            $this->displayWebsites();
        }else if(isset($_GET["func"]) && $_GET["func"] === "keystomatch"){
            $this->keysToMatch();
        }
    }

    private function keysToMatch(){
        if ( !isset($_GET["keys"]))
            return ;
        
        echo $this->service->keysToMatch($_GET["keys"]);
    }

    private function displayWebsites(){
        echo $this->service->displayWebsites();
    }

    private function updateKeyWords(){
        if ( !isset($_GET["documentname"]) || !isset($_GET["keyword1"]) || !isset($_GET["keyword2"]) || !isset($_GET["keyword3"]) || !isset($_GET["keyword4"]) || !isset($_GET["keyword5"]))
            return ;
        
        echo $this->service->updateKeyWords($_GET["documentname"],$_GET["keyword1"],$_GET["keyword2"],$_GET["keyword3"],$_GET["keyword4"],$_GET["keyword5"]);
    }
        
}

$controller = new Controller();
session_start();
$controller->serve();

?>