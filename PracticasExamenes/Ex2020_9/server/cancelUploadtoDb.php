<?php

session_start();
$_SESSION['products']=null;
header("Location: .././frontend/pages/homePage.html");

?>