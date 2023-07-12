<?php
class Project implements JsonSerializable{

    private $id;
    private $projectManagerID ;
    private $name ;
    private $description;
    private $members ;

    public function __construct($id, $projectManagerID , $name , $description, $members ){
        $this->id=$id;
        $this->projectManagerID=$projectManagerID;
        $this->name=$name;
        $this->description=$description;
        $this->members=$members;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getProjectManagerID(){
        return $this->projectManagerID;
    }

    public function setProjectManagerID($projectManagerID){
        $this->projectManagerID = $projectManagerID;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getMembers(){
        return $this->members;
    }

    public function setMembers($members){
        $this->members = $members;
    }

    public function jsonSerialize(){
        return [
            'id' => $this->id,
            'projectManagerID' => $this->projectManagerID,
            'name' => $this->name,
            'description' => $this->description,
            'members' => $this->members,
        ];
    }
}
?>