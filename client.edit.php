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
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2"><i class='fas fa-edit'></i> Edit Client</h1>
					</div>
          
					<?php

					$data_error = 0;
					// Retrieve cliewnt_id from session data
					$client_id = $_SESSION['client_id'];

					// Validate ID
					if (!validate_string_isnumber($client_id)) {$data_error = 1;}

					if ($data_error == 0){
						$sql = "SELECT * FROM `clients` WHERE `ID`=$client_id;";
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
								$transgender_id = $row['transgender_id'];
								$gender_id = $row['gender_id'];
								$sexual_orientation_id = $row['sexual_orientation_id'];
								$employment_status_id = $row['employment_status_id'];
								$disability_status_id = $row['disability_status_id'];
								$ethnic_group_id = $row['ethnic_group_id'];
								$ethnic_group_other = $row['ethnic_group_other'];
								$religion_id = $row['religion_id'];
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
								$counselling_time_id = $row['counselling_time_id'];
								$counselling_time_other = $row['counselling_time_other'];
								$link_worker_sighthill = $row['link_worker_sighthill'];
								$link_worker_whinpark = $row['link_worker_whinpark'];
								$link_worker_springwell = $row['link_worker_springwell'];
								$link_worker_murrayfield = $row['link_worker_murrayfield'];
							}
						} else {
							die();
						}
					}

					?>
					
					<!-- Form - Add Client -->
					<form role="form" id="add_form" name="add_form" method="post">
						<input type="hidden" class="form-control" id="client_id" value="<?php echo $client_id; ?>">
						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<div class="col">
										<i class="fas fa-user" style="color: primary;"></i>&nbsp;&nbsp;Client Personal Details
									</div>
								</div>
							</h5>
							<div class="card-body">
								<div class="form-group row">
									<label for="first_name" class="col-sm-2 col-form-label col-form-label-sm">First Name</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="first_name" name="first_name" value="<?php echo $first_name;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="last_name" class="col-sm-2 col-form-label col-form-label-sm">Last Name</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="last_name" name="last_name"  value="<?php echo $last_name;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="preferred_name" class="col-sm-2 col-form-label col-form-label-sm">Preferred Name</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="preferred_name" name="preferred_name"  value="<?php echo $preferred_name;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="date_of_birth" class="col-sm-2 col-form-label col-form-label-sm">Date of Birth</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="date_of_birth" name="date_of_birth" value="<?php echo $date_of_birth;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="address_1" class="col-sm-2 col-form-label col-form-label-sm">Address</label>
									<div class="col-sm-6">
										<input type="text" class="form-control form-control-sm" id="address_1" name="address_1" value="<?php echo $address_1;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="address_2" class="col-sm-2 col-form-label col-form-label-sm"></label>
									<div class="col-sm-6">
										<input type="text" class="form-control form-control-sm" id="address_2" name="address_2" value="<?php echo $address_2;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="town_city" class="col-sm-2 col-form-label col-form-label-sm">Town/City</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="town_city" name="town_city" value="<?php echo $town_city;?>">
									</div>
									<label for="postcode" class="col-sm-1 col-form-label col-form-label-sm">Postcode</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="postcode" name="postcode"  value="<?php echo $postcode;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="telephone" class="col-sm-2 col-form-label col-form-label-sm">Telephone</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="telephone" name="telephone" value="<?php echo $telephone;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="mobile" class="col-sm-2 col-form-label" col-form-label-sm>Mobile</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="mobile" name="mobile" value="<?php echo $mobile;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="email" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="email" name="email" value="<?php echo $email;?>">
									</div>
								</div>
								
								<hr>
								
								<div class="form-group row">
									<label for="data_consent_script" class="col-sm-2 col-form-label col-form-label-sm">Data Sharing Script</label>
									<div class="col-sm-9">
										<textarea class="form-control" rows=4>
