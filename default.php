<?php ob_start();


//set the page title
$title = 'PizzaBuddies';
require_once('header.php');
?>

<div class="container">
	<?php 
		if(isset($_GET['page_id'])){
			$page_id = $_GET['page_id'];
			//we can check if it is empty, give it a default value
		try{
		
			//connect
			require('db.php');
			
			//get the page content
			$sql = "SELECT * FROM pages WHERE page_id=:page_id";
			
			//execute query
			$cmd = $conn->prepare($sql);
			$cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
			$cmd->execute();
			$result = $cmd->fetchAll();
			
			//loop through the results
			foreach ($result as $row){
				echo '<div class="page-header"><h1>' . $row['title'] .'</h1></div>
				<div class="well"><p>' . $row['content'] .'</p></div>';
			}
			//disconnect
			$conn = null;
			
		}
		catch(exception $e){
			//email ourselves error details
			mail('cindy.liliana.diaz@gmail.com','Page Error', $e);
			
			//load generic error page
			header('location:error.php');
		}

		}
		else {
			echo '<div class="page-header"><h1>Public Site</h1></div>
				  <div class="well"><p>To visit your website, please <a href="logout.php">log out</a>. You will then see the links on the navigation bar of all the pages you created.</p></div>';
		}
	?>



</div>


<?php
require_once('footer.php');
ob_flush(); ?>
