<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Edit Service"; ?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<title><?php echo $pageTitle; ?></title>
		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
		<!-- Bootstrap Datepicker CSS -->
		<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
		<!-- Datatables CSS -->
		<link href="css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
		<!-- Application CSS -->
		<link href="css/application.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<!-- Top Navigation -->
		<?php include("includes/navigation.top.php"); ?>
		<div class="container-fluid">
			<div class="row">
				<!-- Left Navigation -->
				<?php include("includes/navigation.left.php"); ?>
				<!-- Content -->
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2"><?php echo $icon;?>Edit Service</h1>
					</div>
          
						<?php

						$data_error = 0;

						// Clean GET values to prevent SQL injection
						$service_id = $_GET['id'];
						$service_id = filter_var($service_id, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

						// Validate ID
						if (!validate_string_isnumber($service_id)) {$data_error = 1;}

						if ($data_error == 0){
							$sql = "SELECT * FROM `services` WHERE id=$service_id;";
							$result = $conn->query($sql);
							if ($result->num_rows == 1){
								while($row = $result->fetch_assoc()){
									$description = $row['description'];
									$is_enabled = $row['is_enabled'];
								}
							} else {
								die();
							}
						}

						?>

					<!-- Form - Add Service -->
					<form role="form" id="add_form" name="add_form" method="post">
            			<input type="hidden" class="form-control" id="service_id" value="<?php echo $service_id; ?>">
						<div class="form-group row">
							<label for="description" class="col-sm-2 col-form-label col-form-label-sm">Description</label>
							<div class="col-sm-3">
								<input type="text" class="form-control form-control-sm" id="description" name="description" value="<?php echo $description;?>">
							</div>
						</div>
						<div class="form-group row">
							<div class="form-check">
								<?php $checked = $is_enabled? "checked" : "";?>
								<input class="form-check-input" type="checkbox" id="is_enabled" name="is_enabled" <?php echo $checked;?>>
								<label class="form-check-label" for="requires_feedback">Enabled</label>
							</div>
						</div>

						<hr>
						
						<button type="button" class="btn btn-primary" id="add_form_save_button"><i class='fas fa-save'></i> Save</button>
						<br><br>
					</form>
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
		
		
		<!-- jQuery Script -->
		<script src="js/jquery.min.js" type="text/javascript"></script>
		<!-- Bootstrap Script -->
		<script src="js/bootstrap.js" type="text/javascript"></script>
    	<!-- jQuery Validate Script -->
		<script src="js/jquery.validate.min.js" type="text/javascript"></script>
		<!-- Bootstrap Datepicker Script -->
		<script src="js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<!-- fontawesome Script -->
		<script src="js/251aff9797.js"></script>
		<!-- Responsive Datatable Script -->
		<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
		<script src="js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
		<script src="js/dataTables.responsive.min.js" type="text/javascript"></script>
		<script src="js/responsive.bootstrap4.min.js" type="text/javascript"></script>
		<!-- Application Script -->
		<script src="js/application.js" type="text/javascript"></script>

		<script>

			$(document).ready(function(){

				// Initialize form validation on the form.
				// It has the name attribute "registration"
				$("form[name='add_form']").validate({
					// Specify validation rules
					rules: {
						description: {
						  maxlength: 128},    
					},
				  // Specify validation error messages
				  messages: {

				  },
				  // Make sure the form is submitted to the destination defined
				  // in the "action" attribute of the form when valid
				  submitHandler: function(form) {
					// Form is valid, add a new client
					// Get form values
					var service_id = $("#service_id").val();
					var description = $("#description").val();
					var is_enabled = $("#is_enabled").prop('checked')?1:0;


					$.post("ajax/service.edit.php", {
						service_id:service_id,
						description:description,
						is_enabled:is_enabled
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#modal_center_title").html("Success!");
								$("#modal_body").html("The service was successfully recorded.");
							} else {
								$("#modal_center_title").html("Update Failed!");
								$("#modal_body").html("There was a problem recording the service. [" + data +"]");
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