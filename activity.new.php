<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "New Activity"; ?>

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
						<h1 class="h2"><i class='fas fa-plus'></i> New Activity</h1>
					</div>
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
								<div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label col-form-label-sm">Name</label>
									<div class="col-sm-4">
										<input type="text" class="form-control form-control-sm" id="name" name="name" >
									</div>
								</div>						
								<div class="form-group row">
									<label for="location" class="col-sm-2 col-form-label col-form-label-sm">Location</label>
									<div class="col-sm-4">
										<input type="text" class="form-control form-control-sm" id="location" name="location" >
									</div>
								</div>
								<div class="form-group row">
									<label for="start_date" class="col-sm-2 col-form-label col-form-label-sm">Start Date</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="start_date" name="start_date" >
									</div>
								</div>
								<div class="form-group row">
									<label for="end_date" class="col-sm-2 col-form-label col-form-label-sm">End Date</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="end_date" name="end_date" >
									</div>
								</div>
								<div class="form-group row">
									<label for="weekday" class="col-sm-2 col-form-label col-form-label-sm">Day of Week</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="weekday" name="weekday" >
									</div>
								</div>
								<div class="form-group row">
									<label for="start_time" class="col-sm-2 col-form-label col-form-label-sm">Start Time</label>
									<div class="col-sm-2">
										<select class="form-control form-control-sm" id="start_time" name="start_time">
											<?php
											$sql = "SELECT `description` FROM `duration` WHERE `is_enabled`=1;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$description = $row['description'];
												if($description=="12:00"){$selected="selected";} else {$selected="";}
												echo "<option value='$description' $selected>$description</option>";
											}
											?>
										</select>
									</div>
								</div>
								
								<div class="form-group row">
									<label for="duration_hours" class="col-sm-2 col-form-label col-form-label-sm">Duration (hours)</label>
									<div class="col-sm-2">
										<select class="form-control form-control-sm" id="duration_hours" name="duration_hours">
											<?php
											$sql = "SELECT `value`, `description` FROM `duration` WHERE `is_enabled`=1;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$value = $row['value'];
												$description = $row['description'];
												if($value==1){$selected="selected";} else {$selected="";}
												echo "<option value='$value' $selected>$description</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="organiser" class="col-sm-2 col-form-label col-form-label-sm">Organiser</label>
									<div class="col-sm-4">
										<input type="text" class="form-control form-control-sm" id="organiser" name="organiser" >
									</div>
								</div>
								<div class="form-group row">
									<label for="contact_details" class="col-sm-2 col-form-label col-form-label-sm">Contact Details</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="contact_details" name="contact_details" >
									</div>
								</div>						
								<div class="form-group row">
									<label for="capacity" class="col-sm-2 col-form-label col-form-label-sm">Capacity</label>
									<div class="col-sm-1">
										<input type="text" class="form-control form-control-sm" id="capacity" name="capacity" >
									</div>
								</div>					
								<div class="form-group row">
									<label for="frequency_id" class="col-sm-2 col-form-label col-form-label-sm">Frequency</label>
									<div class="col-sm-2">
										<select class="form-control form-control-sm" id="frequency_id" name="frequency_id">
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
								<div class="form-group row">
									<div class="col-sm-2">
										<label class="form-check-label">Anonymous Attendees</label>
									</div>
									<div class="col-sm-2">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="has_anonymous_attendees" name="has_anonymous_attendees">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-2">
										<label class="form-check-label">Archived</label>
									</div>
									<div class="col-sm-2">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="is_archived" name="is_archived">
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="card-footer">
							 <button type="button" class="btn btn-primary" id="add_form_save_button"><i class='fas fa-save'></i> Save</button>
							 <a href="activities.php" class="btn btn-danger"><i class='fas fa-backward'></i> Back</a>
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
						name: {maxlength: 128, required:true},
						start_date: {required: true, ukdate: true, minlength: 10},
						end_date: {ukdate: true, minlength: 10},
						
						location: {maxlength: 128, required:true},
						weekday: {maxlength: 128, required:true},
						start_time: {maxlength: 128, required:true},
						duration_hours: {required: true, max: 24},
						organiser: {maxlength: 128, required:true},
						contact_details: {maxlength: 128},
						capacity: {required: true, digits: true, max: 999}
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

					$.post("ajax/activity.new.php", {
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
			});				

		</script>
	</body>
</html>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>