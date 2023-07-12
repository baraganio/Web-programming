<?php
require_once "Service.php";
class Controller{

    private $service;

    public function __construct()
    {
        $this->service = new Service();
    }

    public function serve(){
        
        if(isset($_POST["func"]) && $_POST["func"] === "insert"){
            $this->serveInsert();
        }else if (isset($_GET) && isset($_GET["func"]) && $_GET["func"] === "select") {
            $this->serveSelect();
        }else if($_POST["func"] && $_POST["func"] === "delete"){
            $this->serveDelete();
        }
    }

    private function serveDelete() {
        if (!isset($_POST["logId"]))
            return;
        echo $this->service->deleteLog($_POST["logId"]);
    }

    private function serveSelect() {
        if (!isset($_GET["username"]) || !isset($_GET["type"]) || !isset($_GET["severity"]) || !isset($_GET["pageSize"]) || !isset($_GET["currentPage"]))
            return;
        echo $this->service->selectLogs($_GET["username"],$_GET["type"], $_GET["severity"], (int) $_GET["pageSize"], (int) $_GET["currentPage"]);
    }

    private function serveInsert(){
        if (!isset($_POST["user"]) || !isset($_POST["type"]) || !isset($_POST["severity"]) || !isset($_POST["message"]))
            return;

            $this->service->insertLog($_POST["user"], date('Y-m-d H:i:s') ,$_POST["type"],$_POST["severity"],$_POST["message"]);
    }
}

$controller = new Controller();
$controller->serve();
?>