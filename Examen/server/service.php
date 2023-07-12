<?php
require_once "dbmanager.php";

class Service
{
    private $dbmManager;

    public function __construct()
    {
        $this->dbmManager = new DBManager();
    }

    public function displayFahterLine(string $username){
        $line="";
        return json_encode($this->dbmManager->displayFahterLine($username,$line));
    }

    public function displayMotherLine(string $username){
        $line="";
        return json_encode($this->dbmManager->displayMotherLine($username,$line));
    }

    public function displaySiblings(string $username){
        return $this->dbmManager->displaySiblings($username);
    }

    public function insertFamilyRelation(string $usernametoadd, string $userfathertoadd, string $usermothertoadd){
        
        return $this->dbmManager->insertFamilyRelation($usernametoadd,$userfathertoadd,$usermothertoadd);
    }
    
}

?>