<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Edit Counselling Block"; ?>

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
						<h1 class="h2"><i class='fas fa-edit'></i> Edit Counselling Block</h1>
					</div>
          
					<?php

					$data_error = 0;

					// Clean GET values to prevent SQL injection
					$counselling_block_id = $_GET['id'];
					$counselling_block_id = filter_var($counselling_block_id, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

					// Validate ID
					if (!validate_string_isnumber($counselling_block_id)) {$data_error = 1;}

					if ($data_error == 0){
						$sql = "SELECT * FROM `counselling_blocks` WHERE `ID`=$counselling_block_id";
						$result = $conn->query($sql);
						if ($result->num_rows == 1){
							while($row = $result->fetch_assoc()){
								$client_id = $row['client_id'];
								$counsellor_user_id = $row['counsellor_user_id'];
								$start_date = date("d/m/Y", strtotime($row['start_date']));
								$end_date = date("d/m/Y", strtotime($row['end_date']));
								$evaluation_date = $row['evaluation_date']? date("d/m/Y", strtotime($row['evaluation_date'])) : "";
								$history_general = $row['history_general'];
								$history_selfharm = $row['history_selfharm'];
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
									<i class="fas fa-tasks"></i>&nbsp;&nbsp;Counselling Block Details
								</div>
							</div>
						</h5>
						<div class="card-body">
							<!-- Form - Edit Counselling Block -->
							<form role="form" id="add_form" name="add_form" method="post">
								<input type="hidden" class="form-control" id="counselling_block_id" value="<?php echo $counselling_block_id; ?>">
								<div class="form-group row">
									<label for="client_id" class="col-sm-2 col-form-label col-form-label-sm">Client</label>
									<div class="col-sm-4">
										<select class="form-control form-control-sm" id="client_id" name="client_id">
											<?php
											$sql = "SELECT `id`, `full_name` FROM `view_clients` ORDER BY `full_name` DESC;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												$full_name = $row['full_name'];
												if($id == $client_id) {
													echo "<option value='$id' selected>$full_name</option>";
												} else {
													echo "<option value='$id'>$full_name</option>";}
												}
											?>
										</select>
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
									<label for="evaluation_date" class="col-sm-2 col-form-label col-form-label-sm">Evaluation Date</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="evaluation_date" name="evaluation_date" value="<?php echo $evaluation_date;?>">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label col-form-label-sm" for="history_general">General History</label>
									<div class="col-sm-10">
										<textarea class="form-control form-control-sm" id="history_general" name="history_general" rows="5"><?php echo $history_general;?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label col-form-label-sm" for="history_selfharm">Self-Harm History</label>
									<div class="col-sm-10">
										<textarea class="form-control form-control-sm" id="history_selfharm" name="history_selfharm" rows="5"><?php echo $history_selfharm;?></textarea>
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
				$('#start_date,#end_date,#evaluation_date').datepicker({
    				format: "dd/mm/yyyy",
					   orientation: "left bottom"
				});

				// Initialize form validation on the form.
				// It has the name attribute "registration"
				$("form[name='add_form']").validate({
					rules: {
						start_date: {required: true, ukdate: true, minlength: 10},
						end_date: {required: true, ukdate: true, minlength: 10},
						evaluation_date: {ukdate: true, minlength: 10},
						counsellor_user_id: {required: true}
					},
				  messages: {
					  start_date: "Please enter a valid date (dd/mm/yyyy)",
					  end_date: "Please enter a valid date (dd/mm/yyyy)",
					  evaluation_date: "Please enter a valid date (dd/mm/yyyy)",
					  counsellor_user_id: "Please select an option"
				  },
				  submitHandler: function(form) {

					var client_id = $("#client_id").val();
					var start_date = $("#start_date").val();
					var end_date = $("#end_date").val();
					var evaluation_date = $("#evaluation_date").val();
					var counsellor_user_id = $("#counsellor_user_id").val();
					var history_general = $("#history_general").val();
					var history_selfharm = $("#history_selfharm").val();
					var counselling_block_id = $("#counselling_block_id").val();


					$.post("ajax/counsellingblock.edit.php", {
						client_id:client_id,
						start_date:start_date,
						end_date:end_date,
						evaluation_date:evaluation_date,
						counsellor_user_id:counsellor_user_id,
						history_general:history_general,
						history_selfharm:history_selfharm,
						counselling_block_id:counselling_block_id
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#modal_center_title").html("Success!");
								$("#modal_body").html("The counselling block was successfully updated.");
							} else {
								$("#modal_center_title").html("Update Failed!");
								$("#modal_body").html("There was a problem updating the counselling block. [" + data +"]");
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