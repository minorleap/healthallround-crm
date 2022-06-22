<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "New Appointment"; ?>

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
						<h1 class="h2"><i class='fas fa-plus'></i> New Appointment</h1>
					</div>
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
										<input type="text" class="form-control form-control-sm" id="date" name="date">
									</div>
								</div>
								<div class="form-group row">
									<label for="time" class="col-sm-2 col-form-label col-form-label-sm">Time</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="time" name="time">
									</div>
								</div>
								<div class="form-group row">
									<label for="number_of_appointments" class="col-sm-2 col-form-label col-form-label-sm">Number of Appointments</label>
									<div class="col-sm-1">
										<select class="form-control form-control-sm" id="number_of_appointments" name="number_of_appointments">
											<?php
											for($i=1; $i<=20; $i++) {	
												$selected = $i==9? "selected" : "";
												echo "<option value='$i' $selected>$i</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="counsellor_user_id" class="col-sm-2 col-form-label col-form-label-sm">Counsellor</label>
									<div class="col-sm-4">
										<select class="form-control form-control-sm" id="counsellor_user_id" name="counsellor_user_id">
											<option value='' selected disabled>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `first_name`, `last_name` FROM `users` WHERE `is_counsellor`=1 ORDER BY `first_name` ASC;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												$name = $row['first_name'] . ' ' . $row['last_name'];
												echo "<option value='$id'>$name</option>";
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
												$description = $row['description'];
												echo "<option value='$id'>$description</option>";
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
												$description = $row['description'];
												echo "<option value='$id'>$description</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="fee" class="col-sm-2 col-form-label col-form-label-sm">Fee</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="fee" name="fee">
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
												$description = $row['description'];
												echo "<option value='$id'>$description</option>";
											}
											?>
										</select>
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
						payment_status_id: {required: true}
					},
				  messages: {
					  date: "Please enter a valid date (dd/mm/yyyy)",
					  counsellor_user_id: "Please select an option",
					  appointment_type_id: "Please select an option",
					  appointment_status_id: "Please select an option"
				  },
				  submitHandler: function(form) {					  

					var client_id = $("#client_id").val();
					var date = $("#date").val();
				    var time = $("#time").val();
					var counsellor_user_id = $("#counsellor_user_id").val();
					var appointment_type_id = $("#appointment_type_id").val();					  
					var appointment_status_id = $("#appointment_status_id").val();
					var fee = $("#fee").val();					  
					var payment_status_id = $("#payment_status_id").val();					  
					var number_of_appointments = $("#number_of_appointments").val();
					  

					$.post("ajax/appointment.new.php", {
						client_id:client_id,
						date:date,
						time:time,
						counsellor_user_id:counsellor_user_id,
						appointment_type_id:appointment_type_id,
						appointment_status_id:appointment_status_id,
						fee:fee,
						payment_status_id:payment_status_id,
						number_of_appointments:number_of_appointments
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#modal_center_title").html("Success!");
								$("#modal_body").html("The appointments were successfully recorded.");
							} else {
								$("#modal_center_title").html("Update Failed!");
								$("#modal_body").html("There was a problem recording the appointments. [" + data +"]");
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