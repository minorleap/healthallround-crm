<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "View Client"; ?>
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
				<?php
				
				$data_error = 0;

				// Retrieve client_id from session data
				$client_id = $_SESSION['client_id'];
				$user_is_counsellor = $_SESSION['user.is_counsellor'];

				// Validate ID
				if (!validate_string_isnumber($client_id)) {$data_error = 1;}

				if ($data_error == 0){
					$sql = "SELECT * FROM `view_clients` WHERE `ID`=$client_id;";
					$result = $conn->query($sql);
					if ($result->num_rows == 1){
						while($row = $result->fetch_assoc()){
							$user_id = $row['created_by_user_id'];
							$first_name = $row['first_name'];
							$last_name = $row['last_name'];
							$preferred_name = $row['preferred_name'];
							$date_of_birth = date("d/m/Y", strtotime($row['date_of_birth']));							
							$address_1 = $row['address_1'];
							$address_2 = $row['address_2'];
							$town_city = $row['town_city'];
							$postcode = $row['postcode'];
							$telephone = $row['telephone'];
							$mobile = $row['mobile'];
							$email = $row['email'];
							$consent_data = $row['consent_data'];
							$consent_mail = $row['consent_mail'];
							$consent_phone = $row['consent_phone'];
							$consent_email = $row['consent_email'];
							$consent_phone_identification = $row['consent_phone_identification'];
							$consent_email_list = $row['consent_email_list'];
							$consent_marketing_photography = $row['consent_marketing_photography'];
							$preferred_contact_method = $row['preferred_contact_method'];
							$emergency_contact_name = $row['emergency_contact_name'];							
							$emergency_contact_phone = $row['emergency_contact_phone'];
							$gp_name = $row['gp_name'];
							$gp_surgery = $row['gp_surgery'];
							$has_existing_health_professional = $row['has_existing_health_professional'];
							$existing_health_professional_details = $row['existing_health_professional_details'];
							$how_did_you_hear = $row['how_did_you_hear'];
							$services_desired = $row['services_desired'];							
							$medical_details = $row['medical_details'];
							$age_group_id = $row['age_group_id'];
							$age_group_description = $row['age_group_description'];
							$transgender_id = $row['transgender_id'];
							$transgender_description = $row['transgender_description'];
							$gender_id = $row['gender_id'];
							$gender_description = $row['gender_description'];
							$sexual_orientation_id = $row['sexual_orientation_id'];
							$sexual_orientation_description = $row['sexual_orientation_description'];
							$employment_status_id = $row['employment_status_id'];
							$employment_status_description = $row['employment_status_description'];
							$disability_status_id = $row['disability_status_id'];
							$disability_status_description = $row['disability_status_description'];
							$ethnic_group_id = $row['ethnic_group_id'];
							$ethnic_group_description = $row['ethnic_group_description'];							
							$ethnic_group_other = $row['ethnic_group_other'];
							$religion_id = $row['religion_id'];
							$religion_description = $row['religion_description'];
							$receiving_benefits = $row['receiving_benefits'];
							$caring_none = $row['caring_none'];
							$caring_primary_under_18 = $row['caring_primary_under_18'];
							$caring_primary_disabled_children = $row['caring_primary_disabled_children'];
							$caring_primary_disabled_over_18 = $row['caring_primary_disabled_over_18'];
							$caring_primary_older_person = $row['caring_primary_older_person'];
							$caring_secondary = $row['caring_secondary'];									
							$prefers_previous_counsellor = $row['prefers_previous_counsellor'];
							$previous_counsellor_name = $row['previous_counsellor_name'];
							$counsellor_gender_id = $row['counsellor_gender_id'];
							$counsellor_gender_description = $row['counsellor_gender_description'];
							$counselling_time_id = $row['counselling_time_id'];
							$counselling_time_description = $row['counselling_time_description'];
							$counselling_time_other = $row['counselling_time_other'];
							$link_worker_sighthill = $row['link_worker_sighthill'];
							$link_worker_whinpark = $row['link_worker_whinpark'];
							$link_worker_springwell = $row['link_worker_springwell'];
							$link_worker_murrayfield = $row['link_worker_murrayfield'];
							$created_date = date("d/m/Y h:i A", strtotime($row['created_date']));
							$full_address = str_replace("</br></br>", "</br>","$address_1</br>$address_2</br>$town_city</br>$postcode");
						}
					} else {
						die();
					}
				}

				?>				
				
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2"><i class='fas fa-user'></i> <?php echo "&nbsp;&nbsp;$first_name $last_name"; if($is_deceased==1){echo " (Deceased)";} ?></h1>
					</div>
					
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-user" style="color: primary;"></i>&nbsp;&nbsp;Personal Details</div>
							</div>
						</h5>
						<div class="card-body">
							<p class="card-text" style='color: grey'>Added on <?php echo $created_date; ?>.</p>
							
							<div class="container-fluid m-0 p-0">
								<div class="row mt-3 mb-3">
									<div class="col-md-2">
										<?php if(strlen($date_of_birth)>0){echo "<strong>Birthdate:</strong></br>";} ?>
									</div>
									<div class="col-md-4">
										<?php if(strlen($date_of_birth)>0){echo "$date_of_birth</br>";} ?>				
									</div>
									<div class="col-md-2">
										<?php if(strlen($preferred_name)>0){echo "<strong>Preferred Name:</strong></br>";} ?>
									</div>
									<div class="col-md-4">
										<?php if(strlen($preferred_name)>0){echo "$preferred_name</br>";} ?>				
									</div>									
								</div>
								<div class="row">
									<div class="col-md-2"><strong>Address:</strong></div>
									<div class="col-md-4"><?php echo $full_address; ?></div>
									<div class="col-md-2">
										<?php echo "<strong>Telephone: </strong></br>"; ?>
										<?php echo "<strong>Mobile: </strong></br>"; ?>
										<?php echo "<strong>Email: </strong></br>"; ?>
									</div>
									<div class="col-md-4">
										<?php if(strlen($telephone)>0){echo "$telephone</br>";} else {echo "Not Recorded</br>";} ?>
										<?php if(strlen($mobile)>0){echo "$mobile</br>";} else {echo "Not Recorded</br>";} ?>
										<?php if(strlen($email)>0){echo "<a href='mailto:$email'>$email</a><br>";} else {echo "Not Recorded</br>";} ?>
									</div>
								</div>
								<hr>
								<div class="row mt-3">
									<div class="col-2">
										<strong>Preferred Contact:</strong><br>
									</div>
									<div class="col-4">
										<?php echo $preferred_contact_method;?><br>
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-2">
										<strong>Contact by mail:</strong><br>
										<strong>Contact by phone:</strong><br>
										<strong>Contact by email:</strong><br>
										<strong>Data sharing consent:</strong><br>
									</div>
									<div class="col-4">									
										<?php 
										if ($consent_mail==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										if ($consent_phone==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										if ($consent_email==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										if ($consent_data==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}										
										?>										
									</div>
									<div class="col-3">
										<strong>HAR can be identified when calling:</strong><br>
										<strong>Consent to email list:</strong><br>
										<strong>Consent to marketing photography:</strong><br>									
									</div>
									<div class="col-3">
										<?php
										if ($consent_phone_identification==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										if ($consent_email_list==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										if ($consent_marketing_photography==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										?>									
									</div>
								</div>
								<hr>
								<div class="row mt-3">
									<div class="col-md-4">
										<strong>Emergency Contact:</strong><br>
										<strong>Emergency Number:</strong><br>
									</div>
									<div class="col-md-6">
										<?php echo $emergency_contact_name; ?><br>
										<?php echo $emergency_contact_phone; ?><br>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-4">
										<strong>GP Name:</strong><br>
										<strong>GP Surgery:</strong><br>
									</div>
									<div class="col-md-6">
										<?php echo $gp_name; ?><br>
										<?php echo $gp_surgery; ?><br>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-4">
										<strong>Existing health professional:</strong><br>
										<strong>Existing health professional details:</strong><br>
									</div>
									<div class="col-md-6">
										<?php
										if ($has_existing_health_professional==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										?>
										<?php echo $existing_health_professional_details; ?><br>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-4">
										<strong>How did you hear about HAR?</strong><br>
										<strong>Which services do you intend to use?</strong><br>	
										<strong>Medical Details:</strong><br>
									</div>
									<div class="col-md-6">
										<?php echo $how_did_you_hear; ?><br>
										<?php echo $services_desired; ?><br>										
										<?php echo $medical_details; ?><br>
									</div>
								</div>
							</div>
				
				
						</div>
						<div class="card-footer text-muted">	
							<a href="client.edit.php" class="btn btn-primary"><i class='fas fa-edit'></i> Edit</a>
						</div>
					</div>	

					<br>
		
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-balance-scale" style="color: primary;"></i>&nbsp;&nbsp;Equalities Monitoring</div>
							</div>
						</h5>
						<div class="card-body">
							<div class="container-fluid m-0 p-0">
								<div class="row">
									<div class="col-md-4">
										<strong>Age Group:</strong><br>
										<strong>Transgender:</strong><br>										
										<strong>Gender:</strong><br>
										<strong>Sexual Orientation:</strong><br>
										<strong>Employment:</strong><br>
										<strong>Disability:</strong><br>
										<strong>Ethnicity:</strong><br>
										<strong>Ethnicity Other:</strong><br>											
										<strong>Religion:</strong><br>
									</div>
									<div class="col-md-6">
										<?php echo $age_group_description;?><br>
										<?php echo $transgender_description;?><br>
										<?php echo $gender_description;?><br>
										<?php echo $sexual_orientation_description;?><br>
										<?php echo $employment_status_description; ?><br>
										<?php echo $disability_status_description; ?><br>
										<?php echo $ethnic_group_description;?><br>
										<?php echo $ethnic_group_other;?><br>									
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-4">
										<strong>In Receipt of Benefits:</strong>
									</div>
									<div class="col-md-6">
										<?php
										if ($receiving_benefits==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										?>										
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-4">
										<strong>No caring responsibilities</strong><br>
										<strong>Primary carer of under 18</strong><br>
										<strong>Primary carer of disabled child/children</strong><br>
										<strong>Primary carer of disabled over 18</strong><br>
										<strong>Primary carer of older person (65+)</strong><br>
										<strong>Secondary carer</strong><br>
									</div>
									<div class="col-md-6">
										<?php
										if ($caring_none==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										?>
										<?php
										if ($caring_primary_under_18==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										?>
										<?php
										if ($caring_primary_disabled_children==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										?>
										<?php
										if ($caring_primary_disabled_over_18==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										?>
										<?php
										if ($caring_primary_older_person==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										?>
										<?php
										if ($caring_secondary==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										?>											
									</div>
								</div>
								
								<div class="row">
									<div class="col-md">&nbsp;</div>
								</div>
							</div>
				
				
						</div>
						<div class="card-footer text-muted">	
							<a href="client.edit.php" class="btn btn-primary"><i class='fas fa-edit'></i> Edit</a>
						</div>
					</div>
					<br>		
		
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-hand-holding-medical" style="color: primary;"></i>&nbsp;&nbsp;Counselling Details</div>
							</div>
						</h5>
						<div class="card-body">
							<div class="container-fluid m-0 p-0">
								<div class="row">
									<div class="col-md-4">
										<strong>Prefer to see previous counsellor?</strong><br>
										<strong>Previous counsellor's name</strong><br>
										<strong>Preferred counsellor gender</strong><br>
										<strong>Preferred counselling time</strong><br>
										<strong>Other availability details</strong><br>
									</div>
									<div class="col-md-6">
										<?php
										if ($prefers_previous_counsellor==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										?>
										<?php echo $previous_counsellor_name; ?><br>										
										<?php echo $counsellor_gender_description; ?><br>
										<?php echo $counselling_time_description; ?><br>
										<?php echo $counselling_time_other; ?><br>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md">&nbsp;</div>
								</div>
							</div>
				
				
						</div>
						<div class="card-footer text-muted">	
							<a href="client.edit.php" class="btn btn-primary"><i class='fas fa-edit'></i> Edit</a>
						</div>
					</div>
		
					<br>
		
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-hand-holding-medical" style="color: primary;"></i>&nbsp;&nbsp;Link Worker Details</div>
							</div>
						</h5>
						<div class="card-body">
							<div class="container-fluid m-0 p-0">
								<div class="row">
									<div class="col-md-4">
										<strong>Murrayfield Link Worker:</strong><br>										
										<strong>Sighthill Link Worker:</strong><br>
										<strong>Springwell Link Worker:</strong><br>
										<strong>Whinpark Link Worker:</strong><br>
									</div>
									<div class="col-md-6">
										<?php
										if ($link_worker_murrayfield==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										?>
										<?php
										if ($link_worker_sighthill==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										?>
										<?php
										if ($link_worker_springwell==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										?>
										<?php
										if ($link_worker_whinpark==1) {
											echo "<i class='fas fa-check-circle' style='color: green'></i></br>";
										} else {
											echo "<i class='fas fa-times-circle' style='color: red'></i></br>";
										}
										?>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md">&nbsp;</div>
								</div>
							</div>
				
				
						</div>
						<div class="card-footer text-muted">	
							<a href="client.edit.php" class="btn btn-primary"><i class='fas fa-edit'></i> Edit</a>
						</div>
					</div>
		
					<br>
		
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-tasks"></i> Enquiries</div>
							</div>
						</h5>		
						<div class="card-body">
							<div class="container-fluid m-0 p-0">
								<div class="row">
									<div class="col-md-12">
										<table class="table table-striped table-sm table-fixed" id="enquiries_table">
											<thead>
												<tr>
													<th>ID</th>
													<th>Date</th>
													<th>Service</th>
													<th>Method</th>									
													<th>Type</th>
													<th>Duration</th>
													<th>Details</th>
													<th>Action</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer text-muted">	
							<a href="enquiry.new.php" class="btn btn-primary"><i class='fas fa-plus'></i> New Enquiry</a>
							<a href="clients.php" class="btn btn-danger"><i class='fas fa-backward'></i> Back</a>
						</div>
					</div>
					<br>
		
					<!-- Counselling Section -->
					<?php if ($user_is_counsellor) {
						echo '
						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<div class="col"><i class="fas fa-tasks"></i> Measurements</div>
								</div>
							</h5>		
							<div class="card-body">
								<div class="container-fluid m-0 p-0">
									<div class="row">
										<div class="col-md-12">
											<table class="table table-striped table-sm table-fixed" id="measurements_table">
												<thead>
													<tr>
														<th>ID</th>
														<th>Assessment Date</th>
														<th>Type</th>
														<th>Total Score</th>
														<th>Questions Completed</th>
														<th>Mean Score</th>
														<th>Clinical Score</th>
														<th>Action</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer text-muted">	
								<a href="core10.new.php" class="btn btn-primary"><i class="fas fa-plus"></i> Core 10</a>
								<a href="dass21.new.php" class="btn btn-primary"><i class="fas fa-plus"></i> DASS 21</a>
								<a href="gad07.new.php" class="btn btn-primary"><i class="fas fa-plus"></i> GAD 07</a>
								<a href="phq09.new.php" class="btn btn-primary"><i class="fas fa-plus"></i> PHQ 09</a>
								<a href="clients.php" class="btn btn-danger"><i class="fas fa-backward"></i> Back</a>
							</div>
						</div>
						<br>
						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<div class="col"><i class="fas fa-tasks"></i> Counselling Blocks</div>
								</div>
							</h5>		
							<div class="card-body">
								<div class="container-fluid m-0 p-0">
									<div class="row">
										<div class="col-md-12">
											<table class="table table-striped table-sm table-fixed" id="counselling_blocks_table">
												<thead>
													<tr>
														<th>ID</th>
														<th>Counsellor</th>
														<th>Start Date</th>
														<th>End Date</th>
														<th>Evaluation Date</th>
														<th>General History</th>
														<th>Self-Harm History</th>
														<th>Action</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer text-muted">	
								<a href="counsellingblock.new.php" class="btn btn-primary"><i class="fas fa-plus"></i> New Counselling Block</a>
							</div>
						</div>		
						<br>
						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<div class="col"><i class="fas fa-tasks"></i> Appointments</div>
								</div>
							</h5>		
							<div class="card-body">
								<div class="container-fluid m-0 p-0">
									<div class="row">
										<div class="col-md-12">
											<table class="table table-striped table-sm table-fixed" id="appointments_table">
												<thead>
													<tr>
														<th>ID</th>
														<th>Date</th>
														<th>Time</th>
														<th>Counsellor</th>
														<th>Type</th>
														<th>Status</th>
														<th>Fee</th>
														<th>Payment Status</th>
														<th>Notes</th>
														<th>Action</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer text-muted">	
								<a href="appointment.new.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add Appointments</a>
							</div>
						</div>						
						';
					}
				?>
				</main>
			</div>
		</div>
		<?php // Add Scripts
		include("includes/scripts.php"); ?>

		<script>

			$(document).ready(function(){
				
				$('#enquiries_table').DataTable({
					"processing": true,
        			"serverSide": true,
					"ajax":"ajax/enquiry.list.php",
					"responsive": true,
					"order":[[0,"desc"]],
					"columnDefs": [
						{responsivePriority: 1, targets: [1,2,3,4]},
						{width: 75, targets: [7]},
						{visible: false, targets: [0]}
					],
					
				});
				
				$('#measurements_table').DataTable({
					"processing": true,
        			"serverSide": true,
					"ajax":"ajax/measurements.list.php",
					"responsive": true,
					"order":[[0,"desc"]],
					"columnDefs": [
						{responsivePriority: 1, targets: [1,2,3,4,5,6,7]},
						{visible: false, targets: [0]}
					],
					
				});
				$('#counselling_blocks_table').DataTable({
					"processing": true,
        			"serverSide": true,
					"ajax":"ajax/counsellingblock.list.php",
					"responsive": true,
					"order":[[0,"desc"]],
					"columnDefs": [
						{responsivePriority: 1, targets: [1,2,5,6,7]},
						{visible: false, targets: [0]}
					],
					
				});				
				$('#appointments_table').DataTable({
					"processing": true,
        			"serverSide": true,
					"ajax":"ajax/appointment.list.php",
					"responsive": true,
					"order":[[0,"desc"]],
					"columnDefs": [
						{responsivePriority: 1, targets: [1,2,8,9]},
						{visible: false, targets: [0]}
					],
					
				});

			});						

			function edit_enquiry(id){
				window.location.replace("enquiry.edit.php?id=" + id);
			}
			
			function edit_core10(id){
				window.location.replace("core10.edit.php?id=" + id);
			}

			function edit_dass21(id){
				window.location.replace("dass21.edit.php?id=" + id);
			}

			function edit_gad07(id){
				window.location.replace("gad07.edit.php?id=" + id);
			}
			
			function edit_phq09(id){
				window.location.replace("phq09.edit.php?id=" + id);
			}
			function edit_counselling_block(id){
				window.location.replace("counsellingblock.edit.php?id=" + id);
			}			
			function edit_appointment(id){
				window.location.replace("appointment.edit.php?id=" + id);
			}
			
		</script>



	</body>
</html>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>