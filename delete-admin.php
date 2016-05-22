<?php ob_start();
require_once('auth.php');
?>
<!DOCTYPE html >
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 2</title>
</head>

<body>

	<?php
	//check the url for an id value & store in a variable
	$user_id = base64_decode($_GET['user_id']);
		try{
			//connect
			require_once('db.php');
				
			//set up the SQL DELETE command
			$sql = "DELETE FROM administrators WHERE user_id = :user_id";
			
			//execute the deletion
			$cmd = $conn->prepare($sql);
			$cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$cmd->execute();
			
			//disconnect
			$conn = null;
		}
		catch(exception $e){
			//email ourselves error details
			mail('cindy.liliana.diaz@gmail.com','Delete Admin Error', $e);
			
			//load generic error page
			header('location:error.php');
		}

	
	//redirect to update administrators.php
	header('location:administrators.php');
	
	?>

</body>

</html>
<?php ob_flush();?>
