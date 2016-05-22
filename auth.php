<?php

//auto check
session_start();

if(empty($_SESSION['user_id'])){
	//USER IS NOT AUTHENTICATED
	header('location: login.php');
	//stop the page
	exit();
}

?>
