<?php
class Article implements JsonSerializable{

    private $id;
    private $user;
    private $journalid;
    private $summary;
    private $date;

    public function __construct($id, $user, $journalid, $summary, $date){
        $this->id=$id;
        $this->user=$user;
        $this->journalid=$journalid;
        $this->summary=$summary;
        $this->date=$date;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
    }

    public function getJounalid(){
        return $this->journalid;
    }

    public function setJournalid($journalid){
        $this->journalid = $journalid;
    }

    public function getSummary(){
        return $this->summary;
    }

    public function setSummary($summary){
        $this->summary = $summary;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function jsonSerialize(){
        return [
            'id' => $this->id,
            'user' => $this->user,
            'journalid' => $this->journalid,
            'summary' => $this->summary,
            'date' => $this->date,
        ];
    }
}
?>