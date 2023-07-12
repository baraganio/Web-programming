<?php
require_once "website.php";

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

    public function keysToMatch(string $keys){

        $delimiter = ",";
        $keysSeparated = explode($delimiter, $keys);

        $allDocumentsQuery = "SELECT * FROM documents7";
        $allDocumentsResult = $this->connection->query($allDocumentsQuery);

        if (!$allDocumentsResult) {
            return;
        }

        $resultArray=array();

        while ($row = $allDocumentsResult->fetch_array()) {

            $documentName = $row['name'];
            $documentKeywords = array($row['keyword1'],$row['keyword2'],$row['keyword3'],$row['keyword4'],$row['keyword5']);

            $matches=0;
            foreach($documentKeywords as $docKey){
                foreach($keysSeparated as $key){
                    if($key==$docKey){
                        $matches++;
                    }
                }
            }

            if($matches==3){
                $resultArray[] = $documentName;
            }         
        }

        return json_encode($resultArray);

    }

    public function displayWebsites(){
        $query = "SELECT * FROM websites7";
        $result = $this->connection->query($query);

        if (!$result) {
            return;
        }

        $resultArray=array();

        while ($row = $result->fetch_array()) {

            $webId = $row['id'];

            $query2 = "SELECT * FROM documents7 WHERE idwebsite = '" . $webId . "'";
            $result2 = $this->connection->query($query2);

            $counter=0;
            while ($row2 = $result2->fetch_array()) {
                $counter++;
            }

            $website = new Website((int)$row['id'], $row['url'], $counter);
            // Adds to the end of the array
            $resultArray[] = json_encode($website);
        }

        return json_encode($resultArray);
    }

    public function updateKeyWords(string $docuementName, string $keyword1,string $keyword2,string $keyword3,string $keyword4,string $keyword5){
        $query = "UPDATE documents7 SET keyword1 = '" . $keyword1 . "', keyword2 = '" . $keyword2 . "',  keyword3 = '" . $keyword3 . "', keyword4 = '" . $keyword4 . "', keyword5 = '" . $keyword5 . "' WHERE name = '" . $docuementName . "'";
        $result = $this->connection->query($query);
        return $result;
    }
    
}

?>