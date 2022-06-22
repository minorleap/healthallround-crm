<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Edit Booking"; ?>

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
						<h1 class="h2"><?php echo $icon;?>Edit Booking</h1>
					</div>
          
					<?php 
					
					// Retrieve activity_id from session data
					$data_error = 0;

					$booking_id = $_GET['id'];
					$booking_id = filter_var($booking_id, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

					// Validate ID
					if (!validate_string_isnumber($booking_id)) {$data_error = 1;}

					if ($data_error == 0){
						$sql = "SELECT * FROM `activity_bookings` WHERE `ID`=$booking_id";
						$result = $conn->query($sql);
						if ($result->num_rows == 1){
							while($row = $result->fetch_assoc()){
								$activity_id = $row['activity_id'];
								$client_id = $row['client_id'];
								$active = $row['active'];								
							}
						} else {
							die();
						}
					}

					?>

					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-tasks"></i> Booking Details</div>
							</div>
						</h5>
						<div class="card-body">							
							<!-- Form - Add Booking -->
							<form role="form" id="add_form" name="add_form" method="post">
								<input type="hidden" id="booking_id" value="<?php echo $booking_id; ?>">
								<input type="hidden" id="client_id" value="<?php echo $client_id; ?>">
								<input type="hidden" id="activity_id" value="<?php echo $activity_id; ?>">
								
								<?php
								$sql = "SELECT `name` FROM `activities` WHERE `id`=$activity_id;";
								$result = $conn->query($sql);
								while($row = $result->fetch_assoc()){
									$activity_name = $row['name'];
								}
								?>
								
								<div class="form-group row">
									<label for="activity_name" class="col-sm-2 col-form-label col-form-label-sm"> Activity</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="activity_name" name="activity_name" value="<?php echo $activity_name;?>" disabled>
									</div>
								</div>

								<?php
								$sql = "SELECT `id`, CONCAT(`first_name`, ' ', `last_name`) AS `name` FROM `clients` WHERE `id`=$client_id;";
								$result = $conn->query($sql);
								while($row = $result->fetch_assoc()){
									$name = $row['name'];
								}
								?>

								
								<div class="form-group row">
									<label for="client_name" class="col-sm-2 col-form-label col-form-label-sm"> Client</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="client_name" name="client_name" value="<?php echo $name;?>" disabled>
									</div>
								</div>
								
								
								
								
								
								
								
								
								<?php $checked = $active? "checked" : "";?>
								<div class="form-group row">
									<div class="col-sm-2">
										<label class="form-check-label">Active</label>
									</div>
									<div class="col-sm-2">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="active" name="active" <?php echo $checked;?>>
										</div>
									</div>
								</div>								
								
								
								
								

							</form>
						</div>
						<div class="card-footer text-muted">	
							<button type="button" class="btn btn-primary" id="add_form_save_button"><i class='fas fa-save'></i> Save</button>
							<a href="activity.php" class="btn btn-danger"><i class='fas fa-backward'></i> Back</a>
							  <button type="button" class="btn btn-warning" id="delete_booking_button" style="float: right" ><i class="fas fa-trash"></i> Delete Booking</button>							
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
						<h5 class="modal-title" id="delete_modal_center_title">Delete Booking</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Are you sure you wish to permanently delete this booking?</p>
						<p>This will delete all records of this client's attendance this activity.</p>
					</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-warning" id="delete_booking_confirm_button"><i class="fas fa-trash"></i> Delete</button>
					</div>
				</div>
			</div>
		</div>		
		
		
		<?php // Add Scripts
		include("includes/scripts.php"); ?>

		<script>

			$(document).ready(function(){
				// Initialize form validation on the form.
				// It has the name attribute "registration"
				$("form[name='add_form']").validate({
					// Specify validation rules
					rules: {
						
					},
				  // Specify validation error messages
				  messages: {

				  },
				  // Make sure the form is submitted to the destination defined
				  // in the "action" attribute of the form when valid
				  submitHandler: function(form) {
					// Form is valid, add a new activity
					// Get form values  
					var booking_id = $("#booking_id").val();
					var activity_id = $("#activity_id").val();
					var client_id = $("#client_id").val();
					var active = $("#active").prop('checked')?1:0;					

					$.post("ajax/booking.edit.php", {
						booking_id:booking_id,
						activity_id:activity_id,
						client_id:client_id,
						active:active
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#modal_center_title").html("Success!");
								$("#modal_body").html("The booking was successfully recorded.");
							} else {
								$("#modal_center_title").html("Update Failed!");
								$("#modal_body").html("There was a problem recording the booking. [" + data +"]");
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
				$("#delete_booking_button").click(function() {
					$("#delete_modal").modal();
				});
				
				// Add event to the delete button
				$("#delete_booking_confirm_button").click(function() {
					var booking_id = $("#booking_id").val();
					var client_id = $("#client_id").val();
					var activity_id = $("#activity_id").val();
					$.post("ajax/booking.delete.php", {
						booking_id:booking_id,
						client_id:client_id,
						activity_id:activity_id
					})
					.done(function(data){
						if(data.substring(0, 2)=="OK") {
							window.location.href = "/activity.php";
						} else {
							$("#modal_center_title").html("Delete Failed!");
							$("#modal_body").html("There was a problem deleting the booking. [" + data +"]");
						}
					})
				});				
				
			});			

		</script>
	</body>
</html>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>