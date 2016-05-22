<?php ob_start();

//set the page title
$title = 'Registration Complete';
require_once('header.php');
?>
<div class="container">
	<div class="well">
		<div class="alert alert-success">
			<strong>Registration saved succesfully!</strong> Click <a href="login.php">here</a> to log in.
		</div>
	</div>
</div>
<?php
require_once('footer.php');
ob_flush(); ?>
