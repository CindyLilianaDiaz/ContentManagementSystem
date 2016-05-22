<?php ob_start();
require_once('auth.php');

//set the page title
$title = 'Save Logo';
require_once('header.php');
?>


<?php

//phptp check
	$photo = $_FILES['upload']['name'];

		//check type
		$type = $_FILES['upload']['type'];
		
		if(($type == "image/jpeg") || ($type == "image/png")){
			//give the file a unique name
			session_start();
			$photo = 'logo.png';
			
			//save the file
			$tmp_name = $_FILES['upload']['tmp_name'];
			move_uploaded_file($tmp_name,"images/$photo");		
		}	
		else {
			echo "Invalid file type";
			
		}	
		
		header('location:administrators.php');
?>

<?php
require_once('footer.php');
ob_flush(); ?>


