<?php

class DBManager{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "examen";
    private $connection=Null;

    public function __construct(){
        $this->makeConnection();
    }

    public function __destruct(){
         $this->connection->close();
    }

    private function makeConnection(){
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->connection->connect_error) {
            die("Connection to DB failed due to an error: " + $this->connection->connect_error);
        }
    }

    public function displayFahterLine(string $username, string $line){
        //Get user id from the given name
        $query1 = "SELECT * FROM users WHERE username = '" . $username . "'";
        $result1 = $this->connection->query($query1);

        if (!$result1) {
            return;
        }

        $row1 = $result1->fetch_array();
        $userId = null;

        //Check there was a row
        if ($row1) {
            //Get the id of the user
            $userId = $row1['id'];
        }

        //Get the family relation from the given userid
        $query2 = "SELECT * FROM familyrelations WHERE userid = '" . $userId . "'";
        $result2 = $this->connection->query($query2);
        
        if (!$result2) {
            return;
        }

        $row2 = $result2->fetch_array();
        $fatherName = null;

        //Check there was a row
        if ($row2) {
            //Get the name of the father
            $fatherName = $row2['father'];
        }

        //If there is father
        if($fatherName!=""){
            if($line!=""){
                $line = $line . " -> " . $fatherName . ", ";
            }else{
                $line = "Father descending line ,";
            }
            //$line = $line . $row2['father'] . ", ";
            return $this->displayFahterLine($row2['father'],$line);
            
        }else{
            return $line;
        }        
    }

    public function displayMotherLine(string $username, string $line){
        //Get user id from the given name
        $query1 = "SELECT * FROM users WHERE username = '" . $username . "'";
        $result1 = $this->connection->query($query1);

        if (!$result1) {
            return;
        }

        $row1 = $result1->fetch_array();
        $userId = null;

        //Check there was a row
        if ($row1) {
            //Get the id of the user
            $userId = $row1['id'];
        }

        //Get the family relation from the given userid
        $query2 = "SELECT * FROM familyrelations WHERE userid = '" . $userId . "'";
        $result2 = $this->connection->query($query2);
        
        if (!$result2) {
            return;
        }

        $row2 = $result2->fetch_array();
        $motherName = null;

        //Check there was a row
        if ($row2) {
            //Get the name of the mother
            $motherName = $row2['mother'];
        }

        //If there is mother
        if($motherName!=""){
            if($line!=""){
                $line = $line . " -> " . $motherName . ", ";
            }else{
                $line = "Mother descending line ,";
            }
            //$line = $line . $row2['mother'] . ", ";
            return $this->displayMotherLine($row2['mother'],$line);
            
        }else{
            return $line;
        }        
    }

    public function displaySiblings(string $username){
        $query1 = "SELECT * FROM users WHERE username = '" . $username . "'";
        $result1 = $this->connection->query($query1);

        if (!$result1) {
            return;
        }

        $row1 = $result1->fetch_array();
        //$userId = null;

        //Check there was a row
        if ($row1) {
            //Get the id of the user
            $userId = $row1['id'];
        }

        $query2 = "SELECT * FROM familyrelations WHERE userid = '" . $userId . "'";
        $result2 = $this->connection->query($query2);
        
        if (!$result2) {
            return;
        }

        $row2 = $result2->fetch_array();
        //$fatherName = null;
        //$motherName = null;

        //Check there was a row
        if ($row2) {
            //Get the id of the journal
            $fatherName = $row2['father'];
            $motherName = $row2['mother'];
        }

        $query3 = "SELECT * FROM familyrelations WHERE father = '" . $fatherName . "' OR mother = '" . $motherName . "'";
        $result3 = $this->connection->query($query3);

        if (!$result3) {
            return;
        }

        $resultArray=array();
        while ($row3 = $result3->fetch_array()) {
            $siblingId = $row3['userid'];

            $query4 = "SELECT * FROM users WHERE id = '" . $siblingId . "' AND username != '" . $username . "'";
            $result4 = $this->connection->query($query4);

            $row4 = $result4->fetch_array();
            //$siblingName = null;
    
            //Check there was a row
            if ($row4) {
                //Get the id of the user
                $siblingName = $row4['username'];
                // Adds to the end of the array
                $resultArray[] = $siblingName;
            }            
        }

        return json_encode($resultArray);
    }

    public function login(string $username, string $fathername , string $mothername){
        $query1 = "SELECT * FROM users WHERE username = '" . $username . "'";
        $result1 = $this->connection->query($query1);

        if (!$result1) {
            return;
        }

        $row = $result1->fetch_array();
        $userId = null;

        //Check there was a row
        if ($row) {
            //Get the id of the journal
            $userId = $row['id'];
        }

        $query = "SELECT * FROM familyrelations WHERE userid = '" . $userId . "' AND (father = '" . $fathername . "' OR mother = '" . $mothername . "')";
        $result = $this->connection->query($query);
        if (!$result) {
            return;
        }

        if ($result->num_rows > 0) {
            return true;
            
        }else{
            return false;
        }
    }

    public function insertFamilyRelation(string $usernametoadd, string $userfathertoadd, string $usermothertoadd){
        $query1 = "SELECT * FROM users WHERE username = '" . $usernametoadd . "'";
        $result1 = $this->connection->query($query1);

        if (!$result1) {
            return false;
        }

        $row = $result1->fetch_array();
        $userId = null;

        //Check there was a row
        if ($row) {
            //Get the id of the user
            $userId = $row['id'];
        }else{
            return json_encode(false);
        }

        //

        

        //   

        $query2 = "INSERT INTO familyrelations (userid,father,mother) VALUES('$userId','$userfathertoadd','$usermothertoadd')";
        $result2 = $this->connection->query($query2);

        if (!$result2) {
            return;
        }

        return $result2;
    }
    
}

?>