<?php ob_start();

//access the current session
session_start();

//remove any variables from the session
session_unset();

//kill the session
session_destroy();
 
//redirect

header('location:login.php');

ob_flush();
?>