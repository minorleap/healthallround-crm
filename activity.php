<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "View Activity"; ?>

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

				// Retrieve activity_id from session data
				$activity_id = $_SESSION['activity_id'];

				// Validate ID
				if (!validate_string_isnumber($activity_id)) {$data_error = 1;}

				if ($data_error == 0){
					$sql = "SELECT * FROM `view_activities` WHERE `ID`=$activity_id";
					$result = $conn->query($sql);
					if ($result->num_rows == 1){
						while($row = $result->fetch_assoc()){
							$name = $row['name'];
							$location = $row['location'];
							$start_date = date("d/m/Y", strtotime($row['start_date']));
							$end_date = $row['end_date']? date("d/m/Y", strtotime($row['end_date'])) : "";
							$weekday = $row['weekday'];
							$start_time = $row['start_time'];
							$duration_hours = $row['duration_hours'];
							$organiser = $row['organiser'];
							$capacity = $row['capacity'];
							$frequency = $row['frequency'];
							$contact_details = $row['contact_details'];
							$has_anonymous_attendees = $row['has_anonymous_attendees'];
							$is_archived = $row['is_archived'];									
						}
					} else {
						die();
					}
				}

				?>
				
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
						<h1 class="h2"><i class="fas fa-tasks"></i> <?php echo $name; ?></h1>
					</div>
          
					
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-tasks"></i> Activity Details</div>
							</div>
						</h5>
						<div class="card-body">							
							<div class="container-fluid m-0 p-0">
								<div class="row">
									<div class="col-md-2">
										<?php echo "<strong>Name: </strong></br>"; ?>
										<?php echo "<strong>Location: </strong></br>"; ?>
										<?php echo "<strong>Organiser: </strong></br>"; ?>
										<?php echo "<strong>Contact: </strong></br>"; ?>
									</div>
									<div class="col-md-2">
										<?php if(strlen($name)>0){echo "$name</br>";} else {echo "Not Recorded</br>";} ?>
										<?php if(strlen($location)>0){echo "$location</br>";} else {echo "Not Recorded</br>";} ?>
										<?php if(strlen($organiser)>0){echo "$organiser</br>";} else {echo "Not Recorded</br>";} ?>
										<?php if(strlen($contact_details)>0){echo "$contact_details</br>";} else {echo "Not Recorded</br>";} ?>
									</div>
									<div class="col-md-2">
										<?php echo "<strong>Start Date: </strong></br>"; ?>
										<?php echo "<strong>End Date: </strong></br>"; ?>
										<?php echo "<strong>Day of Week: </strong></br>"; ?>
										<?php echo "<strong>Start Time: </strong></br>"; ?>
										<?php echo "<strong>Duration: </strong></br>"; ?>
										<?php echo "<strong>Frequency: </strong></br>"; ?>
								</div>
									<div class="col-md-2">
										<?php if(strlen($start_date)>0){echo "$start_date</br>";} else {echo "Not Recorded</br>";} ?>
										<?php if(strlen($end_date)>0){echo "$end_date</br>";} else {echo "Not Recorded</br>";} ?>
										<?php if(strlen($weekday)>0){echo "$weekday</br>";} else {echo "Not Recorded</br>";} ?>
										<?php if(strlen($start_time)>0){echo "$start_time</br>";} else {echo "Not Recorded</br>";} ?>
										<?php if(strlen($duration_hours)>0){echo "$duration_hours Hours</br>";} else {echo "Not Recorded</br>";} ?>
										<?php if(strlen($frequency)>0){echo "$frequency</br>";} else {echo "Not Recorded</br>";} ?>
									</div>
									<div class="col-md-3">
										<?php if($has_anonymous_attendees==1){
											  	echo "<i class='fas fa-check-circle' style='color: green'></i> Anonymous Attendees</br>";
											  } else {
											  	echo "<i class='fas fa-times-circle' style='color: red'></i> Anonymous Attendees</br>";
											  } 
										?>
										<?php if($is_archived==1){
											  	echo "<i class='fas fa-check-circle' style='color: green'></i> Archived</br>";
											  } else {
											  	echo "<i class='fas fa-times-circle' style='color: red'></i> Archived</br>";
											  } 
										?>
									</div>
								</div>
								<div class="row">
									<div class="col-md">&nbsp;</div>
								</div>
							</div>
						</div>
						<div class="card-footer text-muted">	
							<a href="activity.edit.php" class="btn btn-primary"><i class='fas fa-edit'></i> Edit</a>
							<a href="activities.php" class="btn btn-danger"><i class='fas fa-backward'></i> Back</a>
						</div>
					</div>	
					
					<br/>
					
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-clock"></i> Meetings for <?php echo $name; ?></div>
							</div>
						</h5>		
						<div class="card-body">
							<div class="container-fluid m-0 p-0">
								<div class="row">
									<div class="col-md-12">
										<table class="table table-striped table-sm table-fixed" id="meetings_table">
											<thead>
												<tr>
													<th>ID</th>
													<th>Date</th>
													<th>Time</th>
													<th>Action</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer text-muted">	
							<a href="meeting.new.php" class="btn btn-primary"><i class='fas fa-plus'></i> New Meeting</a>
						</div>
					</div>	
					
					<br/>
					
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-users"></i> Clients Booked on <?php echo $name; ?></div>
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
													<th>Client Name</th>
													<th>Date of Birth</th>
													<th>Post Code</th>
													<th>Active</th>
													<th>Action</th>
												</tr>
											</thead>
										</table>

									</div>
								</div>
							</div>
						</div>
						<div class="card-footer text-muted">	
							<a href="booking.new.php" class="btn btn-primary"><i class='fas fa-plus'></i> New Booking</a>
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
					"ajax":"ajax/booking.list.php",
					"responsive": true,
					"order":[[0,"desc"]],
					"columnDefs": [
						{responsivePriority: 1, targets: [1,2,3,4]},
						{width: 60, targets: [5]},
						{visible: false, targets: [0]}
					],
					
				});				
				
				
				$('#meetings_table').DataTable({
					"processing": true,
        			"serverSide": true,
					"ajax":"ajax/meeting.list.php",
					"responsive": true,
					"order":[[0,"desc"]],
					"columnDefs": [
						{responsivePriority: 1, targets: [1,2]},
						{width: 170, targets: [3]},
						{visible: false, targets: [0]}
					],
					
				});

			});						

			function edit_meeting(id){
				window.location.replace("meeting.php?id=" + id);
			}
			
			function edit_booking(id){
				window.location.replace("booking.php?id=" + id);
			}

			function edit_attendance(id){
				window.location.replace("attendance.php?id=" + id);
			}

			

			
			
			
			
		</script>

	</body>
</html>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>