<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Activity Bookings"; ?>
<!doctype html>
<html lang="en">
	<?php // Add HTML Head with CSS Links
	include("includes/head.php"); ?>
	<body>
		<?php // Add Top Navigation
		include("includes/navigation.top.php"); ?>
		<div class="container-fluid">
			<div class="row">
				<?php // Add Left Navigation
				include("includes/navigation.left.php"); ?>
				
				<!-- Content -->
				<?php
				
				$data_error = 0;

				// Retrieve client_id from session data
				$client_id = $_SESSION['client_id'];

				// Validate ID
				if (!validate_string_isnumber($client_id)) {$data_error = 1;}

				if ($data_error == 0){
					$sql = "SELECT * FROM `view_clients` WHERE `ID`=$client_id;";
					$result = $conn->query($sql);
					if ($result->num_rows == 1){
						while($row = $result->fetch_assoc()){
							$user_id = $row['created_by_user_id'];
							$first_name = $row['first_name'];
							$last_name = $row['last_name'];
							$address_1 = $row['address_1'];
							$address_2 = $row['address_2'];
							$town_city = $row['town_city'];
							$postcode = $row['postcode'];
							$telephone = $row['telephone'];
							$mobile = $row['mobile'];
							$email = $row['email'];
							$date_of_birth = date("d/m/Y", strtotime($row['date_of_birth']));
							$gender_id = $row['gender_id'];
							$gender_description = $row['gender_description'];
							$ethnic_group_id = $row['ethnic_group_id'];
							$ethnic_group_description = $row['ethnic_group_description'];
							$residency_id = $row['residency_id'];
							$residency_status_description = $row['residency_status_description'];
							$has_physical_disability = $row['has_physical_disability'];
							$has_mental_health_condition = $row['has_mental_health_condition'];
							$has_sensory_impairment = $row['has_sensory_impairment'];
							$has_learning_disability = $row['has_learning_disability'];
							$has_other_disability = $row['has_other_disability'];
							$is_deceased = $row['is_deceased'];
							$has_used_centre = $row['has_used_centre'];
							$created_date = date("d/m/Y h:i A", strtotime($row['created_date']));
							$full_address = str_replace("</br></br>", "</br>","$address_1</br>$address_2</br>$town_city</br>$postcode");							}
					} else {
						die();
					}
				}

				?>				
				
				
				
				
				
				
				
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2"><i class='fas fa-user-clock'></i> <?php echo "&nbsp;&nbsp;$first_name $last_name"; if($is_deceased==1){echo " (Deceased)";} ?></h1>
					</div>
					
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-user" style="color: primary;"></i> Personal Details</div>
							</div>
						</h5>
						<div class="card-body">
							<p class="card-text" style='color: grey'>Added on <?php echo $created_date; ?>.</p>
							
							<div class="container-fluid m-0 p-0">
								<div class="row">
									<div class="col-md-1"><strong>Address:</strong></div>
									<div class="col-md-2"><?php echo $full_address; ?></div>
									<div class="col-md-1">
										<?php echo "<strong>Telephone: </strong></br>"; ?>
										<?php echo "<strong>Mobile: </strong></br>"; ?>
										<?php echo "<strong>Email: </strong></br>"; ?>
									</div>
									<div class="col-md-2">
										<?php if(strlen($telephone)>0){echo "$telephone</br>";} else {echo "Not Recorded</br>";} ?>
										<?php if(strlen($mobile)>0){echo "$mobile</br>";} else {echo "Not Recorded</br>";} ?>
										<?php if(strlen($email)>0){echo "$email</br>";} else {echo "Not Recorded</br>";} ?>
									</div>
									<div class="col-md-1">
										<?php if(strlen($date_of_birth)>0){echo "<strong>Birthdate:</strong></br>";} ?>
										<strong>Gender:</strong></br>
										<strong>Ethnicity:</strong></br>
										<strong>Residency:</strong></br>
									</div>
									<div class="col-md-2">
										<?php if(strlen($date_of_birth)>0){echo "$date_of_birth</br>";} ?>
										<?php echo "$gender_description</br>";?>
										<?php echo "$ethnic_group_description</br>";?>
										<?php echo "$residency_status_description</br>";?>
									</div>
									<div class="col-md-3">
										<?php if($has_physical_disability==1){echo "<i class='fas fa-check-circle' style='color: green'></i> Has a Physical disability</br>";} ?>
										<?php if($has_mental_health_condition==1){echo "<i class='fas fa-check-circle' style='color: green'></i> Has a Mental Health Condition</br>";} ?>
										<?php if($has_sensory_impairment==1){echo "<i class='fas fa-check-circle' style='color: green'></i> Has Sensory Impairment</br>";} ?>
										<?php if($has_learning_disability==1){echo "<i class='fas fa-check-circle' style='color: green'></i> Has a Learning Disability</br>";} ?>
										<?php if($has_other_disability==1){echo "<i class='fas fa-check-circle' style='color: green'></i> Has Other Disability</br>";} ?>
										<?php if($has_physical_disability + $has_mental_health_condition + $has_sensory_impairment + $has_learning_disability + $has_other_disability==0){echo "<i class='fas fa-times-circle' style='color: red'></i> No Disability</br>";} ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md">&nbsp;</div>
								</div>
							</div>
				
				
						</div>
					</div>						
					
					<br/>
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-user-clock"></i> Activity Bookings for <?php echo "$first_name $last_name"; ?></div>
							</div>
						</h5>		
						<div class="card-body">
							<div class="container-fluid m-0 p-0">
								<div class="row">
									<div class="col-md-12">
										<table class="table table-striped table-sm table-fixed" id="bookings_table">
											<thead>
												<tr>
													<th>ID</th>
													<th>Activity</th>
													<th>Start Date</th>
													<th>End Date</th>
													<th>Weekday</th>									
													<th>Start Time</th>
													<th>Frequency</th>
													<th>Action</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer text-muted">	
							<a href="clients.php" class="btn btn-danger"><i class='fas fa-backward'></i> Back</a>
						</div>
					</div>						
					
				</main>
			</div>
		</div>
		
		<?php // Add Scripts
		include("includes/scripts.php"); ?>
	
		<script>

			$(document).ready(function(){
				
				
				$('#bookings_table').DataTable({
					"processing": true,
        			"serverSide": true,
					"ajax":"ajax/client.bookings.list.php",
					"responsive": true,
					"order":[[0,"desc"]],
					"columnDefs": [
						{responsivePriority: 1, targets: [1,2,3,4]},
						{width: 120, targets: [7]},
						{visible: false, targets: [0]}
					],
					
				});

			});						

			function view_activity(activity_id){
				$.post("ajax/activity.select.php", {
					activity_id:activity_id
				})
				.done(function(data){
					window.location.replace("activity.php");
				})				
			}
			
		</script>
	</body>
</html>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
