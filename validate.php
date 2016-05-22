<?php ob_start(); ?>
<html>

<body>

<?php



//Store inputs
$email = $_POST['email'];
$password = hash('sha512', $_POST['password']);

try{
	//conect
	require_once('db.php');
	
	//query
	$sql = "SELECT user_id FROM administrators WHERE email = :email AND password = :password";
	
	//execute query
	$cmd = $conn->prepare($sql);
	$cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);
	$cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);
	$cmd-> execute();
	$result = $cmd->fetchAll();
	
	//count the number of rows returned by our query
	//$count = $result->rowCount();
	
	//check how many users matched the username hashed passwords
	if (count($result) >= 1) {
		echo 'Logged in Successfully.';
		
		
		//store the user identity before they leave the page
		foreach  ($result as $row) {
		
			//access the existing session
			session_start();
			
			//store the user id in the session object
			$_SESSION['user_id'] = $row['user_id'];
			
			//load administrators page
			header('location: administrators.php');
		
		} 
	
	}
	else {
		echo 'Invalid Login';
	}
	
	$conn = null;
}
catch(exception $e){
	//email ourselves error details
	mail('cindy.liliana.diaz@gmail.com','Validate Error', $e);
	
	//load generic error page
	header('location:error.php');
}


?>

</body>
</html>
<?php ob_flush(); ?>
