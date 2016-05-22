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
	$page_id = base64_decode($_GET['page_id']);
	
		try{
			//connect
			require_once('db.php');
				
			//set up the SQL DELETE command
			$sql = "DELETE FROM pages WHERE page_id = :page_id";
			
			//execute the deletion
			$cmd = $conn->prepare($sql);
			$cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
			$cmd->execute();
			
			//disconnect
			$conn = null;
		}
		catch(exception $e){
			//email ourselves error details
			mail('cindy.liliana.diaz@gmail.com','Delete Page Error', $e);
			
			//load generic error page
			header('location:error.php');
		}

	
	//redirect to update page.php
	header('location:pages.php');
	
	?>

</body>

</html>
<?php ob_flush();?>
