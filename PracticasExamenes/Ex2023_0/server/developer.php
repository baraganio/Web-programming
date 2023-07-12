<?php
class Developer implements JsonSerializable{

    private $id;
    private $name ;
    private $age;
    private $skills ;

    public function __construct($id , $name , $age, $skills ){
        $this->id=$id;
        $this->name=$name;
        $this->age=$age;
        $this->skills=$skills;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getAge(){
        return $this->age;
    }

    public function setAge($age){
        $this->age = $age;
    }

    public function getSkills(){
        return $this->skills;
    }

    public function setSkills($skills){
        $this->skills = $skills;
    }

    public function jsonSerialize(){
        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => $this->age,
            'skills' => $this->skills,
        ];
    }
}
?>