
<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta content="width=device-width, initial-scale=1" name="viewport">

<title><?php echo $title; ?></title>
<!--Favicon   -->
<link rel="icon" type="image/icon" href="favicon.ico"/>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<link href="style.css" rel="stylesheet">

<!-- Google Maps -->
<style>
      #map-canvas {
        width: 500px;
        height: 400px;
      }

    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>
	function initialize() {
	  var myLatlng = new google.maps.LatLng(44.407875, -79.653503);
	  var mapOptions = {
	    zoom: 12,
	    center: myLatlng
	  }
	  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	
	  var marker = new google.maps.Marker({
	      position: myLatlng,
	      map: map,
	      title: 'Hello World!'
	  });
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);

    </script>
</head>

<body>

<nav id='cssmenu'>
	
	<a  href="#">
	<!-- Show uploaded logo -->
	<img src="images/logo.png" alt="Logo" />
	</a>
		<ul >
	<?php
	//if user is authenticated, show the navigation links
	session_start();
	if(!empty($_SESSION['user_id'])){	
	?>		
			<li><a href="administrators.php">Administrators</a></li>
			<li><a href="add-page.php">Add Page</a></li>
			<li><a href="pages.php">Pages</a></li>
			<li><a href="logo.php">Logo</a></li>	
			<li><a href="default.php">Public Site</a></li>	
			<li><a href="logout.php">Log Out</a></li>
	<?php
	}
	else {
		try{
			//connect
			require('db.php');
		
			//get the link of the pages
			$sql = "SELECT * FROM pages";
			//execute query
			$cmd = $conn->prepare($sql);
			$cmd->execute();
			$result = $cmd->fetchAll();
			
			foreach ($result as $row){
			echo '<li><a href="default.php?page_id=' . $row['page_id'] .'">' . $row['title'] . '</a></li>';		
			}
					
			//disconnect 
			$conn =  null;
		}
		catch(exception $e){
			//email ourselves error details
			mail('cindy.liliana.diaz@gmail.com','Header Error', $e);
			
			//load generic error page
			header('location:error.php');
		}

	?>
			<li><a href="register.php">Register</a></li>
			<li><a href="login.php">Log in</a></li>
	<?php
	}	?>
	</ul>
</div>
</nav>


