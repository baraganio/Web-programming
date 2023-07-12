<?php
require_once "log.php";

class Repository{

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "logreports";
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

    public function selectAllLogs(int $pageSize, int $currentPage){
        $start = $pageSize * $currentPage;
        $query = "SELECT * FROM logs limit " . (string)$pageSize . " offset " . (string)$start;
        $result = $this->connection->query($query);

        if (!$result) {
            return;
        }

        $resultArray = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                $log = new Log((int)$row['id'], $row['user'], $row['date'], $row['type'], $row['severity'], $row['message']);
                // Adds to the end of the array
                $resultArray[] = json_encode($log);
            }
        }
        return json_encode($resultArray);
    }

    public function selectFilteredLogs(String $username, String $type, String $severity, int $pageSize,int $currentPage ){
        $start = $pageSize * $currentPage;
        if($username!="all"){
            if($type!="all" && $severity!="all"){
                $query = "SELECT * FROM logs WHERE user = '" . $username . "' AND type = '" . $type . "' AND severity = '" . $severity . "'limit " . (string)$pageSize . " offset " . (string)$start;
            } else if($type=="all" && $severity=="all"){
                $query = "SELECT * FROM logs WHERE user = '" . $username . "'limit " . (string)$pageSize . " offset " . (string)$start;
            }else if($type="all"){
                $query = "SELECT * FROM logs WHERE user = '" . $username . "' AND severity = '" . $severity . "'limit " . (string)$pageSize . " offset " . (string)$start;
            }else if($severity="all"){
                $query = "SELECT * FROM logs WHERE user = '" . $username . "' AND type = '" . $type . "'limit " . (string)$pageSize . " offset " . (string)$start;
            }
        }else{
            if($type!="all" && $severity!="all"){
                $query = "SELECT * FROM logs WHERE type = '" . $type . "' AND severity = '" . $severity . "'limit " . (string)$pageSize . " offset " . (string)$start;
            } else if($type="all"){
                $query = "SELECT * FROM logs WHERE severity = '" . $severity . "'limit " . (string)$pageSize . " offset " . (string)$start;
            }else if($severity="all"){
                $query = "SELECT * FROM logs WHERE type = '" . $type . "'limit " . (string)$pageSize . " offset " . (string)$start;
            }
        }
        
        $result = $this->connection->query($query);

        if (!$result) {
            return;
        }

        $resultArray = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                $log = new Log((int)$row['id'], $row['user'], $row['date'], $row['type'], $row['severity'], $row['message']);
                // Adds to the end of the array
                $resultArray[] = json_encode($log);
            }
        }
        return json_encode($resultArray);
    }

    public function insertLog(string $user,string $date,string $type, string $severity, string $message){
        $query = "INSERT INTO logs (user,date,type,severity,message) VALUES ('$user','$date','$type','$severity','$message' )";
        $result = mysqli_query($this->connection,$query);
        return $result;
    }

    public function deleteLog(int $logId)
    {
        $query = "DELETE FROM logs WHERE id = " . $logId;
        $result = mysqli_query($this->connection,$query);
        return $result;
    }
}
?>