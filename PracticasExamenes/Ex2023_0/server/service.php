<?php
require_once "dbmanager.php";

class Service
{
    private $dbmManager;

    public function __construct()
    {
        $this->dbmManager = new DBManager();
    }

    public function selectSkilledDevs(string $skill){
        return $this->dbmManager->selectSkilledDevs($skill);
    }

    public function assignDeveloper(string $developer,string $projectsToAdd) {
        return $this->dbmManager->assignDeveloper($developer,$projectsToAdd);
    }

    public function selectMemberProjects(string $user) {
        return $this->dbmManager->selectMemberProjects($user);
    }

   /* public function checkUpdates(){
        return $this->dbmManager->checkUpdates();
    }*/

    public function selectAllProjects() {
        return $this->dbmManager->selectAllProjects();
    }

    /*public function insertLog(string $user,string $journalName,string $articleSummary, string $date){
        return $this->dbmManager->insertLog($user, $journalName, $articleSummary,$date);
    }*/
    
}

?>