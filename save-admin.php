<?php ob_start();

require_once('auth.php');

//set the page title
$title = 'Save New Information';
require_once('header.php');


	//store inputs into variables
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];
	$user_id = $_POST['user_id'];
	
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
			$password = hash('sha512',$password);
			try{
				require_once('db.php');
	
					
				//set up and execute an SQL command 
				//set up sql with parameters placeholders
				$sql = "UPDATE administrators SET email = :email, password = :password WHERE user_id = :user_id";
				
				
				//create command object to fill the parameters values
				$cmd = $conn->prepare($sql);
				$cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);
				$cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);
				
				//add user_id parameter 
				$cmd->bindParam(':user_id',$user_id, PDO::PARAM_INT);
				
				$cmd->execute();
				
				//disconnect 
				$conn =  null;
			}
			catch(exception $e){
				//email ourselves error details
				mail('cindy.liliana.diaz@gmail.com','Save Admin Error', $e);
				
				//load generic error page
				header('location:error.php');
			}

			
			//redirect
			header('location:administrators.php');
			
		}
		
require_once('footer.php');
ob_flush(); ?>
