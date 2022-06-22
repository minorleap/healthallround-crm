<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Administration Settings"; ?>
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
						<h1 class="h2"><i class='fas fa-sliders-h'></i> Administration Settings</h1>
					</div>
					
					<div id="accordion">
						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<button class="btn collapsed" data-toggle="collapse" data-target="#collapse_duration">Activity Durations</button>
								</div>
							</h5>
							<div id="collapse_duration" class="collapse" data-parent="#accordion">
								<div class="card-body">							
									<div class="container-fluid m-0 p-0">
										<div class="row">
											<div class="table-responsive col-12">
												<table class="table table-striped table-sm table-fixed" id="durations_table">
													<thead>
														<tr>
															<th>Description</th>
															<th>Value</th>
															<th>Enabled</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php
													$sql = "SELECT * FROM `duration`;";
													$result = $conn->query($sql);
													while($row = $result->fetch_assoc()){    
														$id = $row['id'];
														$description = $row['description'];
														$value = $row['value'];
														$is_enabled = $row['is_enabled']? "<i class='fas fa-check-circle' style='color: green'></i>" : "<i class='fas fa-times-circle' style='color: red'></i>";
														$editBtn = '<button type="button" class="btn btn-sm btn-primary contact_table" onclick="edit_record(`duration`, `Activity Duration`,'. $id . ')"><i class="fas fa-edit"></i> Edit</button>';
														echo "<tr><td>$description</td><td>$value</td><td>$is_enabled</td><td>$editBtn</td></tr>";
													}
													?>
													</tbody>
												</table>
												
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer text-muted">	
									<button class="btn btn-primary" onclick="add_record(`duration`, `Activity Duration`)"><i class='fas fa-plus'></i> New Duration</button>
								</div>
							</div>
						</div>
						
						<br/>

						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<button class="btn collapsed" data-toggle="collapse" data-target="#collapse_activity_frequency">Activity Frequencies</button>
								</div>
							</h5>
							<div id="collapse_activity_frequency" class="collapse" data-parent="#accordion">
								<div class="card-body">							
									<div class="container-fluid m-0 p-0">
										<div class="row">
											<div class="table-responsive col-12">
												<table class="table table-striped table-sm table-fixed" id="frequencies_table">
													<thead>
														<tr>
															<th>Description</th>
															<th>Enabled</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php
													$sql = "SELECT `id`, `description`, `is_enabled` FROM `activity_frequency`;";
													$result = $conn->query($sql);
													while($row = $result->fetch_assoc()){
														$id = $row['id'];
														$description = $row['description'];
														$is_enabled = $row['is_enabled']? "<i class='fas fa-check-circle' style='color: green'></i>" : "<i class='fas fa-times-circle' style='color: red'></i>";
														$editBtn = '<button type="button" class="btn btn-sm btn-primary contact_table" onclick="edit_record(`activity_frequency`, `Activity Frequency`,'. $id . ')"><i class="fas fa-edit"></i> Edit</button>';
														echo "<tr><td>$description</td><td>$is_enabled</td><td>$editBtn</td></tr>";
													}
													?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer text-muted">	
									<button class="btn btn-primary" onclick="add_record(`activity_frequency`, `Activity Frequency`)"><i class='fas fa-plus'></i> New Frequency</button>
								</div>
							</div>
						</div>
						<br/>

						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<button class="btn collapsed" data-toggle="collapse" data-target="#collapse_enquiry_method">Enquiry Methods</button>
								</div>
							</h5>
							<div id="collapse_enquiry_method" class="collapse" data-parent="#accordion">
								<div class="card-body">							
									<div class="container-fluid m-0 p-0">
										<div class="row">
											<div class="table-responsive col-12">
												<table class="table table-striped table-sm table-fixed" id="enquiry_methods_table">
													<thead>
														<tr>
															<th>Description</th>
															<th>Enabled</th>
															<th>ACTION</th>
														</tr>
													</thead>
													<tbody>
													<?php
													$sql = "SELECT `id`, `description`, `is_enabled` FROM `enquiry_method`;";
													$result = $conn->query($sql);
													while($row = $result->fetch_assoc()){
														$id = $row['id'];
														$description = $row['description'];
														$is_enabled = $row['is_enabled']? "<i class='fas fa-check-circle' style='color: green'></i>" : "<i class='fas fa-times-circle' style='color: red'></i>";
														$editBtn = '<button type="button" class="btn btn-sm btn-primary contact_table" onclick="edit_record(`enquiry_method`, `Enquiry Method`,'. $id . ')"><i class="fas fa-edit"></i> Edit</button>';
														echo "<tr><td>$description</td><td>$is_enabled</td><td>$editBtn</td></tr>";
													}
													?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>	
								<div class="card-footer text-muted">	
									<button class="btn btn-primary" onclick="add_record(`enquiry_method`, `Enquiry Method`)"><i class='fas fa-plus'></i> New Enquiry Method</button>
								</div>
							</div>
						</div>
						<br/>

						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<button class="btn collapsed" data-toggle="collapse" data-target="#collapse_enquiry_type">Enquiry Types</button>
								</div>
							</h5>
							<div id="collapse_enquiry_type" class="collapse" data-parent="#accordion">							
								<div class="card-body">		
									<div class="container-fluid m-0 p-0">
										<div class="row">
											<div class="table-responsive col-12">
												<table class="table table-striped table-sm table-fixed" id="enquiry_types_table">
													<thead>
														<tr>
															<th>Description</th>
															<th>Enabled</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php
													$sql = "SELECT `id`, `description`, `is_enabled` FROM `enquiry_type`;";
													$result = $conn->query($sql);
													while($row = $result->fetch_assoc()){
														$id = $row['id'];
														$description = $row['description'];
														$is_enabled = $row['is_enabled']? "<i class='fas fa-check-circle' style='color: green'></i>" : "<i class='fas fa-times-circle' style='color: red'></i>";
														$editBtn = '<button type="button" class="btn btn-sm btn-primary contact_table" onclick="edit_record(`enquiry_type`, `Enquiry Type`,'. $id . ')"><i class="fas fa-edit"></i> Edit</button>';
														echo "<tr><td>$description</td><td>$is_enabled</td><td>$editBtn</td></tr>";
													}
													?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer text-muted">	
									<button class="btn btn-primary" onclick="add_record(`enquiry_type`, `Enquiry Type`)"><i class='fas fa-plus'></i> New Enquiry Type</button>
								</div>
							</div>
						</div>
						<br/>

						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<button class="btn collapsed" data-toggle="collapse" data-target="#collapse_enquiry_time">Enquiry Times</button>
								</div>
							</h5>
							<div id="collapse_enquiry_time" class="collapse" data-parent="#accordion">
								<div class="card-body">							
									<div class="container-fluid m-0 p-0">
										<div class="row">
											<div class="table-responsive col-12">
												<table class="table table-striped table-sm table-fixed" id="enquiry_times_table">
													<thead>
														<tr>
															<th>Description</th>
															<th>Enabled</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php
													$sql = "SELECT `id`, `description`, `is_enabled` FROM `enquiry_time`;";
													$result = $conn->query($sql);
													while($row = $result->fetch_assoc()){
														$id = $row['id'];
														$description = $row['description'];
														$is_enabled = $row['is_enabled']? "<i class='fas fa-check-circle' style='color: green'></i>" : "<i class='fas fa-times-circle' style='color: red'></i>";
														$editBtn = '<button type="button" class="btn btn-sm btn-primary contact_table" onclick="edit_record(`enquiry_time`, `Enquiry Time`,'. $id . ')"><i class="fas fa-edit"></i> Edit</button>';
														echo "<tr><td>$description</td><td>$is_enabled</td><td>$editBtn</td></tr>";
													}
													?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer text-muted">	
									<button class="btn btn-primary" onclick="add_record(`enquiry_time`, `Enquiry Time`)"><i class='fas fa-plus'></i> New Enquiry Time</button>
								</div>
							</div>
						</div>
						<br/>

						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<button class="btn collapsed" data-toggle="collapse" data-target="#collapse_ethnic_group">Ethnic Groups</button>
								</div>
							</h5>
							<div id="collapse_ethnic_group" class="collapse" data-parent="#accordion">
								<div class="card-body">							
									<div class="container-fluid m-0 p-0">
										<div class="row">
											<div class="table-responsive col-12">
												<table class="table table-striped table-sm table-fixed" id="ethnic_groups_table">
													<thead>
														<tr>
															<th>Description</th>
															<th>Enabled</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php
													$sql = "SELECT `id`, `description`, `is_enabled` FROM `ethnic_group`;";
													$result = $conn->query($sql);
													while($row = $result->fetch_assoc()){
														$id = $row['id'];
														$description = $row['description'];
														$is_enabled = $row['is_enabled']? "<i class='fas fa-check-circle' style='color: green'></i>" : "<i class='fas fa-times-circle' style='color: red'></i>";
														$editBtn = '<button type="button" class="btn btn-sm btn-primary contact_table" onclick="edit_record(`ethnic_group`, `Ethnic Group`,'. $id . ')"><i class="fas fa-edit"></i> Edit</button>';
														echo "<tr><td>$description</td><td>$is_enabled</td><td>$editBtn</td></tr>";
													}
													?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer text-muted">	
									<button class="btn btn-primary" onclick="add_record(`ethnic_group`, `Ethnic Group`)"><i class='fas fa-plus'></i> New Ethnic Group</button>
								</div>
							</div>
						</div>
						<br/>

						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<button class="btn collapsed" data-toggle="collapse" data-target="#collapse_gender">Gender</button>
								</div>
							</h5>
							<div id="collapse_gender" class="collapse" data-parent="#accordion">							
								<div class="card-body">							
									<div class="container-fluid m-0 p-0">
										<div class="row">
											<div class="table-responsive col-12">
												<table class="table table-striped table-sm table-fixed" id="genders_table">
													<thead>
														<tr>
															<th>Description</th>
															<th>Enabled</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php
													$sql = "SELECT `id`, `description`, `is_enabled` FROM `gender`;";
													$result = $conn->query($sql);
													while($row = $result->fetch_assoc()){
														$id = $row['id'];
														$description = $row['description'];
														$is_enabled = $row['is_enabled']? "<i class='fas fa-check-circle' style='color: green'></i>" : "<i class='fas fa-times-circle' style='color: red'></i>";
														$editBtn = '<button type="button" class="btn btn-sm btn-primary contact_table" onclick="edit_record(`gender`, `Gender`,'. $id . ')"><i class="fas fa-edit"></i> Edit</button>';
														echo "<tr><td>$description</td><td>$is_enabled</td><td>$editBtn</td></tr>";
													}
													?>
													</tbody>
												</table>
											</div>										
										</div>
									</div>
								</div>
								<div class="card-footer text-muted">	
									<button class="btn btn-primary" onclick="add_record(`gender`, `Gender`)"><i class='fas fa-plus'></i> New Gender</button>
								</div>
							</div>
						</div>
						<br/>

						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<button class="btn collapsed" data-toggle="collapse" data-target="#collapse_residency_status">Residency Status</button>
								</div>
							</h5>
							<div id="collapse_residency_status" class="collapse" data-parent="#accordion">
								<div class="card-body">							
									<div class="container-fluid m-0 p-0">
										<div class="row">
											<div class="table-responsive col-12">
												<table class="table table-striped table-sm table-fixed" id="residency_statuses_table">
													<thead>
														<tr>
															<th>Description</th>
															<th>Enabled</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php
													$sql = "SELECT `id`, `description`, `is_enabled` FROM `residency_status`;";
													$result = $conn->query($sql);
													while($row = $result->fetch_assoc()){
														$id = $row['id'];
														$description = $row['description'];
														$is_enabled = $row['is_enabled']? "<i class='fas fa-check-circle' style='color: green'></i>" : "<i class='fas fa-times-circle' style='color: red'></i>";
														$editBtn = '<button type="button" class="btn btn-sm btn-primary contact_table" onclick="edit_record(`residency_status`, `Residency Status`,'. $id . ')"><i class="fas fa-edit"></i> Edit</button>';
														echo "<tr><td>$description</td><td>$is_enabled</td><td>$editBtn</td></tr>";
													}
													?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer text-muted">	
									<button class="btn btn-primary" onclick="add_record(`residency_status`, `Residency Status`)"><i class='fas fa-plus'></i> New Residency Status</button>
								</div>
							</div>
						</div>
						<br/>

						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<button class="btn collapsed" data-toggle="collapse" data-target="#collapse_services">Services</button>
								</div>
							</h5>
							<div id="collapse_services" class="collapse" data-parent="#accordion">
								<div class="card-body">							
									<div class="container-fluid m-0 p-0">
										<div class="row">
											<div class="table-responsive col-12">
												<table class="table table-striped table-sm table-fixed" id="services_table">
													<thead>
														<tr>
															<th>Description</th>
															<th>Enabled</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php
													$sql = "SELECT `id`, `description`, `is_enabled` FROM `services`;";
													$result = $conn->query($sql);
													while($row = $result->fetch_assoc()){
														$id = $row['id'];
														$description = $row['description'];
														$is_enabled = $row['is_enabled']? "<i class='fas fa-check-circle' style='color: green'></i>" : "<i class='fas fa-times-circle' style='color: red'></i>";
														$editBtn = '<button type="button" class="btn btn-sm btn-primary contact_table" onclick="edit_record(`services`, `Service`,'. $id . ')"><i class="fas fa-edit"></i> Edit</button>';
														echo "<tr><td>$description</td><td>$is_enabled</td><td>$editBtn</td></tr>";
													}
													?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer text-muted">	
									<button class="btn btn-primary" onclick="add_record(`services`, `Service`)"><i class='fas fa-plus'></i> New Service</button>
								</div>
							</div>
						</div>
						<br/>
						
						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<button class="btn collapsed" data-toggle="collapse" data-target="#collapse_client">Client Administration</button>
								</div>
							</h5>
							<div id="collapse_client" class="collapse" data-parent="#accordion">
								<div class="card-body">							
									<div class="container-fluid m-0 p-0">
										<div class="row">
											<div class="col-12">
												<a href="clients.expired.php"> Expired Client Report (GDPR)</a>
											</div>
										</div>
									</div>
								</div>
							</div>							
							
							
							
							
						</div>
						
						<br/>						
						
						
						
					</div>											
				</main>
			</div>
		</div>
		
		<!-- Edit Modal -->
		<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal_title" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="edit_modal_title">Modal Title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<span id="edit_modal_body"></span>
					</div>
						<div class="modal-footer">
						<button id="edit_modal_save_btn" type="button" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-backward"></i> Back</button>						
					</div>
				</div>
			</div>
		</div>
		
		<!-- Add Modal -->
		<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="add_modal_title" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="add_modal_title">Modal Title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<span id="add_modal_body"></span>
					</div>
						<div class="modal-footer">
						<button id="add_modal_save_btn" type="button" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-backward"></i> Back</button>
					</div>
				</div>
			</div>
		</div>		
		
		<?php // Add Scripts
		include("includes/scripts.php"); ?>

		<script>
			
			$(document).ready(function(){
				const urlParams = new URLSearchParams(window.location.search);
				const section = urlParams.get('section');
				$("#collapse_" + section).collapse('show');
			});					

			function edit_record(record_type, record_label, record_id) {
				$("#edit_modal_title").html(record_label);
				$.ajax({url: "/ajax/admin-modal.edit.php?id=" + record_id + "&type=" + record_type, success: function(result){
					$("#edit_modal_body").html(result);
					$("#edit_modal_save_btn").off("click"); // clear the onclick event handlers from the save button
					$("#edit_modal_save_btn").click(function() {
						var description = $("#description").val();
						var value = $("#value").val();
						var is_enabled = $("#is_enabled").prop('checked')?1:0;
						$.post("ajax/" + record_type + ".edit.php?id=" + record_id, {
							record_id:record_id,
							description:description,
							value:value,
							is_enabled:is_enabled
						})
						.done(function(data){
							$("#edit_modal").modal('hide');						
							window.location.href = '/administration.php?section=' + record_type;
						})
					})
					$("#edit_modal").modal();
  				}});
			}
				
			function add_record(record_type, record_label) {
				$("#add_modal_title").html(record_label);
				$.ajax({url: "/ajax/admin-modal.new.php?type=" + record_type, success: function(result){
					$("#add_modal_body").html(result);
					$("#add_modal_save_btn").off("click"); // clear the onclick event handlers from the save button
					$("#add_modal_save_btn").click(function() {
						var description = $("#description").val();
						var value = $("#value").val();
						var is_enabled = $("#is_enabled").prop('checked')?1:0;
						$.post("ajax/" + record_type + ".new.php?", {
							description:description,
							value:value,
							is_enabled:is_enabled
						})
						.done(function(data){
							$("#add_modal").modal('hide');						
							window.location.href = '/administration.php?section=' + record_type;
						})
					})
					$("#add_modal").modal();
  				}});
			}

		</script>



	</body>
</html>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>