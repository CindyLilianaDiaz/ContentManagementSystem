<?php ob_start();
//aut ccheck
require_once('auth.php');

//set the page title
$title = 'Page Management';
require_once('header.php');

//check if we have an page ID in the querystring
		//isset means does this value has something or it is null
	if(isset($_GET['page_id'])) {
	//if we do, store in a variable
	$page_id = base64_decode($_GET['page_id']);
	
		try{
		    //connect
		   	require_once('db.php');
		   	
		    //select all the data from the same page_id
		   	$sql = "SELECT * FROM pages WHERE page_id = :page_id";
		    //store each value from the database into a variable
		   	$cmd = $conn->prepare($sql);
		   	$cmd->bindParam(':page_id', $page_id , PDO::PARAM_INT);
			$cmd->execute();
			$result = $cmd->fetchAll();
			
			foreach( $result as $row){
				$title_page = $row['title'];
				$content= $row['content'];
			}
		
		    //disconnect
			$conn = null;
		}
		catch(exception $e){
		//email ourselves error details
		mail('cindy.liliana.diaz@gmail.com','Add/Edit Page Error', $e);
			
		//load generic error page
		header('location:error.php');
		}	


	
	}




?>
<div class="container">
	
	<div class="page-header">
		<h1>Page Management</h1>
	</div>
	<div class="well">
		<form action="save-page.php" method="post" class="form-horizontal">
			<h5>* indicates required fields</h5>
		
				
				<div class="form-group">
					<label for="title" class="col-sm-2">Title:*</label>
					<input name="title" required value="<?php echo $title_page; ?>" />
				</div>
				
				<div class="form-group">
					<label for="content" class="col-sm-2">Content:</label>
					<textarea  rows="8" cols="100" name="content" ><?php echo $content; ?></textarea>
				</div>
				<input type="hidden" name="page_id" value="<?php echo $page_id;?>" />
				<div class="col-sm-offset-2">
					<input type="submit" value="Save" class="btn btn-primary"/>
				</div>
		</form>
	</div>
</div>
<?php
require_once('footer.php');
ob_flush(); ?>
