<?php 
require_once "./server/dbmanager.php";

    Class Login{

        private $dbmanager;


        public function __construct() {
            $this->dbmanager = new DBManager();

            $_SESSION['username']=null;    
            
        }

        public function login(){
            if ( !isset($_POST["username"]) || !isset($_POST["parentname"]))
                return ;

            $bool = $this->dbmanager->login($_POST['username'],$_POST['parentname']);

            if($bool){
                $_SESSION['username']= $_POST['username'];
                header("Location: ./frontend/pages/homePage.html");
            }else{
                header("Location: ./index.html");
            }
        }
    }



    session_start();
    $login = new Login();
    $login->login();
?>