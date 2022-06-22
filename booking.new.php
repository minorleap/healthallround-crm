<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "New Activity Booking"; ?>

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
						<h1 class="h2"><i class="fas fa-user"></i> New Booking</h1>
					</div>
					
					<?php // Retrieve activity_id from session data
					$activity_id = $_SESSION['activity_id'];
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
								<input type="hidden" id="client_id" name="client_id" value="">
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
								
								<div class="row">
									<div class="col-2">
										<div class="formgroup">
											<label class="col-form-label">Client</label>
										</div>
									</div>
									<div class="col-4">
										<div class="formgroup">
											<select class="selectpicker form-control form-control-sm" data-show-subtext="true" data-live-search="true" id="client_select" name="client_select" width="auto" title="Choose a client..." virtualScroll="30">
												
												<?php
													$sql = "SELECT `id`, CONCAT(`first_name`, ' ', `last_name`) AS `name` FROM `clients` ORDER BY `name`;";
													$result = $conn->query($sql);
													while($row = $result->fetch_assoc()){
														$id = $row['id'];
														$name = $row['name'];
														$name = preg_replace("/[^A-Za-z0-9 ]/", '', $name);
														echo "<option data-subtext='($id)' value='$id'>$name</option>\n";
													}
												?>
											</select>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-sm-2">
										<label class="form-check-label">Active</label>
									</div>
									<div class="col-sm-2">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="active" name="active" checked>
										</div>
									</div>
								</div>


							</form>
						</div>
						<div class="card-footer text-muted">	
							<button type="button" class="btn btn-primary" id="add_form_save_button"><i class='fas fa-save'></i> Save</button>
							<a href="activity.php" class="btn btn-danger"><i class='fas fa-backward'></i> Back</a>
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
				// Initialize form validation on the form.
				// It has the name attribute "registration"
				$("form[name='add_form']").validate({
					// Specify validation rules
					rules: {
						client_select: {
						  required: true},
					},
				  // Specify validation error messages
				  messages: {
					  client_select: {
						  required: "Select a client..."},
				  },
				  // Make sure the form is submitted to the destination defined
				  // in the "action" attribute of the form when valid
				  submitHandler: function(form) {
					// Form is valid, add a new activity
					// Get form values  
					var activity_id = $("#activity_id").val();
					var client_id = $("#client_id").val();
					var active = $("#active").prop('checked')?1:0;

					$.post("ajax/booking.new.php", {
						activity_id:activity_id,
						client_id:client_id,
						active:active
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#client_select").val('');
								$("#client_select").selectpicker("refresh");
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

			
				
				
				// Add event to the client select button
				$("#client_select").on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
					if (!clickedIndex) {return;} // prevents validation from looping when the picker is reset
					var activity_id = $("#activity_id").val();
					var client_id = $("#client_select").val();
					
					// Call a new page using AJAX to see if the cliend_id is already has a booking. If the client has a booking, alert (modla) that the client already has a booking.
					
					$.post("ajax/booking.checkclient.php", {
						activity_id:activity_id,
						client_id:client_id,
						})
						.done(function(data){
							if(data.substring(0, 2)!="OK") {
								$("#modal_center_title").html("Booking already exists!");
								$("#modal_body").html("The selected client already has a booking for this activity.<br/>Please check the client record.");
								$("#confirm_modal").modal();
								$("#client_select").selectpicker('val', ''); // reset the selectpicker
							} else {
								$("#client_id").val(client_id);
							}
						})
					

				});
			
				$('.selectpicker').on('change', function () {
					$(this).valid();
				});			
			
			});				

		</script>
	</body>
</html>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>