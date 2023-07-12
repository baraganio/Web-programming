<?php
require_once "dbmanager.php";

class Service
{
    private $dbmManager;

    public function __construct()
    {
        $this->dbmManager = new DBManager();
    }

    public function selectChannels(string $ownerChannelName){
        return $this->dbmManager->selectChannels($ownerChannelName);
    }

    /*public function checkUpdates(){
        return $this->dbmManager->checkUpdates();
    }*/

    public function selectOwnSub(string $username) {
        return $this->dbmManager->selectOwnSub($username);
    }

    public function subscribe(string $user,string $channelName,string $date){
        return $this->dbmManager->subscribe($user, $channelName,$date);
    }
    
}

?>