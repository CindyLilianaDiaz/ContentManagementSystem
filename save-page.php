<?php ob_start();

require_once('auth.php');

//set the page title
$title = 'Save New Page';
require_once('header.php');


//store inputs in variables
	$title = $_POST['title'];
	$content = $_POST['content'];
	$page_id = $_POST['page_id'];
	$ok = true;
		
	//input validation
	if (empty($title )){
		echo 'Title is required <br/>';
		$ok = false;
	}	
	
	if ($ok){
		try{
			//connect
			require_once('db.php');
			
			
			if (!empty($page_id)){
				$sql = "UPDATE pages SET title = :title, content = :content WHERE page_id = :page_id";
			
			}
	
			else {
			//insert
				$sql = "INSERT INTO pages (title, content) VALUES(:title, :content)";
			}
			//create command object to fill the parameters values
			$cmd = $conn->prepare($sql);
			$cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
			$cmd->bindParam(':content', $content, PDO::PARAM_STR, 3000);
			
			//add athlete_id parameter if we are updating
			if(!empty($page_id)){
			$cmd->bindParam(':page_id',$page_id, PDO::PARAM_INT);
			}
	
				
			$cmd->execute();
			//disconnect
			$conn = null;
		}
		catch(exception $e){
			//email ourselves error details
			mail('cindy.liliana.diaz@gmail.com','Save Page Error', $e);
			
			//load generic error page
			header('location:error.php');
		}

			
			//redirect to list of pages
			
			header('location:pages.php');
			
	}//if $ok

		
require_once('footer.php');
ob_flush(); ?>

