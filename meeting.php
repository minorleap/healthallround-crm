<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Edit Meeting"; ?>

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
						<h1 class="h2"><i class="fas fa-clock"></i> Edit Meeting</h1>
					</div>
          
					<?php

					$data_error = 0;

					// Clean GET values to prevent SQL injection
					$meeting_id = $_GET['id'];
					$meeting_id = filter_var($meeting_id, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

					// Validate ID
					if (!validate_string_isnumber($meeting_id)) {$data_error = 1;}

					if ($data_error == 0){
						$sql = "SELECT * FROM `activity_meetings` WHERE `ID`=$meeting_id";
						$result = $conn->query($sql);
						if ($result->num_rows == 1){
							while($row = $result->fetch_assoc()){
								$activity_id = $row['activity_id'];
								$meeting_date = date("d/m/Y", strtotime($row['meeting_date']));
								$meeting_time = substr($row['meeting_time'], 0, -3); // trim seconds from time
							}
						} else {
							die();
						}
					}

					?>

					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-clock"></i> Meeting Details</div>
							</div>
						</h5>
						<div class="card-body">							
							<!-- Form - Add Meeting -->
							<form role="form" id="add_form" name="add_form" method="post">
								<input type="hidden" class="form-control" id="meeting_id" value="<?php echo $meeting_id; ?>">
								<input type="hidden" class="form-control" id="activity_id" value="<?php echo $activity_id; ?>">
								<?php
								$sql = "SELECT `name` FROM `activities` WHERE `id`=$activity_id;";
								$result = $conn->query($sql);
								while($row = $result->fetch_assoc()){
									$activity_name = $row['name'];
								}
								?>
								<div class="form-group row">
									<label for="activity_name" class="col-sm-2 col-form-label col-form-label-sm">Activity</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="activity_name" name="activity_name" value="<?php echo $activity_name;?>" disabled>
									</div>
								</div>
								<div class="form-group row">
									<label for="meeting_date" class="col-sm-2 col-form-label col-form-label-sm">Date</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="meeting_date" name="meeting_date" value="<?php echo $meeting_date;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="meeting_date" class="col-sm-2 col-form-label col-form-label-sm">Time</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="meeting_time" name="meeting_time" value="<?php echo $meeting_time;?>">
									</div>
								</div>
							</form>
						</div>
						<div class="card-footer text-muted">	
							<button type="button" class="btn btn-primary" id="add_form_save_button"><i class='fas fa-save'></i> Save</button>
							<a href="activity.php" class="btn btn-danger"><i class='fas fa-backward'></i> Back</a>
							  <button type="button" class="btn btn-warning" id="delete_meeting_button" style="float: right" ><i class="fas fa-trash"></i> Delete Meeting</button>
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
						<h5 class="modal-title" id="delete_modal_center_title">Delete Meeting</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Are you sure you wish to permanently delete this meeting?</p>
						<p>This will delete all of the attendance records associated with the meeting</p>
					</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-warning" id="delete_meeting_confirm_button"><i class="fas fa-trash"></i> Delete</button>
					</div>
				</div>
			</div>
		</div>
		
		
		<?php // Add Scripts
		include("includes/scripts.php"); ?>

		<script>

			$(document).ready(function(){
				$('#meeting_date').datepicker({
    				format: "dd/mm/yyyy",
					   orientation: "left bottom"
				});

				// Initialize form validation on the form.
				// It has the name attribute "registration"
				$("form[name='add_form']").validate({
					// Specify validation rules
					rules: {
						meeting_date: {
						  required: true,
						  ukdate: true,
						  minlength: 10},
						meeting_time: {
						  time: true,
						  minlength: 5,
						  maxlength: 5},
					},
				  // Specify validation error messages
				  messages: {
					  meeting_date: "Please enter a valid date (dd/mm/yyyy)",
					  meeting_time: "Please enter a valid 24-hour time (e.g. 13:45)",
				  },
				// Make sure the form is submitted to the destination defined
				  // in the "action" attribute of the form when valid
				  submitHandler: function(form) {
					// Form is valid, add a new activity
					// Get form values  
					var meeting_id = $("#meeting_id").val();
					var activity_id = $("#activity_id").val();
					var meeting_date = $("#meeting_date").val();
					var meeting_time = $("#meeting_time").val();

					$.post("ajax/meeting.edit.php", {
						meeting_id:meeting_id,
						activity_id:activity_id,
						meeting_date:meeting_date,
						meeting_time:meeting_time
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#modal_center_title").html("Success!");
								$("#modal_body").html("The meeting was successfully recorded.");
							} else {
								$("#modal_center_title").html("Update Failed!");
								$("#modal_body").html("There was a problem recording the meeting. [" + data +"]");
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
				$("#delete_meeting_button").click(function() {
					$("#delete_modal").modal();
				});
				
				// Add event to the delete button
				$("#delete_meeting_confirm_button").click(function() {
					var meeting_id = $("#meeting_id").val();
					$.post("ajax/meeting.delete.php", {
						meeting_id:meeting_id
					})
					.done(function(data){
						if(data.substring(0, 2)=="OK") {
							window.location.href = "/activity.php";
						} else {
							$("#modal_center_title").html("Delete Failed!");
							$("#modal_body").html("There was a problem deleting the meeting. [" + data +"]");
						}
					})
				});
				
			});			

		</script>
	</body>
</html>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>