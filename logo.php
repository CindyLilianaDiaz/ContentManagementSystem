<?php ob_start();
require_once('auth.php');

//set the page title
$title = 'Upload Logo';
require_once('header.php');
?>

<div class="container">
	<div class="page-header">
		<h1>Upload Logo</h1>
	</div>
	<div class="well">
		<form action="save-upload.php" method="post" enctype="multipart/form-data">					
				<div class="form-group">
					<label for="upload">Upload logo:</label>
					<input  type="file" name="upload"/>
				</div>
				<div class="col-sm-offset-2">
					<input type="submit" value="Upload" class="btn btn-primary"/>
				</div>

		</form>
	</div>
</div>
<?php
require_once('footer.php');
ob_flush(); ?>
