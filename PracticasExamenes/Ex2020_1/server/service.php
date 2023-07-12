<?php
require_once "dbmanager.php";

class Service
{
    private $dbmManager;

    public function __construct()
    {
        $this->dbmManager = new DBManager();
    }

    public function checkUpdates(){
        return $this->dbmManager->checkUpdates();
    }

    public function selectJournals(string $username, string $journalName) {
        return $this->dbmManager->selectJournals($username,$journalName);
    }

    public function insertLog(string $user,string $journalName,string $articleSummary, string $date){
        return $this->dbmManager->insertLog($user, $journalName, $articleSummary,$date);
    }
    
}

?>