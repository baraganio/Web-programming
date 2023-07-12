<?php 

    //Start a session
    session_start();

    $_SESSION['username']=null;

    
    if(isset($_POST['username'])){
        //Get from the form the username value
        $_SESSION['username']= $_POST['username'];
        
    }

    if (!$_SESSION['username']){
        echo "Please login";
        exit;
    }

    //Change the current html to the specified one
    header("Location: ./frontend/pages/homePage.html");

?>