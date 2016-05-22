
<footer class="footer-distributed" >

			<div class="footer-left">
				
				<h3><img src="logo_footer.png" alt="pizza"></h3>
				
				<p class="footer-links">
					<?php
						//if user is authenticated, show the navigation links
						session_start();
						if(!empty($_SESSION['user_id'])){	
						?>		
								<a href="administrators.php">Administrators</a>
								·
								<a href="add-page.php">Add Page</a>
								·
								<a href="pages.php">Pages</a>
								·
								<a href="logo.php">Logo</a>	
								·
								<a href="page.php">Public Site</a>
								·
								<a href="logout.php">Log Out</a>
					<?php
					}else {
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
							echo '<a href="default.php?page_id=' . $row['page_id'] .'">' . $row['title'] . '</a>·';		
							}
									
							//disconnect 
							$conn =  null;
							
						}
						catch(exception $e){
							//email ourselves error details
							mail('cindy.liliana.diaz@gmail.com','Footer Error', $e);
							
							//load generic error page
							header('location:error.php');
						}

					?>
							<a href="register.php">Register</a>
							·
							<a href="login.php">Log in</a>
					<?php
					}	
					?>
				</p>

				<p class="footer-company-name">PizzaBuddies &copy; 2015</p>
			</div>

			<div class="footer-center">

				<div>
					<i class="fa fa-map-marker"></i>
					<p><span>240 Hickling Trail</span> Barrie, Ontario</p>
				</div> 

				<div>
					<i class="fa fa-phone"></i>
					<p>+1 705 123456</p>
				</div>

				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="mailto:support@pizzabuddies.com">support@pizzabuddies.com</a></p>
				</div>

			</div>

			<div class="footer-right">

				<p><strong>Hours of Operation</strong></p>
				<p></p>
				<p><span>Mon-Fri 11:00 am - 12:00 am </span></p>
				
				<p><span>Sat-Sun 11:00 am -  2:00 am</span></p>
				

				


				<div class="footer-icons">

					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>
					<a href="#"><i class="fa fa-github"></i></a>

				</div>

			</div>

		</footer>

</body>

</html>
