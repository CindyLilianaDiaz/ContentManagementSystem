<?php ob_start();
require_once('auth.php');

//set the page title
$title = 'Edit Administrator';
require_once('header.php');

//check if we have an user ID in the querystring
		//isset means does this value has something or it is null
	if(isset($_GET['user_id'])) {
	//if we do, store in a variable
	$user_id = base64_decode($_GET['user_id']);
	
		try{
		    //connect
		   	require_once('db.php');
		   	
		    //select all the data for the selected subscriber
		   	$sql = "SELECT * FROM administrators WHERE user_id = :user_id";
		    //store each value from the database into a variable
		   	$cmd = $conn->prepare($sql);
		   	$cmd->bindParam(':user_id', $user_id , PDO::PARAM_INT);
			$cmd->execute();
			$result = $cmd->fetchAll();
			
			foreach( $result as $row){
				$email = $row['email'];	
			}
		
		    //disconnect
			$conn = null;
		}
		catch(exception $e){
			//email ourselves error details
			mail('cindy.liliana.diaz@gmail.com','Edit Admin Error', $e);
			
			//load generic error page
			header('location:error.php');
		}

	}
?>

<div class="jumbotron">

	<div class="container">
	
		<h1>EDIT INFORMATION</h1>
		
		
		<form method="post" action="save-admin.php" class="form-horizontal">
			<h4>* Required Information</h4>
			<div class="form-group">
			    <label for="email" class="col-sm-2">*Email:*</label>
			    <input name="email" type="email" required value="<?php echo $email; ?>" />
			</div>
			<div class="form-group">
			    <label for="password" class="col-sm-2">*Password:*</label>
			    <input name="password"  type="password" required/>
			</div>
			<div class="form-group">
				    <label for="confirm"class="col-sm-2">*Confirm Password:</label>
				    <input type="password" name="confirm" required />
				</div>
			<input type="hidden" name="user_id" value="<?php echo $user_id;?>" />
			<input type="submit" value="Save" class="btn btn-primary"/>
		</form>
		
	</div>
</div>
<?php 
require_once('footer.php');
ob_flush(); ?>

