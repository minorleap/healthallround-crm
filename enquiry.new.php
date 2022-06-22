<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "New Enquiry"; ?>

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
						<h1 class="h2"><i class='fas fa-plus'></i> New Enquiry</h1>
					</div>
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col">
									<i class="fas fa-tasks"></i>&nbsp;&nbsp;Enquiry Details
								</div>
							</div>
						</h5>
						<div class="card-body">
							<!-- Form - Add Enquiry -->
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
									<label for="enquiry_date" class="col-sm-2 col-form-label col-form-label-sm">Enquiry Date</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="enquiry_date" name="enquiry_date" value="<?php echo date("d/m/Y");?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="service_id" class="col-sm-2 col-form-label col-form-label-sm">Service</label>
									<div class="col-sm-4">
										<select class="form-control form-control-sm" id="service_id" name="service_id">
											<option value='' selected disabled>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `services`;";
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
									<label for="enquiry_type_id" class="col-sm-2 col-form-label col-form-label-sm">Enquiry Type</label>
									<div class="col-sm-3">
										<select class="form-control form-control-sm" id="enquiry_type_id" name="enquiry_type_id">
											<option value='' selected disabled>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `enquiry_type`;";
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
									<label for="enquiry_method_id" class="col-sm-2 col-form-label col-form-label-sm">Enquiry Method</label>
									<div class="col-sm-2">
										<select class="form-control form-control-sm" id="enquiry_method_id" name="enquiry_method_id">
											<option value='' selected disabled>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `enquiry_method`;";
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
									<label for="details" class="col-sm-2 col-form-label col-form-label-sm">Details</label>
									<div class="col-sm-10">
										<textarea class="form-control form-control-sm" id="details" name="details" rows="5"><?php echo $details;?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="took_enquiry_staff_id" class="col-sm-2 col-form-label col-form-label-sm">Who took enquiry</label>
									<div class="col-sm-2">
										<select class="form-control form-control-sm" id="took_enquiry_staff_id" name="took_enquiry_staff_id">
											<?php
											$sql = "SELECT `id`, `first_name`, `last_name`, `is_enabled` FROM `users`;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												$name = $row['first_name'] . " ". $row['last_name'];
												if($row['id']==$_SESSION['user.id']){$selected = "selected";} else {$selected="";}
												if($row['is_enabled']==0){$disabled = "disabled";} else {$disabled="";}
												echo "<option value='$id' $selected $disabled>$name</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="passed_to_staff_id" class="col-sm-2 col-form-label col-form-label-sm">Enquiry passed to</label>
									<div class="col-sm-2">
										<select class="form-control form-control-sm" id="passed_to_staff_id" name="passed_to_staff_id">
											<?php
											$sql = "SELECT `id`, `first_name`, `last_name`, `is_enabled` FROM `users`;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												$name = $row['first_name'] . " ". $row['last_name'];
												if($row['id']==0){$selected = "selected";} else {$selected="";}
												if($row['is_enabled']==0){$disabled = "disabled";} else {$disabled="";}
												echo "<option value='$id' $selected $disabled>$name</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="time_spent_id" class="col-sm-2 col-form-label col-form-label-sm">Time Spent</label>
									<div class="col-sm-2">
										<select class="form-control form-control-sm" id="time_spent_id" name="time_spent_id">
											<?php
											$sql = "SELECT `id`, `description` FROM `time_spent`;";
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
										<label class="form-check-label" >Requires Feedback</label>
									</div>
									<div class="col-sm-2">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="requires_feedback" name="requires_feedback">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="feedback_date" class="col-sm-2 col-form-label col-form-label-sm">Feedack Date</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="feedback_date" name="feedback_date">
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
				$('#enquiry_date,#feedback_date').datepicker({
    				format: "dd/mm/yyyy",
					   orientation: "left bottom"
				});

				$("form[name='add_form']").validate({
					rules: {
						enquiry_date: {required: true, ukdate: true, minlength: 10},
						feedback_date: { ukdate: true, minlength: 10},
						details: {maxlength: 128},
						service_id: {required: true},
						enquiry_type_id: {required: true},
						enquiry_method_id: {required: true}
					},
				  messages: {
					  enquiry_date: "Please enter a valid date (dd/mm/yyyy)",
					  feedback_date: "Please enter a valid date (dd/mm/yyyy)",
					  service_id: "Please select an option",
					  enquiry_type_id: "Please select an option",
					  enquiry_method_id: "Please select an option"
				  },
				  submitHandler: function(form) {

					var client_id = $("#client_id").val();
					var enquiry_date = $("#enquiry_date").val();
					var service_id = $("#service_id").val();
					var enquiry_type_id = $("#enquiry_type_id").val();
					var enquiry_method_id = $("#enquiry_method_id").val();
					var details = $("#details").val();
					var took_enquiry_staff_id = $("#took_enquiry_staff_id").val();
					var passed_to_staff_id = $("#passed_to_staff_id").val();
					var time_spent_id = $("#time_spent_id").val();
					var requires_feedback = $("#requires_feedback").prop('checked')?1:0;
					var feedback_date = $("#feedback_date").val();

					$.post("ajax/enquiry.new.php", {
						client_id:client_id,
						enquiry_date:enquiry_date,
						service_id:service_id,
						enquiry_type_id:enquiry_type_id,
						enquiry_method_id:enquiry_method_id,
						details:details,
						took_enquiry_staff_id:took_enquiry_staff_id,
						passed_to_staff_id:passed_to_staff_id,
						time_spent_id:time_spent_id,
						requires_feedback:requires_feedback,
						feedback_date:feedback_date
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#modal_center_title").html("Success!");
								$("#modal_body").html("The enquiry was successfully recorded.");
							} else {
								$("#modal_center_title").html("Update Failed!");
								$("#modal_body").html("There was a problem recording the enquiry. [" + data +"]");
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