<?php
require_once "article.php";

class DBManager{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "practicasexamen";
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

    public function login(string $username, string $parentname){
        $query = "SELECT * FROM familyrelations WHERE username = '" . $username . "' AND (mother = '" . $parentname . "' OR father = '" . $parentname . "')";
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


    public function fatherDescendingLine(string $username, string $line){
        $query = "SELECT * FROM familyrelations WHERE username = '" . $username ."'";
        $result = $this->connection->query($query);

        if (!$result) {
            return;
        }

        $row = $result->fetch_array();
        
        if($row['father']!=""){

            $line = $line . $row['father'] . ", ";
            return $this->fatherDescendingLine($row['father'],$line);
        }else{
            return $line;
        }

    }

    public function motherDescendingLine(string $username, string $line){
        $query = "SELECT * FROM familyrelations WHERE username = '" . $username ."'";
        $result = $this->connection->query($query);

        if (!$result) {
            return;
        }

        $row = $result->fetch_array();
        
        if($row['mother']!=""){

            $line = $line . $row['mother'] . ", ";
            return $this->motherDescendingLine($row['mother'],$line);
        }else{
            return $line;
        }

    }

    public function updateFatherName(string $username,string $fathername){

        //Get the journal with the specified name
        $query = "UPDATE familyrelations SET father = '" . $fathername . "' WHERE username = '" . $username ."'" ;
        $result = $this->connection->query($query);

        return $result;
    }

    public function updateMotherName(string $username,string $mothername){

        //Get the journal with the specified name
        $query = "UPDATE familyrelations SET mother = '" . $mothername . "' WHERE username = '" . $username ."'" ;
        $result = $this->connection->query($query);

        return $result;
    }



    //Method that will check if some new articles has been inserted
    public function checkUpdates(){

        //Store the rows where in the _SESSION variable
        $sessionRows=$_SESSION["dbrows"];

        //Check if the stored rows are -1 (means is the first time this function is called)
        if($sessionRows=="-1"){

            //Get the articles made by an different author of the current one
            $query = "SELECT * FROM articles1 WHERE user != '" . $_SESSION["username"] . "'";
            $result = $this->connection->query($query);

            //Get the number of rows the query return us
            $dbRowsCount = $result->num_rows; 

            //Store on the _SESSION variable the new number of rows
            $_SESSION["dbrows"]=$dbRowsCount;
            
            return json_encode(false);

        }else{

            //Get all the articles done by an author different of the current one, and skip the number of rows that are just stored on _SESSION variable
            $query = "SELECT * FROM articles1 WHERE user != '" . $_SESSION["username"] . "' ORDER BY id ASC LIMIT 9999 OFFSET " . (string)$_SESSION["dbrows"] ;
            $result = $this->connection->query($query);

            //Get the number of rows the query return us
            $dbRowsCount = $result->num_rows;

            //Check if there are minimum one new roe
            if($dbRowsCount>0){

                //Store on the _SESSION variable the previous number of rows plus the new ones
                $_SESSION["dbrows"]=$_SESSION["dbrows"]+$dbRowsCount;

                //Create an empty array
                $resultArray = array();

                //While exists a new row on the array
                while ($row2 = $result->fetch_array()) {

                    //Create a new article
                    $article = new Article((int)$row2['id'], $row2['user'], $row2['journalid'], $row2['summary'], $row2['date']);

                    //Adds to the array the encoded article 
                    $resultArray[] = json_encode($article);
                }
                
                //Return the encoded array
                return json_encode($resultArray);
            }

            //Return that there is no new articles
            return json_encode(false);
        }
    }

    public function insertLog(string $user,string $journalName,string $articleSummary, string $date){

        //Get the journal with the specified name
        $journalsQuery = "SELECT * FROM journals1 WHERE name = '" . $journalName ."'" ;
        $journalsResult = $this->connection->query($journalsQuery);

        if (!$journalsResult) {
            return;
        }

        //Check if there is not any journal on the result
        if (!$journalsResult->num_rows > 0) {
            //Insert into journals a new one with the specified name
            $query = "INSERT INTO journals1 (name) VALUES ('$journalName')";
            $result = $this->connection->query($query);
            //Get the journal with the specified name 
            $journalsQuery = "SELECT * FROM journals1 WHERE name = '" . $journalName ."'" ;
            $journalsResult = $this->connection->query($journalsQuery);
        }

        //Get the first row from the result
        $journalRow = $journalsResult->fetch_array();

        //Store the id of the journal returned
        $journalId = $journalRow['id'];

        //Insert a new article with all the given data
        $query = "INSERT INTO articles1 (user,journalid,summary,date) VALUES ('$user','$journalId','$articleSummary','$date')";
        $articleResult = $this->connection->query($query);

        return $articleResult;
    }

    public function selectJournals(string $username,string $journalName){
        // Get the journal with the given name
        $query1 = "SELECT * FROM journals1 WHERE name = '" . $journalName ."'" ;
        $result1 = $this->connection->query($query1);

        if (!$result1) {
            return;
        }

        //Get the first row from the result
        $row = $result1->fetch_array();
        $journalId = null;

        //Check there was a row
        if ($row) {

            //Get the id of the journal
            $journalId = $row['id'];
        }

        //Get the articles whose author is the current one and belongs to the specified journal
        $query2 = "SELECT * FROM articles1 WHERE user = '" . $username . "' AND journalid = '" . $journalId ."'" ;
        $result2 = $this->connection->query($query2);

        if (!$result2) {
            return "error query2";
            
        }
        $resultArray = array();

        //Check that there is minimum one row on the result
        if ($result2->num_rows > 0) {

            //Go row by row
            while ($row2 = $result2->fetch_array()) {
                $article = new Article((int)$row2['id'], $row2['user'], $row2['journalid'], $row2['summary'], $row2['date']);
                // Adds to the end of the array
                $resultArray[] = json_encode($article);
            }
        }

        return json_encode($resultArray);
    }
    
}

?>