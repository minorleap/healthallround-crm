<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "New Counselling Block"; ?>

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
						<h1 class="h2"><i class='fas fa-plus'></i> New Counselling Block</h1>
					</div>
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col">
									<i class="fas fa-tasks"></i>&nbsp;&nbsp;Counselling Details
								</div>
							</div>
						</h5>
						<div class="card-body">
							<!-- Form - Add Counselling Block -->
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
									<label for="start_date" class="col-sm-2 col-form-label col-form-label-sm">Start Date</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="start_date" name="start_date">
									</div>
								</div>
								<div class="form-group row">
									<label for="end_date" class="col-sm-2 col-form-label col-form-label-sm">End Date</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="end_date" name="end_date">
									</div>
								</div>
								<div class="form-group row">
									<label for="evaluation_date" class="col-sm-2 col-form-label col-form-label-sm">Evaluation Date</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="evaluation_date" name="evaluation_date">
									</div>
								</div>								
								<div class="form-group row">
									<label for="history_general" class="col-sm-2 col-form-label col-form-label-sm">General History</label>
									<div class="col-sm-10">
										<textarea class="form-control form-control-sm" id="history_general" name="history_general" rows="5"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="history_selfharm" class="col-sm-2 col-form-label col-form-label-sm">Self-Harm History</label>
									<div class="col-sm-10">
										<textarea class="form-control form-control-sm" id="history_selfharm" name="history_selfharm" rows="5"></textarea>
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

					$.post("ajax/counsellingblock.new.php", {
						client_id:client_id,
						start_date:start_date,
						end_date:end_date,
						evaluation_date:evaluation_date,
						counsellor_user_id:counsellor_user_id,
						history_general:history_general,
						history_selfharm:history_selfharm
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#modal_center_title").html("Success!");
								$("#modal_body").html("The counselling block was successfully recorded.");
							} else {
								$("#modal_center_title").html("Update Failed!");
								$("#modal_body").html("There was a problem recording the counselling block. [" + data +"]");
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