<?php
require_once "dbmanager.php";

class Service
{
    private $dbmManager;

    public function __construct()
    {
        $this->dbmManager = new DBManager();
    }

    public function fatherDescendingLine(string $username){
        $line="";
        return json_encode($this->dbmManager->fatherDescendingLine($username, $line));
    }

    public function motherDescendingLine(string $username){
        $line="";
        return json_encode($this->dbmManager->motherDescendingLine($username, $line));
    }

    public function updateFatherName(string $username, string $fathername){
        
        return $this->dbmManager->updateFatherName($username,$fathername);
    }

    public function updateMotherName(string $username, string $mothername){
        
        return $this->dbmManager->updateMotherName($username,$mothername);
    }

    /*public function checkUpdates(){
        return $this->dbmManager->checkUpdates();
    }

    public function selectJournals(string $username, string $journalName) {
        return $this->dbmManager->selectJournals($username,$journalName);
    }

    public function insertLog(string $user,string $journalName,string $articleSummary, string $date){
        return $this->dbmManager->insertLog($user, $journalName, $articleSummary,$date);
    }*/
    
}

?>