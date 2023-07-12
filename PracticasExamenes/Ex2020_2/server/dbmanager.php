<?php
require_once "channel.php";

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

    public function subscribe(string $user,string $channelName, string $date){

        //Get the journal with the specified name
        $journalsQuery = "SELECT * FROM channels1 WHERE name = '" . $channelName ."'" ;
        $journalsResult = $this->connection->query($journalsQuery);

        if (!$journalsResult) {
            return;
        }

        //Get the first row from the result
        $journalRow = $journalsResult->fetch_array();

        $channelId = $journalRow['id']; 
        //Store the subscribers of the channel returned
        $subscribers = $journalRow['subscribers'];

        $delimiter = ";";
        $usersSeparated = explode($delimiter, $subscribers);

        $array = array();
        $str = "";
        $find=false;
        foreach($usersSeparated as $sub){
            
            $delimiter2 = ",";
            $userDataSeparated = explode($delimiter2, $sub);
            if($userDataSeparated[0]==$user){
                if($str==""){
                    $str = $str . $userDataSeparated[0] . "," . $date;
                }else{
                    $str = $str . ";" . $userDataSeparated[0] . "," . $date;
                }
                
                $find=true;
            }else{
                if($str==""){
                    $str = $str . $userDataSeparated[0] . "," . $userDataSeparated[1];
                }else{
                    $str = $str . ";" . $userDataSeparated[0] . "," . $userDataSeparated[1];
                }
                
            }
        }
        if($find==false){
            $str = $str . ";" . $user . "," . $date;
        }

        $updateQuery = "UPDATE channels1 SET subscribers = '" . $str . "' WHERE id = " . $channelId ;
        $updateResult = $this->connection->query($updateQuery);

    }

    public function selectOwnSub(string $username){
        $query2 = "SELECT * FROM channels1" ;
        $result2 = $this->connection->query($query2);

        if (!$result2) {
            return "error query2";
        }

        //Create an empty array
        $resultArray = array();

        while ($row2 = $result2->fetch_array()) {

            $subscribers = $row2['subscribers'];

            $delimiter = ";";
            $usersSeparated = explode($delimiter, $subscribers);
            foreach($usersSeparated as $us){
                $delimiter2 = ",";
                $userDataSeparated = explode($delimiter2, $us);
                if($userDataSeparated[0]==$username){
                    $channel = new Channel((int)$row2['id'], $row2['ownerid'], $row2['name'], $row2['description'], $row2['subscribers']);
                    // Adds to the end of the array
                    $resultArray[] = json_encode($channel);
                }
            }
        }
        
        return json_encode($resultArray);

    }

    public function selectChannels(string $ownerChannelName){
        // Get the journal with the given name
        $query1 = "SELECT * FROM persons1 WHERE name = '" . $ownerChannelName ."'" ;
        $result1 = $this->connection->query($query1);

        if (!$result1) {
            return;
        }

        //Get the first row from the result
        $row = $result1->fetch_array();
        $ownerId = null;

        //Check there was a row
        if ($row) {

            //Get the id of the journal
            $ownerId = $row['id'];
        }

        //Get the articles whose author is the current one and belongs to the specified journal
        $query2 = "SELECT * FROM channels1 WHERE ownerid = '" . $ownerId ."'" ;
        $result2 = $this->connection->query($query2);

        if (!$result2) {
            return "error query2";
            
        }
        $resultArray = array();

        //Check that there is minimum one row on the result
        if ($result2->num_rows > 0) {

            //Go row by row
            while ($row2 = $result2->fetch_array()) {
                $channel = new Channel((int)$row2['id'], $row2['ownerid'], $row2['name'], $row2['description'], $row2['subscribers']);
                // Adds to the end of the array
                $resultArray[] = json_encode($channel);
            }
        }

        return json_encode($resultArray);
    }
    
}

?>