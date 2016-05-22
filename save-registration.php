<?php ob_start();

//set the page title
$title = 'Save Registratiom';
require_once('header.php');


	//store inputs in variables
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];
	$ok = true;
		
	//input validation
	if (empty($email)){
		echo 'Email is required <br/>';
		$ok = false;
	}	
	
	if (empty($password )){
		echo 'Password is required <br/>';
		$ok = false;
	}
	
	if ($password != $confirm ){
		echo 'Password must match <br/>';
		$ok = false;
	}
	
	if ($ok){
		try{
			//connect
			require('db.php');
			
			//check to see the email doesn't exist already
			$sql = "SELECT * FROM administrators WHERE email = :email";
			$cmd = $conn->prepare($sql);
			$cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);
			$cmd-> execute();
			$result = $cmd->fetchAll();
			
			//check how many emails matched the email user input
			if (count($result) >= 1) {
				echo 'This administrator already exists. Please enter a different one';
			}//end if
			
			else{
			
				//hash the password
				$password = hash('sha512',$password);
				
				
				
				//insert
				$sql = "INSERT INTO administrators (email, password) VALUES(:email, :password)";
		
				//create command object to fill the parameters values
				$cmd = $conn->prepare($sql);
				$cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);
				$cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);
				
				$cmd->execute();
				//disconnect
				$conn = null;
						
			//redirect to succesfull registration page
			
			header('location:successful-regis.php');
		
			}//end of else
		}
		catch(exception $e){
			//email ourselves error details
			mail('cindy.liliana.diaz@gmail.com','Save Registration Error', $e);
			
			//load generic error page
			header('location:error.php');
		}
	
			
			
	}//end if $ok


require_once('footer.php');
ob_flush(); ?>
