<?php
require_once "dbmanager.php";

class Service
{
    private $dbmManager;

    public function __construct()
    {
        $this->dbmManager = new DBManager();
    }

    public function keysToMatch(string $keys){
        return $this->dbmManager->keysToMatch($keys);
    }

    public function displayWebsites(){
        return $this->dbmManager->displayWebsites();
    }

    public function updateKeyWords(string $documentName, string $keyword1,string $keyword2,string $keyword3,string $keyword4,string $keyword5){
        return $this->dbmManager->updateKeyWords($documentName,$keyword1,$keyword2,$keyword3,$keyword4,$keyword5);
    }
    
}

?>