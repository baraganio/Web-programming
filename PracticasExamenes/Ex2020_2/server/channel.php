<?php
class Channel implements JsonSerializable{

    private $id;
    private $ownerid;
    private $name;
    private $description;
    private $subscribers;

    public function __construct($id, $ownerid, $name, $description, $subscribers){
        $this->id=$id;
        $this->ownerid=$ownerid;
        $this->name=$name;
        $this->description=$description;
        $this->subscribers=$subscribers;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getOwnerid(){
        return $this->ownerid;
    }

    public function setOwnerid($ownerid){
        $this->ownerid = $ownerid;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getSescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getSubscribers(){
        return $this->subscribers;
    }

    public function setSubscribers($subscribers){
        $this->subscribers = $subscribers;
    }

    public function jsonSerialize(){
        return [
            'id' => $this->id,
            'ownerid' => $this->ownerid,
            'name' => $this->name,
            'description' => $this->description,
            'subscribers' => $this->subscribers,
        ];
    }
}
?>