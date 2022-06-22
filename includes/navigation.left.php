<!-- Left Navigation -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
	<div class="sidebar-sticky">
		<div class="sidebar-header">
			<div class="text-center">
			  <img src="images/logo.png?1" width="175" height="175" class="img-fluid" alt="Logo">
			</div>							
			<hr>
		</div>						
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link" href="index.php">
					<i class="fas fa-home"></i>
					Home
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="clients.php">
					<i class="fas fa-users"></i>
					Clients
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="activities.php">
					<i class="fas fa-tasks"></i>
					Activities
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="reports.php">
					<i class="fas fa-chart-bar"></i>
					Reports
				</a>
			</li>							
			<li class="nav-item">
				<a class="nav-link" href="administration.php">
					<i class="fas fa-sliders-h"></i>
					Administration
				</a>
			</li>
		</ul>

		<?php 

		if (isset($_SESSION["client_id"])) { 

			$client_id = $_SESSION["client_id"];

			$sql = "SELECT `first_name`, `last_name` FROM `clients` WHERE `id`=$client_id;";
			$result = $conn->query($sql);
			if ($result->num_rows == 1){
				while($row = $result->fetch_assoc()){
					$first_name = $row['first_name'];
					$last_name = $row['last_name'];
				}
			}


		?>

		<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
			<span><?php echo "$first_name $last_name ($client_id)"; ?></span>
			<a class="d-flex align-items-center text-muted" href="#">
			</a>
		</h6>
		<ul class="nav flex-column mb-2">
			<li class="nav-item">
				<a class="nav-link" href="client.php">
					<i class="fas fa-user" style="color: blue;"></i>
					&nbsp;Client Details
				</a>
			</li>           
			<li class="nav-item">
				<a class="nav-link" href="bookings.php">
					<i class="fas fa-user-clock" style="color: green;"></i>
					&nbsp;Activity Bookings
				</a>
			</li>
		</ul>

		<?php } ?>


		<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
			<span>USER</span>
			<a class="d-flex align-items-center text-muted" href="#">
				<span data-feather="plus-circle"></span>
			</a>
		</h6>
		<ul class="nav flex-column mb-2">
			<?php if ($_SESSION["user.is_admin"]==1){	
			echo"<li class='nav-item'>";
			echo"<a class='nav-link' href='users.php'>";
			echo"<i class='fas fa-users text-primary' style='color: blue;'></i>";
			echo"&nbsp;Users ";
			echo"</a>";
			echo"</li>";
			echo"<li class='nav-item'>";
			echo"<a class='nav-link' href='administration.php'>";
			echo"<i class='fas fa-sliders-h text-primary' style='color: black;'></i>";
			echo"&nbsp;Settings ";
			echo"</a>";
			echo"</li>";	
			} ?>			
			<li class="nav-item">
				<a class="nav-link" href="logoff.php">
					<i class="fas fa-sign-out text-primary" style="color: blue;"></i>
					&nbsp;Log Off
				</a>
			</li>
		</ul>

	</div>
</nav>
