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
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2"><i class='fas fa-tasks'></i> Edit Activity</h1>
					</div>
					<?php
					
					$data_error = 0;
					// Retrieve activity_id from session data
					$activity_id = $_SESSION['activity_id'];

					// Validate ID
					if (!validate_string_isnumber($activity_id)) {$data_error = 1;}

					if ($data_error == 0){
						$sql = "SELECT * FROM `activities` WHERE `ID`=$activity_id";
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
								$frequency_id = $row['$frequency_id'];
								$contact_details = $row['contact_details'];
								$has_anonymous_attendees = $row['has_anonymous_attendees'];
								$is_archived = $row['is_archived'];									
							}
						} else {
							die();
						}
					}

					?>
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col">
									<i class="fas fa-tasks"></i>&nbsp;&nbsp;Activity Details
								</div>
							</div>
						</h5>
						<div class="card-body">
							<!-- Form - Add Activity -->
							<form role="form" id="add_form" name="add_form" method="post">
								<input type="hidden" class="form-control" id="activity_id" value="<?php echo $activity_id; ?>">	
								<div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label col-form-label-sm">Name</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="name" name="name" value="<?php echo $name;?>">
									</div>
								</div>						
								<div class="form-group row">
									<label for="location" class="col-sm-2 col-form-label col-form-label-sm">Location</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="location" name="location" value="<?php echo $location;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="start_date" class="col-sm-2 col-form-label col-form-label-sm">Start Date</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="start_date" name="start_date" value="<?php echo $start_date;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="end_date" class="col-sm-2 col-form-label col-form-label-sm">End Date</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="end_date" name="end_date" value="<?php echo $end_date;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="weekday" class="col-sm-2 col-form-label col-form-label-sm">Day of Week</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="weekday" name="weekday" value="<?php echo $weekday;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="start_time" class="col-sm-2 col-form-label col-form-label-sm">Start Time</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="start_time" name="start_time" value="<?php echo $start_time;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="duration_hours" class="col-sm-2 col-form-label col-form-label-sm">Duration (hours)</label>
									<div class="col-sm-3">
										<input type="number" class="form-control form-control-sm" id="duration_hours" name="duration_hours" value="<?php echo $duration_hours;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="organiser" class="col-sm-2 col-form-label col-form-label-sm">Organiser</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="organiser" name="organiser" value="<?php echo $organiser;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="contact_details" class="col-sm-2 col-form-label col-form-label-sm">Contact Details</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="contact_details" name="contact_details" value="<?php echo $contact_details;?>">
									</div>
								</div>						
								<div class="form-group row">
									<label for="capacity" class="col-sm-2 col-form-label col-form-label-sm">Capacity</label>
									<div class="col-sm-3">
										<input type="number" class="form-control form-control-sm" id="capacity" name="capacity" value="<?php echo $capacity;?>">
									</div>
								</div>					
								<div class="form-group row">
									<label for="frequency_id" class="col-sm-2 col-form-label col-form-label-sm">Frequency</label>
									<div class="col-sm-2">
										<select class="form-control form-control-sm" id="frequency_id" name="<?php echo $frequency_id;?>">
											<?php
												$sql = "SELECT `id`, `description` FROM `activity_frequency`;";
												$result = $conn->query($sql);
												while($row = $result->fetch_assoc()){
													$id = $row['id'];
													$description = $row['description'];
													echo "<option value='$id'>$description</option>";
												}
											?>
										</select>
									</div>
								</div>
								
								
								<?php $checked = $has_anonymous_attendees? "checked" : "";?>
								<div class="form-group row">
									<div class="col-sm-2">
										<label class="form-check-label">Anonymous Attendees</label>
									</div>
									<div class="col-sm-2">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="has_anonymous_attendees" name="has_anonymous_attendees" <?php echo $checked;?>>
										</div>
									</div>
								</div>
								<?php $checked = $is_archived? "checked" : "";?>
								<div class="form-group row">
									<div class="col-sm-2">
										<label class="form-check-label">Archived</label>
									</div>
									<div class="col-sm-2">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="is_archived" name="is_archived" <?php echo $checked;?>>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="card-footer">
							 <button type="button" class="btn btn-primary" id="add_form_save_button"><i class='fas fa-save'></i> Save</button>
							 <a href="activity.php" class="btn btn-danger"><i class='fas fa-backward'></i> Back</a>
							  <button type="button" class="btn btn-warning" id="delete_activity_button" style="float: right" ><i class="fas fa-trash"></i> Delete Activity</button>
						</div>
					</div>
				</main>
			</div>
		</div>
		
		<!-- Confirmation Modal -->
		<div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="modal_center_title" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modal_center_title">Modal Title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<span id="modal_body"></span>
					</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Delete Modal -->
		<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="modal_center_title" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="delete_modal_center_title">Delete Activity</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Are you sure you wish to permanently delete this activity?</p>
						<p>This will delete all related records (e.g. bookings, meetings, attendance).</p>
					</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-warning" id="delete_activity_confirm_button"><i class="fas fa-trash"></i> Delete</button>
					</div>
				</div>
			</div>
		</div>
		
		<?php // Add Scripts
		include("includes/scripts.php"); ?>

		<script>

			$(document).ready(function(){
				$('#start_date,#end_date').datepicker({
    				format: "dd/mm/yyyy",
					   orientation: "left bottom"
				});

				// Initialize form validation on the form.
				// It has the name attribute "registration"
				$("form[name='add_form']").validate({
					// Specify validation rules
					rules: {
						start_date: {
						  required: true,
						  ukdate: true,
						  minlength: 10},
						end_date: {
						  ukdate: true,
						  minlength: 10},
						name: {
						  maxlength: 128},
						location: {
						  maxlength: 128},
						weekday: {
						  maxlength: 128},
						start_time: {
						  maxlength: 128},
						duration_hours: {
						  required: true,
						  digits: true,
						  max: 24},
						organiser: {
						  maxlength: 128},
						contact_details: {
						  maxlength: 128},
						capacity: {
						  required: true,
						  digits: true,
						  maxlength: 999}
					},
				  // Specify validation error messages
				  messages: {
					  start_date: "Please enter a valid date (dd/mm/yyyy)",
					  end_date: "Please enter a valid date (dd/mm/yyyy)",
				  },
				  // Make sure the form is submitted to the destination defined
				  // in the "action" attribute of the form when valid
				  submitHandler: function(form) {
					// Form is valid, add a new activity
					// Get form values  
					var activity_id = $("#activity_id").val();
					var name = $("#name").val();
					var location = $("#location").val();
					var start_date = $("#start_date").val();
					var end_date = $("#end_date").val();
					var weekday = $("#weekday").val();
					var start_time = $("#start_time").val();
					var duration_hours = $("#duration_hours").val();
					var organiser = $("#organiser").val();
					var contact_details = $("#contact_details").val();
					var capacity = $("#capacity").val();
					var frequency_id = $("#frequency_id").val();
					var has_anonymous_attendees = $("#has_anonymous_attendees").prop('checked')?1:0;
					var is_archived = $("#is_archived").prop('checked')?1:0;
					

					$.post("ajax/activity.edit.php", {
						activity_id:activity_id,
						name:name,
						location:location,
						start_date:start_date,
						end_date:end_date,
						weekday:weekday,
						start_time:start_time,
						duration_hours:duration_hours,
						organiser:organiser,
						contact_details:contact_details,
						capacity:capacity,
						frequency_id:frequency_id,
						has_anonymous_attendees:has_anonymous_attendees,
						is_archived:is_archived
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#modal_center_title").html("Success!");
								$("#modal_body").html("The activity was successfully recorded.");
							} else {
								$("#modal_center_title").html("Update Failed!");
								$("#modal_body").html("There was a problem recording the activity. [" + data +"]");
							}
							$("#confirm_modal").modal()
						})
				  }
				});

				// Add event to the save button
				$("#add_form_save_button").click(function() {
					$("#add_form").submit()
				});
				
				// Add event to the delete button
				$("#delete_activity_button").click(function() {
					$("#delete_modal").modal();
				});
				
				// Add event to the delete button
				$("#delete_activity_confirm_button").click(function() {
					var activity_id = $("#activity_id").val();
					$.post("ajax/activity.delete.php", {
						activity_id:activity_id
					})
					.done(function(data){
						if(data.substring(0, 2)=="OK") {
							window.location.href = "/activities.php";
						} else {
							$("#modal_center_title").html("Delete Failed!");
							$("#modal_body").html("There was a problem deleting the activity. [" + data +"]");
						}
					})
				});
				
			});			

		</script>
	</body>
</html>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>