Health All Round will store the following information:	
•	Registration Forms and database records including diversity monitoring (all clients)
•	Core 10 &amp; Client Assessment notes (Counselling/ CBT &amp; Anxiety Management)
•	Before / After measures for Counselling &amp; Anxiety Management 
•	Counselling notes/ recordings
•	Physical Activities/ Healthy Eating Record sheets and administrative notes (Active Steps)
•	Evaluations (anonymous)
•	Incident / Accident records
•	E – mail correspondence and E-mailing list
											
This information will be used in order to meet your health needs and our health &amp; safety obligations. We will keep your information secure and retain it only for as long as is necessary. Your information will not be used for any purpose* other than that for which you gave it, or shared with any other agency without your specific consent (eg. if you wish us to work with your GP or another health professional). 
Health All Round works in partnership with a number of other agencies to deliver services and when this is the case there will be data sharing agreements in place. This means that the co-facilitators and HAR staff may, with your consent, share your information for the purposes of that service, but for no other purpose. 
*In exceptional circumstances  information may be shared without your consent eg. risk of suicide/ harm to self or others. In these instances we will, wherever it is possible or safe to do so, seek your agreement, or alert you to our decision. Only information that is necessary and relevant would be passed on to appropriate professionals.
											
In order to ensure you get the help you need we may signpost you on to other agencies. This will involve sending them your contact details so that they are able to get in touch to discuss the service and your needs.  You will be informed wherever this is the case and you can always opt out. 										
										</textarea>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-2">
										<label class="form-check-label" for="data_consent">Data Sharing Consent</label>
									</div>
									<div class="col-sm-1">
										<div class="form-check">
											<?php $checked = $consent_data? "checked" : "";?>		
											<input class="form-check-input" type="checkbox" value="" id="consent_data" name="consent_data" <?php echo $checked;?>>
										</div>
									</div>
								</div>								

								<hr>

								<div class="form-group row">
									<div class="col-sm-2">
										<label class="form-check-label" for="">Contact Consent</label>
									</div>
									<div class="col-sm-1">
										<div class="form-check">
											<?php $checked = $consent_mail? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="consent_mail" name="consent_mail" <?php echo $checked;?>>
											<label class="form-check-label" for="consent_mail">Mail</label>
										</div>
									</div>
									<div class="col-sm-1">
										<div class="form-check">
											<?php $checked = $consent_email? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="consent_email" name="consent_email" <?php echo $checked;?>>
											<label class="form-check-label" for="consent_email">Email</label>
										</div>
									</div>
									<div class="col-sm-1">
										<div class="form-check">
											<?php $checked = $consent_phone? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="consent_phone" name="consent_phone" <?php echo $checked;?>>
											<label class="form-check-label" for="consent_phone">Phone</label>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="form-check">
											<?php $checked = $consent_phone_identification? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="consent_phone_identification" name="consent_phone_identification" <?php echo $checked;?>>
											<label class="form-check-label" for="consent_phone_identification">HAR can be mentioned to whoever answers</label>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="preferred_contact_method" class="col-sm-2 col-form-label col-form-label-sm">Preferred Contact Method</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="preferred_contact_method" name="preferred_contact_method" value="<?php echo $preferred_contact_method;?>">
									</div>
								</div>								
								<div class="form-group row">
									<div class="col-sm-2">
										<label class="form-check-label" for="">Marketing Permission</label>
									</div>
									<div class="col-sm-2">
										<div class="form-check">
											<?php $checked = $consent_email_list? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="consent_email_list" name="consent_email_list" <?php echo $checked;?>>
											<label class="form-check-label" for="consent_email_list">HAR Mailing List</label>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-check">
											<?php $checked = $consent_marketing_photography? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="consent_marketing_photography" name="consent_marketing_photography" <?php echo $checked;?>>
											<label class="form-check-label" for="consent_marketing_photography">Inclusion in HAR Publicity Photos</label>
										</div>	
									</div>
								</div>

								<hr>

								<div class="form-group row">
									<label for="emergency_contact_name" class="col-sm-3 col-form-label col-form-label-sm">Emergency Contact Name</label>
									<div class="col-sm-9">
										<input type="text" class="form-control form-control-sm" id="emergency_contact_name" name="emergency_contact_name" value="<?php echo $emergency_contact_name;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="emergency_contact_phone" class="col-sm-3 col-form-label col-form-label-sm">Emergency Contact Phone</label>
									<div class="col-sm-9">
										<input type="text" class="form-control form-control-sm" id="emergency_contact_phone" name="emergency_contact_phone" value="<?php echo $emergency_contact_phone;?>">
									</div>									
								</div>
								<div class="form-group row">
									<label for="gp_name" class="col-sm-3 col-form-label col-form-label-sm">GP Name</label>
									<div class="col-sm-9">
										<input type="text" class="form-control form-control-sm" id="gp_name" name="gp_name" value="<?php echo $gp_name;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="gp_surgery" class="col-sm-3 col-form-label col-form-label-sm">GP Surgery</label>
									<div class="col-sm-9">
										<input type="text" class="form-control form-control-sm" id="gp_surgery" name="gp_surgery" value="<?php echo $gp_surgery;?>">
									</div>
								</div>
								<br>
								<div class="form-group row">
									<div class="col-sm-10">
										<div class="form-check">
											<?php $checked = $has_existing_health_professional? "checked" : "";?>
											<input class="form-check-input" type="checkbox" value="" id="has_existing_health_professional" name="prefers_previous_counsellor" <?php echo $checked;?>>
											<label class="form-check-label" for="has_existing_health_professional">Another Health Professional is Providing Support to this Client</label>
										</div>										
									</div>
								</div>
								<div class="form-group row">
									<label for="gp_name" class="col-sm-3 col-form-label col-form-label-sm">Other Health Professional Details</label>
									<div class="col-sm-9">
										<input type="text" class="form-control form-control-sm" id="existing_health_professional_details" name="existing_health_professional_details" value="<?php echo $existing_health_professional_details;?>">
									</div>									
								</div>

								<hr>

								<div class="form-group row">
									<label for="how_did_you_hear" class="col-sm-3 col-form-label col-form-label-sm">How did you hear about us?</label>
									<div class="col-sm-9">
										<input type="text" class="form-control form-control-sm" id="how_did_you_hear" name="how_did_you_hear" value="<?php echo $how_did_you_hear;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="services_desired" class="col-sm-3 col-form-label col-form-label-sm">Which HAR services do you intend to use?</label>
									<div class="col-sm-9">
										<input type="text" class="form-control form-control-sm" id="services_desired" name="services_desired" value="<?php echo $services_desired;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="medical_details" class="col-sm-3 col-form-label col-form-label-sm">Any medical details you'd like us to be aware of?</label>
									<div class="col-sm-9">
										<input type="text" class="form-control form-control-sm" id="medical_details" name="medical_details" value="<?php echo $medical_details;?>">
									</div>
								</div>
							</div>
						</div>
						<br>

						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<div class="col">
										<i class="fas fa-balance-scale" style="color: primary;"></i>&nbsp;&nbsp;Equalities Monitoring
									</div>
								</div>
							</h5>
							<div class="card-body">
								<div class="form-group row">
									<label for="age_group_id" class="col-sm-2 col-form-label col-form-label-sm">Age Group</label>
									<div class="col-sm-3">
										<select class="form-control form-control-sm" id="age_group_id" name="age_group_id" value="1">
											<option value="" disabled selected>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `age_group` WHERE `is_enabled`=1;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												$description = $row['description'];
												$selected = $age_group_id==$id? "Selected" : "";
												echo "<option value='$id' $selected>$description</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="transgender_id" class="col-sm-2 col-form-label col-form-label-sm">Transgender (currently or previously)</label>
									<div class="col-sm-3">
										<select class="form-control form-control-sm" id="transgender_id" name="transgender_id" value="1">
											<option value="" disabled selected>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `transgender` WHERE `is_enabled`=1;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												$description = $row['description'];
												$selected = $transgender_id==$id? "Selected" : "";
												echo "<option value='$id' $selected>$description</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="gender_id" class="col-sm-2 col-form-label col-form-label-sm">Gender</label>
									<div class="col-sm-3">
										<select class="form-control form-control-sm" id="gender_id" name="gender_id" value="1">
											<option value="" disabled selected>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `gender` WHERE `is_enabled`=1;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												$description = $row['description'];
												$selected = $gender_id==$id? "Selected" : "";
												echo "<option value='$id' $selected>$description</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="sexual_orientation_id" class="col-sm-2 col-form-label col-form-label-sm">Sexual Orientation</label>
									<div class="col-sm-3">
										<select class="form-control form-control-sm" id="sexual_orientation_id" name="sexual_orientation_id" value="1">
											<option value="" disabled selected>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `sexual_orientation` WHERE `is_enabled`=1;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												$description = $row['description'];
												$selected = $sexual_orientation_id==$id? "Selected" : "";
												echo "<option value='$id' $selected>$description</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="employment_status_id" class="col-sm-2 col-form-label col-form-label-sm">Employment Status</label>
									<div class="col-sm-3">
										<select class="form-control form-control-sm" id="employment_status_id" name="employment_status_id" value="1">
											<option value="" disabled selected>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `employment_status` WHERE `is_enabled`=1;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												$description = $row['description'];
												$selected = $employment_status_id==$id? "Selected" : "";
												echo "<option value='$id' $selected>$description</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="disability_status_id" class="col-sm-2 col-form-label col-form-label-sm">Disability Status</label>
									<div class="col-sm-3">
										<select class="form-control form-control-sm" id="disability_status_id" name="disability_status_id" value="1">
											<option value="" disabled selected>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `disability` WHERE `is_enabled`=1;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												$description = $row['description'];
												$selected = $disability_status_id==$id? "Selected" : "";
												echo "<option value='$id' $selected>$description</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="ethnic_group_id" class="col-sm-2 col-form-label col-form-label-sm">Ethnicity</label>
									<div class="col-sm-3">
										<select class="form-control form-control-sm" id="ethnic_group_id" name="ethnic_group_id">
											<option value="" disabled selected>Select Option...</option>
											<?php
											$ethnic_groups = array();
											$sql = "SELECT DISTINCT `group` FROM ethnic_group;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$group = $row['group'];
												array_push($ethnic_groups, $group);
											}

											foreach ($ethnic_groups as $ethnic_group) {
												echo "<optgroup label='$ethnic_group'>";

												$sql = "SELECT `id`, `description`, `group` FROM `ethnic_group` WHERE `is_enabled`=1 AND `group`='$ethnic_group' ORDER BY `id`;";
												$result = $conn->query($sql);
												while($row = $result->fetch_assoc()){
													$id = $row['id'];
													$description = $row['description'];
													$selected = $ethnic_group_id==$id? "Selected" : "";
													echo "<option value='$id' $selected>$description</option>";
												}
												echo "</optgroup>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="ethnic_group_other" class="col-sm-2 col-form-label col-form-label-sm">Other Ethnicity</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="ethnic_group_other" name="ethnic_group_other" value="<?php echo $ethnic_group_other;?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="religion_id" class="col-sm-2 col-form-label col-form-label-sm">Religion</label>
									<div class="col-sm-3">
										<select class="form-control form-control-sm" id="religion_id" name="religion_id" value="1">
											<option value="" disabled selected>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `religion` WHERE `is_enabled`=1;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												$description = $row['description'];
												$selected = $religion_id==$id? "Selected" : "";
												echo "<option value='$id' $selected>$description</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
										<div class="form-check">
											<?php $checked = $receiving_benefits? "checked" : "";?>
											<input class="form-check-input" type="checkbox" value="" id="receiving_benefits" name="receiving_benefits" <?php echo $checked;?>>
											<label class="form-check-label" for="receiving_benefits">In Receipt of Benefits</label>
										</div>										
									</div>
								</div>								
								<div class="form-group row">
									<div class="col-sm-2">
										<label class="form-check-label" for="">Caring Responsibilities</label>
									</div>
									<div class="col-sm-8">
										<div class="form-check">
											<?php $checked = $caring_none? "checked" : "";?>
											<input class="form-check-input" type="checkbox" value="" id="caring_none" name="caring_none" <?php echo $checked;?>>
											<label class="form-check-label" for="caring_none">None</label>
										</div>
										<div class="form-check">
											<?php $checked = $caring_primary_under_18? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="caring_primary_under_18" name="caring_primary_under_18" <?php echo $checked;?>>
											<label class="form-check-label" for="caring_primary_under_18">Primary carer of a person under 18</label>
										</div>
										<div class="form-check">
											<?php $checked = $caring_primary_disabled_children? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="caring_primary_disabled_children" name="caring_primary_disabled_children" <?php echo $checked;?>>
											<label class="form-check-label" for="caring_primary_disabled_children">Primary carer of disabled child/children</label>
										</div>
										<div class="form-check">
											<?php $checked = $caring_primary_disabled_over_18? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="caring_primary_disabled_over_18" name="caring_primary_disabled_over_18" <?php echo $checked;?>>
											<label class="form-check-label" for="caring_primary_disabled_over_18">Primary carer of disabled person over 18</label>
										</div>
										<div class="form-check">
											<?php $checked = $caring_primary_older_person? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="caring_primary_older_person" name="caring_primary_older_person" <?php echo $checked;?>>
											<label class="form-check-label" for="caring_primary_older_person">Primary carer of older person (65+)</label>
										</div>
										<div class="form-check">
											<?php $checked = $caring_secondary? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="caring_secondary" name="caring_secondary" <?php echo $checked;?>>
											<label class="form-check-label" for="caring_secondary">Secondary carer</label>
										</div>										
									</div>
									<div class="col-sm-1">

									</div>
									<div class="col-sm-1">

									</div>
									<div class="col-sm-1">

									</div>
									<div class="col-sm-1">

									</div>
									<div class="col-sm-1">

									</div>
								</div>
							</div>
						</div>						

						<br>

						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<div class="col">
										<i class="fas fa-hand-holding-medical" style="color: primary;"></i>&nbsp;&nbsp;Client Counselling Details
									</div>
								</div>
							</h5>
							<div class="card-body">
								<div class="form-group row">
									<div class="col-sm-5">
										<div class="form-check">
											<?php $checked = $prefers_previous_counsellor? "checked" : "";?>
											<input class="form-check-input" type="checkbox" value="" id="prefers_previous_counsellor" name="prefers_previous_counsellor" <?php echo $checked;?>>
											<label class="form-check-label" for="prefers_previous_counsellor">Would Prefer To See Their Previous Counsellor</label>
										</div>										
									</div>
								</div>

								<div class="form-group row">
									<label for="previous_counsellor_name" class="col-sm-2 col-form-label col-form-label-sm">Previous Counsellor's Name</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="previous_counsellor_name" name="previous_counsellor_name" value="<?php echo $previous_counsellor_name;?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="counselling_time_id" class="col-sm-2 col-form-label col-form-label-sm">Preferred Counselling Time</label>
									<div class="col-sm-2">
										<select class="form-control form-control-sm" id="counselling_time_id" name="counselling_time_id">
											<option value="" disabled selected>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `counselling_time` WHERE `is_enabled`=1;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												$description = $row['description'];
												$selected = $counselling_time_id==$id? "Selected" : "";
												echo "<option value='$id' $selected>$description</option>";
											}
											?>
										</select>
									</div>
								</div>
								
								<div class="form-group row">
									<label for="counselling_time_other" class="col-sm-2 col-form-label col-form-label-sm">Other Availability Details</label>
									<div class="col-sm-3">
										<input type="text" class="form-control form-control-sm" id="counselling_time_other" name="counselling_time_other" value="<?php echo $counselling_time_other;?>">
									</div>
								</div>
								
								<div class="form-group row">
									<label for="counsellor_gender_id" class="col-sm-2 col-form-label col-form-label-sm">Preferred Counsellor Gender</label>
									<div class="col-sm-2">
										<select class="form-control form-control-sm" id="counsellor_gender_id" name="counsellor_gender_id">
											<option value="" disabled selected>Select Option...</option>
											<?php
											$sql = "SELECT `id`, `description` FROM `counsellor_gender` WHERE `is_enabled`=1;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$id = $row['id'];
												$description = $row['description'];
												$selected = $counsellor_gender_id==$id? "Selected" : "";
												echo "<option value='$id' $selected>$description</option>";
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<br>
						
						<div class="card">
							<h5 class="card-header">
								<div class="row align-items-center">
									<div class="col">
										<i class="fas fa-link" style="color: primary;"></i>&nbsp;&nbsp;Link Worker Details
									</div>
								</div>
							</h5>
							<div class="card-body">
								<div class="form-group row">
									<div class="col-sm-5">
										<div class="form-check">
											<?php $checked = $link_worker_murrayfield? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="link_worker_murrayfield" name="link_worker_murrayfield" <?php echo $checked;?>>
											<label class="form-check-label" for="link_worker_murrayfield">Link Worker - Murrayfield</label>
										</div>										
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-5">
										<div class="form-check">
											<?php $checked = $link_worker_sighthill? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="link_worker_sighthill" name="link_worker_sighthill" <?php echo $checked;?>>
											<label class="form-check-label" for="link_worker_sighthill">Link Worker - Sighthill</label>
										</div>										
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-5">
										<div class="form-check">
											<?php $checked = $link_worker_springwell? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="link_worker_springwell" name="link_worker_springwell" <?php echo $checked;?>>
											<label class="form-check-label" for="link_worker_sighthill">Link Worker - Springwell</label>
										</div>										
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-5">
										<div class="form-check">
											<?php $checked = $link_worker_whinpark? "checked" : "";?>
											<input class="form-check-input" type="checkbox" id="link_worker_whinpark" name="link_worker_whinpark" <?php echo $checked;?>>
											<label class="form-check-label" for="link_worker_whinpark">Link Worker - Whinpark</label>
										</div>										
									</div>
								</div>
							</div>
						</div>				
						<div class="card-footer">
							 <button type="button" class="btn btn-primary" id="add_form_save_button"><i class='fas fa-save'></i> Save</button>
							 <a href="clients.php" class="btn btn-danger"><i class='fas fa-backward'></i> Back</a>
							  <button type="button" class="btn btn-warning" id="delete_client_button" style="float: right" ><i class="fas fa-trash"></i> Delete Client</button>
						</div>
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
		
		<!-- Delete Modal -->
		<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="modal_center_title" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="delete_modal_center_title">Delete Client</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Are you sure you wish to permanently delete this client?</p>
						<p>This will delete all of the client's related records (e.g. appointments, measuremants, activity attendance)</p>
					</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-warning" id="delete_client_confirm_button"><i class="fas fa-trash"></i> Delete</button>
					</div>
				</div>
			</div>
		</div>
		
		
		<?php // Add Scripts
		include("includes/scripts.php"); ?>

		<script>

			$(document).ready(function(){
				
//				$('#date_of_birth').datepicker({
//    				format: "dd/mm/yyyy",
//					orientation: "left bottom"
//				});
        
				// Initialize form validation on the form.
				// It has the name attribute "registration"
				$("form[name='add_form']").validate({
					// Specify validation rules
				  	rules: {
						first_name: {required: true, maxlength: 100},
						last_name: {required: true, maxlength: 100},
						preferred_name: {maxlength: 100},
						date_of_birth: {required: true, ukdate: true, minlength: 10},
						address_1: {required: true, maxlength: 50},
						address_2: {maxlength: 50},            
						town_city: {required: true,maxlength: 50},            
						postcode: {required: true,postcode: true},            
						telephone: {maxlength: 50},
						mobile: {maxlength: 50},
						email: {email: true},
						age_group_id: {required: true},
						transgender_id: {required: true},
						gender_id: {required: true},
						sexual_orientation_id: {required: true},
						employment_status_id: {required: true},
						disability_status_id: {required: true},
						ethnic_group_id: {required: true},
						ethnic_group_other: {maxlength: 100},
						religion_id: {required: true},
						emergency_contact_phone: {maxlength: 50},
						gp_name: {maxlength: 100},
						gp_surgery: {maxlength: 100},
						previous_counsellor_name: {maxlength:100},
						counsellor_gender_id: {required: true},
						counselling_time_id: {required: true},
						counselling_time_other: {maxlength:100},
					},
				  	// Specify validation error messages
				  	messages: {
						first_name: "Please enter a first name",
						last_name: "Please enter a last name",
          				date_of_birth: "Please enter a valid date (dd/mm/yyyy)",
          				postcode: "Please enter a UK postcode",
						email: "Please enter a valid email address",
						age_group_id: "Please select an option",
						transgender_id: "Please select an option",
						gender_id: "Please select an option",
						sexual_orientation_id: "Please select an option",
						employment_status_id: "Please select an option",
						disability_status_id: "Please select an option",
						ethnic_group_id: "Please select an option",
						religion_id: "Please select an option"
				  	},
				  	// Make sure the form is submitted to the destination defined
				  	// in the "action" attribute of the form when valid
				  	submitHandler: function(form) {
						// Form is valid, add a new client
						// Get form values
						var client_id = $("#client_id").val();
						var user_id = $("#user_id").val();  
						var first_name = $("#first_name").val();
						var last_name = $("#last_name").val();
						var preferred_name = $("#preferred_name").val();
						var date_of_birth = $("#date_of_birth").val();						
						var address_1 = $("#address_1").val();
						var address_2 = $("#address_2").val();
						var town_city = $("#town_city").val();
						var postcode = $("#postcode").val();
						var telephone = $("#telephone").val();
						var mobile = $("#mobile").val();
						var email = $("#email").val();
						var consent_data = $("#consent_data").prop('checked')?1:0;
						var consent_mail = $("#consent_mail").prop('checked')?1:0;
						var consent_phone = $("#consent_phone").prop('checked')?1:0;
						var consent_email = $("#consent_email").prop('checked')?1:0;
						var consent_phone_identification = $("#consent_phone_identification").prop('checked')?1:0;
						var consent_email_list = $("#consent_email_list").prop('checked')?1:0;
						var consent_marketing_photography = $("#consent_marketing_photography").prop('checked')?1:0;
						var preferred_contact_method = $("#preferred_contact_method").val();
						var emergency_contact_name = $("#emergency_contact_name").val();
						var emergency_contact_phone = $("#emergency_contact_phone").val();
						var gp_name = $("#gp_name").val();
						var gp_surgery = $("#gp_surgery").val();
						var has_existing_health_professional = $("#has_existing_health_professional").prop('checked')?1:0;
						var existing_health_professional_details = $("#existing_health_professional_details").val();
						var how_did_you_hear = $("#how_did_you_hear").val();
						var services_desired = $("#services_desired").val();
						var medical_details = $("#medical_details").val();
						var age_group_id = $("#age_group_id").val();
						var transgender_id = $("#transgender_id").val();
						var gender_id = $("#gender_id").val();
						var sexual_orientation_id = $("#sexual_orientation_id").val();
						var employment_status_id = $("#employment_status_id").val();
						var disability_status_id = $("#disability_status_id").val();
						var ethnic_group_id = $("#ethnic_group_id").val();
						var ethnic_group_other = $("#ethnic_group_other").val();
						var religion_id = $("#religion_id").val();
						var receiving_benefits = $("#receiving_benefits").prop('checked')?1:0;
						var caring_none = $("#caring_none").prop('checked')?1:0;
						var caring_primary_under_18 = $("#caring_primary_under_18").prop('checked')?1:0;
						var caring_primary_disabled_children = $("#caring_primary_disabled_children").prop('checked')?1:0;
						var caring_primary_disabled_over_18 = $("#caring_primary_disabled_over_18").prop('checked')?1:0;
						var caring_primary_older_person = $("#caring_primary_older_person").prop('checked')?1:0;
						var caring_secondary = $("#caring_secondary").prop('checked')?1:0;
						var prefers_previous_counsellor = $("#prefers_previous_counsellor").prop('checked')?1:0;
						var previous_counsellor_name = $("#previous_counsellor_name").val();
						var counsellor_gender_id = $("#counsellor_gender_id").val();
						var counselling_time_id = $("#counselling_time_id").val();
						var counselling_time_other = $("#counselling_time_other").val();						
						var link_worker_sighthill = $("#link_worker_sighthill").prop('checked')?1:0;
						var link_worker_whinpark = $("#link_worker_whinpark").prop('checked')?1:0;
						var link_worker_springwell = $("#link_worker_springwell").prop('checked')?1:0;
						var link_worker_murrayfield = $("#link_worker_murrayfield").prop('checked')?1:0;
						

						$.post("ajax/client.edit.php", {
							client_id:client_id,
							user_id:user_id,
							first_name:first_name,
							last_name:last_name,
							preferred_name:preferred_name,
							date_of_birth:date_of_birth,							
							address_1:address_1,
							address_2:address_2,
							town_city:town_city,
							postcode:postcode,
							telephone:telephone,
							mobile:mobile,
							email:email,
							age_group_id:age_group_id,
							transgender_id:transgender_id,
							gender_id:gender_id,
							sexual_orientation_id:sexual_orientation_id,
							employment_status_id:employment_status_id,
							disability_status_id:disability_status_id,
							ethnic_group_id:ethnic_group_id,
							ethnic_group_other:ethnic_group_other,
							religion_id:religion_id,
							receiving_benefits:receiving_benefits,
							caring_none:caring_none,
							caring_primary_under_18:caring_primary_under_18,
							caring_primary_disabled_children:caring_primary_disabled_children,
							caring_primary_disabled_over_18:caring_primary_disabled_over_18,
							caring_primary_older_person:caring_primary_older_person,
							caring_secondary:caring_secondary,
							consent_data:consent_data,
							consent_mail:consent_mail,
							consent_phone:consent_phone,
							consent_email:consent_email,
							consent_phone_identification:consent_phone_identification,
							consent_email_list:consent_email_list,
							consent_marketing_photography:consent_marketing_photography,
							preferred_contact_method:preferred_contact_method,
							emergency_contact_name:emergency_contact_name,
							emergency_contact_phone:emergency_contact_phone,
							gp_name:gp_name,
							gp_surgery:gp_surgery,
							has_existing_health_professional:has_existing_health_professional,
							existing_health_professional_details:existing_health_professional_details,
							medical_details:medical_details,
							services_desired:services_desired,
							how_did_you_hear:how_did_you_hear,
							prefers_previous_counsellor:prefers_previous_counsellor,
							previous_counsellor_name:previous_counsellor_name,
							counsellor_gender_id:counsellor_gender_id,
							counselling_time_id:counselling_time_id,
							counselling_time_other:counselling_time_other,
							link_worker_sighthill:link_worker_sighthill,
							link_worker_whinpark:link_worker_whinpark,
							link_worker_springwell:link_worker_springwell,
							link_worker_murrayfield:link_worker_murrayfield
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#modal_center_title").html("Success!");
								$("#modal_body").html("The client was successfully updated.");
							} else {
								$("#modal_center_title").html("Update Failed!");
								$("#modal_body").html("There was a problem updating the client. [" + data +"]");
							}
							$("#confirm_modal").modal()
						})
					}
				});

				// Add event to the save button
				$("#add_form_save_button").click(function() {
					$("#add_form").submit()
				});
				
				// Add event to the delete button
				$("#delete_client_button").click(function() {
					$("#delete_modal").modal();
				});
				
				// Add event to the delete button
				$("#delete_client_confirm_button").click(function() {
					var client_id = $("#client_id").val();
					$.post("ajax/client.delete.php", {
						client_id:client_id
					})
					.done(function(data){
						if(data.substring(0, 2)=="OK") {
							window.location.href = "/index.php";
						} else {
							$("#modal_center_title").html("Delete Failed!");
							$("#modal_body").html("There was a problem deleting the client. [" + data +"]");
						}
					})
				});
				
			});				

		</script>
	</body>
</html>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>