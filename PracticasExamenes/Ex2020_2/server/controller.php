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
        }else if(isset($_POST["func"]) && $_POST["func"] === "subscribe"){
            $this->serveInsert();
        }else if(isset($_GET["func"]) && $_GET["func"] === "selectownsub"){
            $this->serveOwnSub();
        }
    }

    private function serveOwnSub(){
        
        echo $this->service->selectOwnSub($_SESSION["username"]);
    }


    private function serveSelect() {
       if ( !isset($_GET["ownerchannelname"]))
            return ;
        echo $this->service->selectChannels($_GET["ownerchannelname"]);
    }

    private function serveInsert(){

        //Check if exists
        if (!isset($_POST["channelname"]))
            return;
        
        $this->service->subscribe($_SESSION["username"],$_POST["channelname"],date('Y-m-d H:i:s'));
    }
        
}

$controller = new Controller();
session_start();
$controller->serve();

?>