<?php ob_start();
//auto check
require_once('auth.php');

//set the page title
$title = 'Administrators';
require_once('header.php');

try{
	//connect to db
	require_once('db.php');
	
	//set up an SQL query
	$sql = "SELECT * FROM administrators;";
	
	//execute the query and store results
	$cmd = $conn->prepare($sql);
	$cmd->execute();
		//array that holds all our rows and comlumns
	$result = $cmd->fetchAll();
	
	echo '<div class="container">';
	echo'<div class="page-header"><h1>Administrators</h1></div>';
	//start the table and add headings BEFORE our loop (only once)
	echo'<div class="well"><table class="table table-condensed"><thead><th>Email</th><th>Edit</><th>Delete</></thead><tbody>';
	
	//Loop through the query and stores the result (when we input data it is one at a time)
	foreach($result as $row){
		//display-create new row and three column for each records
					//better than using index
		echo '<tr><td>' . $row['email'] . '</td>
			<td><a href = "edit-admin.php?user_id=' . base64_encode($row['user_id']) .'">Edit</a></td>				
			<td><a href = "delete-admin.php?user_id=' . base64_encode($row['user_id']) .'"
			onclick = "return confirm(\'Are you sure you want to delete this?\');">Delete</a></td></tr>';
	}
	
	//close table body and the table itself
	echo '</tbody></table></div>';
	echo '</div>';
	
	//disconnect
	$conn = null;
}
catch(exception $e){
	//email ourselves error details
	mail('cindy.liliana.diaz@gmail.com','Administrators Page Error', $e);
	
	//load generic error page
	header('location:error.php');
}
?>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<?php
require_once('footer.php');
ob_flush(); ?>

