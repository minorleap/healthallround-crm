<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Edit Appointment"; ?>

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
				<?php $client_id = $_SESSION['client_id']; ?>
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2"><i class='fas fa-edit'></i> Edit Appointment</h1>
					</div>
					
					<?php

					$data_error = 0;

					// Clean GET values to prevent SQL injection
					$appointment_id = $_GET['id'];
					$appointment_id = filter_var($appointment_id, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

					// Validate ID
					if (!validate_string_isnumber($appointment_id)) {$data_error = 1;}

					if ($data_error == 0){
						$sql = "SELECT * FROM `appointments` WHERE `ID`=$appointment_id";
						$result = $conn->query($sql);
						if ($result->num_rows == 1){
							while($row = $result->fetch_assoc()){
								$client_id = $row['client_id'];
								$date = date("d/m/Y", strtotime($row['date']));
								$time = substr($row['time'],0,5);
								$counsellor_user_id = $row['counsellor_user_id'];
								$appointment_type_id = $row['appointment_type_id'];
								$appointment_status_id = $row['appointment_status_id'];
								$notes = $row['notes'];
								$fee = $row['fee'];
								$payment_status_id = $row['payment_status_id'];
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
									<i class="fas fa-tasks"></i>&nbsp;&nbsp;Appointment Details
								</div>
							</div>
						</h5>
						<div class="card-body">
							<!-- Form - Add Appointment -->
							<form role="form" id="add_form" name="add_form" method="post">
								<input type="hidden" class="form-control" id="appointment_id" value="<?php echo $appointment_id; ?>">
								<div class="form-group row">
									<label for="client_id" class="col-sm-2 col-form-label col-form-label-sm">Client</label>
									<div class="col-sm-4">
										<input type="hidden" class="form-control form-control-sm" id="client_id" name="client_id" value="<?php echo $client_id;?>">
											<?php
											$sql = "SELECT `first_name`, `last_name` FROM `clients` WHERE `id`=$client_id;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$client_name = $row['first_name'] . " ". $row['last_name'];
											}
											?>
										<input type="text" class="form-control form-control-sm" id="client_name" name="client_name" value="<?php echo $client_name;?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label for="date" class="col-sm-2 col-form-label col-form-label-sm">Date</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="date" name="date" value="<?php echo $date;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="time" class="col-sm-2 col-form-label col-form-label-sm">Time</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="time" name="time" value="<?php echo $time;?>">
									</div>
								</div>								
								<div class="form-group row">
									<label for="counsellor_user_id" class="col-sm-2 col-form-label col-form-label-sm">Counsellor <?php echo $counsellor_user_id;?></label>
									<div class="col-sm-4">
										<select class="form-control form-control-sm" id="counsellor_user_id" name="counsellor_user_id">
											<option value='' selected disabled>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `first_name`, `last_name` FROM `users` WHERE `is_counsellor`=1 ORDER BY `first_name` ASC;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												if($id==$counsellor_user_id){$selected = "selected";} else {$selected="";}
												$name = $row['first_name'] . ' ' . $row['last_name'];
												echo "<option value='$id' $selected>$name</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="appointment_type_id" class="col-sm-2 col-form-label col-form-label-sm">Type</label>
									<div class="col-sm-3">
										<select class="form-control form-control-sm" id="appointment_type_id" name="appointment_type_id">
											<option value='' selected disabled>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `appointment_type`;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												if($id==$appointment_type_id){$selected = "selected";} else {$selected="";}
												$description = $row['description'];
												echo "<option value='$id' $selected>$description</option>";
											}
											?>
										</select>
									</div>
								</div>							
								<div class="form-group row">
									<label for="appointment_status_id" class="col-sm-2 col-form-label col-form-label-sm">Status</label>
									<div class="col-sm-3">
										<select class="form-control form-control-sm" id="appointment_status_id" name="appointment_status_id">
											<option value='' selected disabled>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `appointment_status`;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												if($id==$appointment_status_id){$selected = "selected";} else {$selected="";}
												$description = $row['description'];
												echo "<option value='$id' $selected>$description</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="fee" class="col-sm-2 col-form-label col-form-label-sm">Fee</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="fee" name="fee" value="<?php echo $fee;?>">
									</div>
								</div>								
								<div class="form-group row">
									<label for="payment_status_id" class="col-sm-2 col-form-label col-form-label-sm">Payment Status</label>
									<div class="col-sm-2">
										<select class="form-control form-control-sm" id="payment_status_id" name="payment_status_id">
											<option value='' selected disabled>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `payment_status`;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												if($id==$payment_status_id){$selected = "selected";} else {$selected="";}
												$description = $row['description'];
												echo "<option value='$id' $selected>$description</option>";
											}
											?>
										</select>
									</div>
								</div>            
								<div class="form-group row">
									<label for="notes" class="col-sm-2 col-form-label col-form-label-sm">Notes</label>
									<div class="col-sm-10">
										<textarea class="form-control form-control-sm" id="notes" name="notes" rows="5"><?php echo $notes;?></textarea>
									</div>
								</div>
							</form>
						</div>
						<div class="card-footer">
							 <button type="button" class="btn btn-primary" id="add_form_save_button"><i class='fas fa-save'></i> Save</button>
							 <a href="client.php" class="btn btn-danger"><i class='fas fa-backward'></i> Back</a>
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
				$('#date').datepicker({
    				format: "dd/mm/yyyy",
					   orientation: "left bottom"
				});

				$("form[name='add_form']").validate({
					rules: {
						date: {required: true, ukdate: true, minlength: 10},
						time: {required: true},
						counsellor_user_id: {required: true},
						appointment_type_id: {required: true},
						appointment_status_id: {required: true},
						fee: {required: true, number: true, max:99.99, min:0},
					},
				  messages: {
					  date: "Please enter a valid date (dd/mm/yyyy)",
					  counsellor_user_id: "Please select an option",
					  appointment_type_id: "Please select an option",
					  appointment_status_id: "Please select an option"
				  },
				  submitHandler: function(form) {
					var appointment_id = $("#appointment_id").val();
					var client_id = $("#client_id").val();
					var date = $("#date").val();
				    var time = $("#time").val();
					var counsellor_user_id = $("#counsellor_user_id").val();
					var appointment_type_id = $("#appointment_type_id").val();
					var appointment_status_id = $("#appointment_status_id").val();
					var notes = $("#notes").val();
					var fee = $("#fee").val();
					var payment_status_id = $("#payment_status_id").val();

					$.post("ajax/appointment.edit.php", {
						appointment_id:appointment_id,
						client_id:client_id,
						date:date,
						time:time,
						counsellor_user_id:counsellor_user_id,
						appointment_type_id:appointment_type_id,
						appointment_status_id:appointment_status_id,
						notes:notes,
						fee:fee,
						payment_status_id:payment_status_id
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#modal_center_title").html("Success!");
								$("#modal_body").html("The appointment was successfully recorded.");
							} else {
								$("#modal_center_title").html("Update Failed!");
								$("#modal_body").html("There was a problem recording the appointment. [" + data +"]");
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