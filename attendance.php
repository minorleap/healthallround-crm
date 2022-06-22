<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Activity Attendance"; ?>
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
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2"><i class="fas fa-user-clock"></i> Activity Attendance</h1>
					</div>
					
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-user-clock"></i> Attendance Details</div>
							</div>
						</h5>
						<div class="card-body">							
							<?php
							// Clean GET values to prevent SQL injection
							$meeting_id = $_GET['id'];
							$meeting_id = filter_var($meeting_id, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
							?>
								<table class="table table-striped table-sm table-fixed" id="attendance_table">
									<thead>
										<tr>
											<th>Client</th>
											<th>Attended</th>
										</tr>
									</thead>
									<tbody>
									<?php

									$sql = "
									SELECT activity_bookings.client_id AS 'client_id', null AS 'attendance_id', concat(`clients`.`first_name`, ' ', `clients`.`last_name`) AS 'client'
									FROM activity_meetings
									INNER JOIN activity_bookings ON activity_meetings.activity_id=activity_bookings.activity_id
									INNER JOIN clients ON activity_bookings.client_id = clients.id
									WHERE activity_meetings.id=$meeting_id AND activity_bookings.active=1 AND activity_bookings.client_id NOT IN
									(SELECT activity_attendance.client_id
									 FROM activity_attendance
									 WHERE activity_attendance.activity_meeting_id=$meeting_id
									)

									UNION ALL

									SELECT client_id, activity_attendance.id AS 'attendance_id', concat(`clients`.`first_name`, ' ', `clients`.`last_name`) AS 'client'
									FROM activity_attendance
									INNER JOIN clients ON activity_attendance.client_id = clients.id
									WHERE activity_attendance.activity_meeting_id=$meeting_id;
									";								
									$result = $conn->query($sql);
									while($row = $result->fetch_assoc()){
										$id = $row['attendance_id'];
										$client_id = $row['client_id'];
										$client = $row['client'];
										$checked = strlen($id)>0? "checked" : "";
										$checkbox = '<input type="checkbox" id="attendance-checkbox-' . $client_id . '" class="contact_table" onclick="toggle_attendance(' . $client_id . ',' . $meeting_id . ')" ' . $checked . ' />';

										echo "<tr><td>$client</td><td>$checkbox</td></tr>";
									}
									?>								
									</tbody>
								</table>
						</div>
						<div class="card-footer text-muted">	
							<a href="activity.php" class="btn btn-danger"><i class='fas fa-backward'></i> Back</a>
						</div>
					</div>	
				</main>
			</div>
		</div>
		
		<?php // Add Scripts
		include("includes/scripts.php"); ?>
	
		<script>					

			function toggle_attendance(client_id, meeting_id){
				var elementId = "#attendance-checkbox-" + client_id;
				var wasChecked = $(elementId).prop('checked')?0:1;
				if(wasChecked) {
					var add = 0;
					$.post("ajax/attendance.edit.php", {
						meeting_id:meeting_id,						
						client_id:client_id,
						add:add
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								//fine
							} else {
								alert('failed: ' + data);
							}
						})						
				} else {
					var add = 1;
					$.post("ajax/attendance.edit.php", {
						meeting_id:meeting_id,						
						client_id:client_id,
						add:add
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								//fine
							} else {
								alert('failed: ' + data);
							}
						})						
				}
			}
			
		</script>
	</body>
</html>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
