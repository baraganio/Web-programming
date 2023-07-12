<?php
require_once "dbmanager.php";

class SelectAllProducts{

    private $dbmanager;

    public function __construct()
    {
        $this->dbmanager = new DBManager();
    }

    public function serveSelect() {
       if ( !isset($_GET["startingString"]))
            return ;
        $this->selectAllProducts($_GET["startingString"]);
    }

    private function selectAllProducts(string $startingString){
        $query = "SELECT * FROM products9 WHERE name LIKE '" . $startingString . "%'";
        $productsResult = $this->dbmanager->connection->query($query);

        if (!$productsResult) {
            return "error query";
        }

        $resultArray = array();

        //Check that there is minimum one row on the result
        if ($productsResult->num_rows > 0) {
            
            //Go row by row
            while ($row2 = $productsResult->fetch_array()) {
                //$product = new Product((int)$row2['id'], $row2['name'], $row2['description']);
                // Adds to the end of the array
                //$resultArray[] = $product;
                echo '<p>Id:' .  $row2['id'] . '.    Name:' . $row2['name'] . '.    Description:' . $row2['description'] .'</p>';
            }
        }
    }
}

$select = new SelectAllProducts();
$select->serveSelect();

?>