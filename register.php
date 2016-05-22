<?php ob_start();

//set the page title
$title = 'Registration';
require_once('header.php');

?>

<div class="container">
	<div class="page-header">
		<h1>Registration</h1>
	</div>
	<div class="well">
	<h5>* indicates required fields</h5>

		<form method="post" action="save-registration.php" class="form-horizontal">
			<div class="form-group">
			    <label for="email" class="col-sm-2">*Email:</label>
			    <input name="email" type="email" required />
			</div>
			<div class="form-group">
			    <label for="password" class="col-sm-2">*Password:</label>
			    <input type="password" name="password" required />
			</div>
			<div class="form-group">
			    <label for="confirm" class="col-sm-2">*Confirm Password:</label>
			    <input type="password" name="confirm" required />
			</div>
			<div class="col-sm-offset-2">
				<input type="submit" value="Register" class="btn btn-primary"/>
			</div>
		</form>
	</div>
</div>

<?php 
require_once('footer.php');
ob_flush(); ?>