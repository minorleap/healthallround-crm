<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Users"; ?>
<?php

	if ($_SESSION["user.is_admin"]==0){
		header("Location: https://app.healthallround.org.uk/");
		exit;
	} 

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<title><?php echo $pageTitle; ?></title>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<!-- Datatables CSS -->
		<link href="css/datatables.min.css" rel="stylesheet">
		<!-- Application CSS -->
		<link href="css/application.css" rel="stylesheet">
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
						<h1 class="h2"><i class="fas fa-users"></i> Users</h1>
						<div class="btn-toolbar mb-2 mb-md-0">
							<button type="button" id="add_user_button" class="btn btn btn-primary"><i class="fas fa-user-plus"></i> Add New User</button>
						</div>
					</div>

					<div class="table-responsive">
						<table class="table table-striped table-sm table-fixed" id="users_table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Username</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Enabled</th>
									<th>Counsellor</th>
									<th>Admin</th>
									<th>Super Admin</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</main>
			</div>

			</div>
		</div>
		
		<!-- Modal Form - Change Password -->
		<div class="modal fade" id="password_modal" tabindex="-1" role="dialog" aria-labelledby="password_modal_label" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header" style="border-radius: 0.3rem 0.3rem 0 0">
						<h5 class="modal-title" id="password_modal_label"><i class='fas fa-lock'></i> Change Password</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form role="form" id="password_modal_form" method="post">
							<div class="form-group">
								<label for="password_modal_password" class="col-form-label">New Password</label>
								<input type="password" class="form-control" id="password_modal_password" data-validation="length" data-validation-length="8-100" data-validation-error-msg="Required. Minimum 8 characters.">
							</div>
							<input type="hidden" id="password_modal_id" value="">
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fas fa-times'></i> Close</button>
						<button type="button" class="btn btn-primary" id="password_modal_save_button"><i class='fas fa-save'></i> Save</button>
					</div>
				</div>
			</div>
		</div>

	
	<!-- Modal Form - Edit User -->
		<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal_label" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header" style="border-radius: 0.3rem 0.3rem 0 0">
						<h5 class="modal-title" id="edit_modal_label"><i class='fas fa-user-edit'></i> Edit User</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form role="form" id="edit_modal_form" method="post">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="edit_modal_first_name" class="col-form-label">First Name</label>
									<input type="text" class="form-control" id="edit_modal_first_name" data-validation="custom" data-validation-regexp="^([A-Za-z\'\-. ]{1,150})$" data-validation-error-msg="Required. Only use A-Z or '-.">
								</div>
								<div class="form-group col-md-6">
									<label for="edit_modal_last_name" class="col-form-label">Last Name</label>
									<input type="text" class="form-control" id="edit_modal_last_name" data-validation="custom" data-validation-regexp="^([A-Za-z\'\-. ]{1,150})$" data-validation-error-msg="Required. Only use A-Z or '-.">
								</div>
							</div>
							<div class="form-group">
								<label for="edit_modal_username" class="col-form-label">Email Address</label>
								<input type="text" class="form-control" id="edit_modal_username" data-validation="email" data-validation-error-msg="A valid email address is required">
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="checked" id="edit_modal_is_enabled">
								<label class="form-check-label" for="edit_modal_is_enabled">User is Enabled</label>					
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="edit_modal_is_counsellor">
								<label class="form-check-label" for="edit_modal_is_counsellor">User is Counsellor</label>
							</div>							
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="edit_modal_is_admin">
								<label class="form-check-label" for="edit_modal_is_admin">Administrator</label>							
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="edit_modal_is_super_admin">
								<label class="form-check-label" for="edit_modal_is_super_admin">Super Administrator</label>							
							</div>
							<input type="hidden" id="edit_modal_id" value="">
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fas fa-times'></i> Close</button>
						<button type="button" class="btn btn-primary" id="edit_modal_save_button"><i class='fas fa-save'></i> Save</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Form - Add User -->
		<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="add_modal_label" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header" style="border-radius: 0.3rem 0.3rem 0 0">
						<h5 class="modal-title" id="add_modal_label"><i class='fas fa-user-plus'></i> Add New User</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form role="form" id="add_modal_form" method="post">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="add_modal_first_name" class="col-form-label">First Name</label>
									<input type="text" class="form-control" id="add_modal_first_name" data-validation="custom" data-validation-regexp="^([A-Za-z\'\-. ]{1,150})$" data-validation-error-msg="Required. Only use A-Z or '-.">
								</div>
								<div class="form-group col-md-6">
									<label for="add_modal_last_name" class="col-form-label">Last Name</label>
									<input type="text" class="form-control" id="add_modal_last_name" data-validation="custom" data-validation-regexp="^([A-Za-z\'\-. ]{1,150})$" data-validation-error-msg="Required. Only use A-Z or '-.">
								</div>
							</div>
							<div class="form-group">
								<label for="add_modal_username" class="col-form-label">Email Address</label>
								<input type="text" class="form-control" id="add_modal_username" data-validation="email" data-validation-error-msg="A valid email address is required">
							</div>
							<div class="form-group">
								<label for="add_modal_password" class="col-form-label">Password</label>
								<input type="password" class="form-control" id="add_modal_password" data-validation="length" data-validation-length="8-100" data-validation-error-msg="Required. Minimum 8 characters.">
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="checked" id="add_modal_is_enabled">
								<label class="form-check-label" for="add_modal_is_enabled">User is Enabled</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="add_modal_is_counsellor">
								<label class="form-check-label" for="add_modal_is_counsellor">User is Counsellor</label>
							</div>								
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="checked" id="add_modal_is_admin">
								<label class="form-check-label" for="add_modal_is_admin">Administrator</label>							
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="add_modal_is_super_admin">
								<label class="form-check-label" for="add_modal_is_super_admin">Super Administrator</label>							
							</div>
							<input type="hidden" id="add_modal_id" value="">
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fas fa-times'></i> Close</button>
						<button type="button" class="btn btn-primary" id="add_modal_save_button"><i class='fas fa-save'></i> Save</button>
					</div>
				</div>
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
		
		
		
		
		
		
		<!-- Applicaition Plugins & Scripts -->
		<script src="js/jquery-3.4.1.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/dashboard.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jquery.form-validator.min.js"></script>
		<script src="js/datatables.min.js"></script>
		<script src="https://kit.fontawesome.com/251aff9797.js" crossorigin="anonymous"></script>	


		<script>

			$(document).ready(function(){
				
				$('#users_table').DataTable({
					"processing": true,
        			"serverSide": true,
					"ajax":"ajax/users.list.php"
				});
				
				

				
				//bootstrap.Toast.Default.delay = 20000;
				
				$('#edit_modal').on('show.bs.modal', function(event){
					// Button that triggered the modal
					var button = $(event.relatedTarget)
					// Populate the edit user modal using data from button attributes
					var id = button.data('id')
					var username = button.data('username')
					var first_name = button.data('first_name')
					var last_name = button.data('last_name')
					var is_enabled = button.data('is_enabled')
					var is_counsellor = button.data('is_counsellor')
					var is_admin = button.data('is_admin')
					var is_super_admin = button.data('is_super_admin')
					
					// Update the modal title and content
					var modal = $(this)
					modal.find('.modal-body #edit_modal_id').val(id)
					modal.find('.modal-body #edit_modal_username').val(username)
					modal.find('.modal-body #edit_modal_first_name').val(first_name)
					modal.find('.modal-body #edit_modal_last_name').val(last_name)
					modal.find('.modal-body #edit_modal_is_enabled').prop('checked',is_enabled?true:false) 
					modal.find('.modal-body #edit_modal_is_counsellor').prop('checked',is_enabled?true:false) 					
					modal.find('.modal-body #edit_modal_is_admin').prop('checked',is_admin?true:false) 
					modal.find('.modal-body #edit_modal_is_super_admin').prop('checked',is_super_admin?true:false)
				})

				$('#password_modal').on('show.bs.modal', function(event){
					// Button that triggered the modal
					var button = $(event.relatedTarget)
					// Populate the edit user modal using data from button attributes
					var id = button.data('id')
					
					// Update the modal title and content
					var modal = $(this)
					modal.find('.modal-body #password_modal_id').val(id)
				})
				
				
				// Set up validation on change password form and update record
				$.validate({
					form:'#password_modal_form',
					onSuccess:function($form){
						// Form is valid, get form values
						var id = $("#password_modal_id").val();
						var password = $("#password_modal_password").val();

						$.post("ajax/password.php", {
							id:id,
							password:password
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#modal_center_title").html("Success!");
								$("#modal_body").html("The user password was changed.");
							} else {
								$("#modal_center_title").html("Update Failed!");
								$("#modal_body").html("There was a problem changing the password. [" + data +"]");
							}
							// Refresh data table source
							var table = $('#users_table').DataTable();
							table.ajax.reload();
							// Hide password modal form
							$('#password_modal').modal('toggle');
							// Show confirmation modal
							$("#confirm_modal").modal()
						})						
						return false; // Prevent the form submission
					}
				});

				
				// Set up validation on edit user form and update record
				$.validate({
					form:'#edit_modal_form',
					onSuccess:function($form){
						// Form is valid, add a new user
						// Get form values
						var id = $("#edit_modal_id").val();
						var username = $("#edit_modal_username").val();
						var first_name = $("#edit_modal_first_name").val();
						var last_name = $("#edit_modal_last_name").val();
						var is_enabled = $("#edit_modal_is_enabled").prop('checked')?1:0;
						var is_counsellor = $("#edit_modal_is_counsellor").prop('checked')?1:0;
						var is_admin = $("#edit_modal_is_admin").prop('checked')?1:0;
						var is_super_admin = $("#edit_modal_is_super_admin").prop('checked')?1:0;
						

						$.post("ajax/users.php", {
							command:"update_user",
							id:id,
							username:username,
							password:'password',
							first_name:first_name,
							last_name:last_name,
							is_enabled:is_enabled,
							is_counsellor:is_counsellor,
							is_admin:is_admin,
							is_super_admin:is_super_admin
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#modal_center_title").html("Success!");
								$("#modal_body").html("The user was successfully updated.");
							} else {
								$("#modal_center_title").html("Update Failed!");
								$("#modal_body").html("There was a problem updating the user. [" + data +"]");
							}
							// Refresh data table source
							var table = $('#users_table').DataTable();
							table.ajax.reload();
							// Hide edit modal form
							$('#edit_modal').modal('toggle');
							// Show confirmation modal
							$("#confirm_modal").modal()
						})						
						return false; // Prevent the form submission
					}
				});

				
				
				// // Set up validation on add user form and update record
				$.validate({
					form:'#add_modal_form',
					onSuccess:function($form){
						// Form is valid, add a new user
						// Get form values
						var id = $("#add_modal_id").val();
						var username = $("#add_modal_username").val();
						var password = $("#add_modal_password").val();
						var first_name = $("#add_modal_first_name").val();
						var last_name = $("#add_modal_last_name").val();
						var is_enabled = $("#add_modal_is_enabled").prop('checked')?1:0;
						var is_counsellor = $("#add_modal_is_counsellor").prop('checked')?1:0;
						var is_admin = $("#add_modal_is_admin").prop('checked')?1:0;
						var is_super_admin = $("#add_modal_is_super_admin").prop('checked')?1:0;

						$.post("ajax/users.php", {
							command:"add_user",
							id:0,
							username:username,
							password:password,
							first_name:first_name,
							last_name:last_name,
							is_enabled:is_enabled,
							is_counsellor:is_counsellor,
							is_admin:is_admin,
							is_super_admin:is_super_admin
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#modal_center_title").html("Success!");
								$("#modal_body").html("The user was successfully added.");
							} else {
								$("#modal_center_title").html("Update Failed!");
								$("#modal_body").html("There was a problem adding the user. [" + data +"]");
							}
							// Refresh data table source
							var table = $('#users_table').DataTable();
							table.ajax.reload();
							// Hide add modal form
							$('#add_modal').modal('toggle');
							// Show confirmation modal
							$("#confirm_modal").modal()
						})
						return false; /// Prevent the form submission
					}
				});
				
				
				
				
				// Add event to the edit user modal save button
				$("#password_modal_save_button").click(function() {
					$("#password_modal_form").submit()
				});

				// Add event to the edit user modal save button
				$("#edit_modal_save_button").click(function() {
					$("#edit_modal_form").submit()
				});

				
				// Add event to the add user modal save button
				$("#add_modal_save_button").click(function() {
					$("#add_modal_form").submit()
				});
				
				// Add event to the [Add New User] button
				$("#add_user_button").click(function() {
					$('#add_modal_form')[0].reset();
					$('#add_modal').modal('toggle');
				})
				
				
				
			});				


		</script>
	</body>
</html>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
