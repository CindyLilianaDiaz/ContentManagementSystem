<?php ob_start();

require_once('header.php'); ?>
<div class="container">
	<div class="page-header"><h1>Page Not Found!</h1></div>
	<div class="well">	
	<p>Doh!! We don't seem to have that page... try the links above.</p>
	</div>
</div>
<?php require_once('footer.php'); 

ob_flush();?>