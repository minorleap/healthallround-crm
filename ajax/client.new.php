<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php

	// Sanitise form data
	$form_data = $_POST;
	foreach ($form_data as $key => $value) {
		$value = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		$value = $conn->real_escape_string($value);
		$form_data[$key] = $value;
	}

	$data_error = 0;

	$first_name = $form_data['first_name'];
	$last_name = $form_data['last_name'];
	$preferred_name = $form_data['preferred_name'];
	$date_of_birth = $form_data['date_of_birth'];
	$address_1 = $form_data['address_1'];
	$address_2 = $form_data['address_2'];
	$town_city = $form_data['town_city'];
	$postcode = $form_data['postcode'];
	$telephone = $form_data['telephone'];
	$mobile = $form_data['mobile'];
	$email = $form_data['email'];
	$consent_data = $form_data['consent_data'];
	$consent_mail = $form_data['consent_mail'];
	$consent_phone = $form_data['consent_phone'];
	$consent_email = $form_data['consent_email'];
	$consent_phone_identification = $form_data['consent_phone_identification'];
	$consent_email_list = $form_data['consent_email_list'];
	$consent_marketing_photography = $form_data['consent_marketing_photography'];
	$preferred_contact_method = $form_data['preferred_contact_method'];
	$emergency_contact_name = $form_data['emergency_contact_name'];
	$emergency_contact_phone = $form_data['emergency_contact_phone'];
	$gp_name = $form_data['gp_name'];
	$gp_surgery = $form_data['gp_surgery'];
	$has_existing_health_professional = $form_data['has_existing_health_professional'];
	$existing_health_professional_details = $form_data['existing_health_professional_details'];
	$how_did_you_hear = $form_data['how_did_you_hear'];
	$services_desired = $form_data['services_desired'];
	$medical_details = $form_data['medical_details'];
	$age_group_id = $form_data['age_group_id'];
	$transgender_id = $form_data['transgender_id'];
	$gender_id = $form_data['gender_id'];
	$sexual_orientation_id = $form_data['sexual_orientation_id'];
	$employment_status_id = $form_data['employment_status_id'];
	$disability_status_id = $form_data['disability_status_id'];
	$ethnic_group_id = $form_data['ethnic_group_id'];
	$ethnic_group_other = $form_data['ethnic_group_other'];
	$religion_id = $form_data['religion_id'];
	$receiving_benefits = $form_data['receiving_benefits'];
	$caring_none = $form_data['caring_none'];
	$caring_primary_under_18 = $form_data['caring_primary_under_18'];
	$caring_primary_disabled_children = $form_data['caring_primary_disabled_children'];
	$caring_primary_disabled_over_18 = $form_data['caring_primary_disabled_over_18'];
	$caring_primary_older_person = $form_data['caring_primary_older_person'];
	$caring_secondary = $form_data['caring_secondary'];
	$prefers_previous_counsellor = $form_data['prefers_previous_counsellor'];
	$previous_counsellor_name = $form_data['previous_counsellor_name'];
	$counsellor_gender_id = $form_data['counsellor_gender_id'];
	$counselling_time_id = $form_data['counselling_time_id'];
	$counselling_time_other = $form_data['counselling_time_other'];
	$link_worker_sighthill = $form_data['link_worker_sighthill'];
	$link_worker_whinpark = $form_data['link_worker_whinpark'];
	$link_worker_springwell = $form_data['link_worker_springwell'];
	$link_worker_murrayfield = $form_data['link_worker_murrayfield'];

	$user_id = $_SESSION['user.id'];

	// Check data is valid
	if (!validate_string_isnumber($user_id)) {$data_error = 1;}
	if (!validate_string_length($first_name,0,128)) {$data_error = 2;}
	if (!validate_string_length($last_name,0,128)) {$data_error = 3;}
	if (!validate_string_length($preferred_name,0,128)) {$data_error = 4;}
	if (!validate_string_isdate($date_of_birth)) {$data_error = 100;}
	if (!validate_string_length($address_1,0,255)) {$data_error = 5;}
	if (!validate_string_length($address_2,0,255)) {$data_error = 6;}
	if (!validate_string_length($town_city,0,255)) {$data_error = 7;}
	if (!validate_string_length($postcode,0,8)) {$data_error = 8;}
	if (!validate_string_length($telephone,0,50)) {$data_error = 9;}
	if (!validate_string_length($mobile,0,50)) {$data_error = 10;}
	if (!validate_string_length($email,0,128)) {$data_error = 11;}
	if (!validate_string_isnumber($consent_data)) {$data_error = 13;}
	if (!validate_string_isnumber($consent_mail)) {$data_error = 14;}
	if (!validate_string_isnumber($consent_phone)) {$data_error = 15;}
	if (!validate_string_isnumber($consent_email)) {$data_error = 16;}
	if (!validate_string_isnumber($consent_phone_identification)) {$data_error = 17;}
	if (!validate_string_isnumber($consent_email_list)) {$data_error = 18;}
	if (!validate_string_isnumber($consent_marketing_photography)) {$data_error = 19;}
	if (!validate_string_length($preferred_contact_method,0,128)) {$data_error = 20;}
	if (!validate_string_length($emergency_contact_name,0,128)) {$data_error = 21;}
	if (!validate_string_length($emergency_contact_phone,0,50)) {$data_error = 22;}
	if (!validate_string_length($gp_name,0,128)) {$data_error = 23;}
	if (!validate_string_length($gp_surgery,0,128)) {$data_error = 24;}
	if (!validate_string_isnumber($has_existing_health_professional)) {$data_error = 25;}
	if (!validate_string_length($how_did_you_hear,0,128)) {$data_error = 26;}
	if (!validate_string_length($services_desired,0,128)) {$data_error = 27;}
	if (!validate_string_isnumber($age_group_id)) {$data_error = 28;}
	if (!validate_string_isnumber($gender_id)) {$data_error = 29;}
	if (!validate_string_isnumber($sexual_orientation_id)) {$data_error = 30;}
	if (!validate_string_isnumber($employment_status_id)) {$data_error = 31;}
	if (!validate_string_isnumber($disability_status_id)) {$data_error = 32;}
	if (!validate_string_isnumber($ethnic_group_id)) {$data_error = 33;}
	if (!validate_string_length($ethnic_group_other,0,128)) {$data_error = 34;}
	if (!validate_string_isnumber($religion_id)) {$data_error = 35;}
	if (!validate_string_isnumber($receiving_benefits)) {$data_error = 36;}
	if (!validate_string_isnumber($caring_none)) {$data_error = 37;}
	if (!validate_string_isnumber($caring_primary_under_18)) {$data_error = 38;}
	if (!validate_string_isnumber($caring_primary_disabled_children)) {$data_error = 39;}
	if (!validate_string_isnumber($caring_primary_disabled_over_18)) {$data_error = 40;}
	if (!validate_string_isnumber($caring_primary_older_person)) {$data_error = 41;}
	if (!validate_string_isnumber($caring_secondary)) {$data_error = 42;}
	if (!validate_string_isnumber($prefers_previous_counsellor)) {$data_error = 43;}
	if (!validate_string_length($previous_counsellor_name,0,128)) {$data_error = 44;}
	if (!validate_string_isnumber($counsellor_gender_id)) {$data_error = 45;}
	if (!validate_string_isnumber($counselling_time_id)) {$data_error = 46;}
	if (!validate_string_length($counselling_time_other,0,128)) {$data_error = 47;}
	if (!validate_string_isnumber($link_worker_sighthill)) {$data_error = 48;}
	if (!validate_string_isnumber($link_worker_whinpark)) {$data_error = 49;}
	if (!validate_string_isnumber($link_worker_springwell)) {$data_error = 50;}
	if (!validate_string_isnumber($link_worker_murrayfield)) {$data_error = 51;}
	if (!validate_string_isnumber($transgender_id)) {$data_error = 52;}

	if($data_error==0) {
    
		$fields = array(
			"created_by_user_id" => $user_id,
			"first_name" => $first_name,
			"last_name" => $last_name,
			"preferred_name" => $preferred_name,
			"date_of_birth" => date("Y-m-d", strtotime(str_replace('/','-',$date_of_birth))),			
			"address_1" => $address_1,
			"address_2" => $address_2,
			"town_city" => $town_city,
			"postcode" => $postcode,
			"telephone" => $telephone,
			"mobile" => $mobile,
			"email" => $email,
			"consent_data" => $consent_data,
			"consent_mail" => $consent_mail,
			"consent_phone" => $consent_phone,
			"consent_email" => $consent_email,
			"consent_phone_identification" => $consent_phone_identification,
			"consent_email_list" => $consent_email_list,
			"consent_marketing_photography" => $consent_marketing_photography,
			"preferred_contact_method" => $preferred_contact_method,
			"emergency_contact_name" => $emergency_contact_name,
			"emergency_contact_phone" => $emergency_contact_phone,
			"gp_name" => $gp_name,
			"gp_surgery" => $gp_surgery,
			"has_existing_health_professional" => $has_existing_health_professional,
			"existing_health_professional_details" => $existing_health_professional_details,
			"how_did_you_hear" => $how_did_you_hear,
			"services_desired" => $services_desired,
			"medical_details" => $medical_details,
			"age_group_id" => $age_group_id,
			"transgender_id" => $transgender_id,
			"gender_id" => $gender_id,
			"sexual_orientation_id" => $sexual_orientation_id,
			"employment_status_id" => $employment_status_id,
			"disability_status_id" => $disability_status_id,
			"ethnic_group_id" => $ethnic_group_id,
			"ethnic_group_other" => $ethnic_group_other,
			"religion_id" => $religion_id,
			"receiving_benefits" => $receiving_benefits,
			"caring_none" => $caring_none,			
			"caring_primary_under_18" => $caring_primary_under_18,
			"caring_primary_disabled_children" => $caring_primary_disabled_children,
			"caring_primary_disabled_over_18" => $caring_primary_disabled_over_18,
			"caring_primary_older_person" => $caring_primary_older_person,
			"caring_secondary" => $caring_secondary,			
			"prefers_previous_counsellor" => $prefers_previous_counsellor,
			"previous_counsellor_name" => $previous_counsellor_name,
			"counsellor_gender_id" => $counsellor_gender_id,
			"counselling_time_id" => $counselling_time_id,
			"counselling_time_other" => $counselling_time_other,
			"link_worker_sighthill" => $link_worker_sighthill,
			"link_worker_whinpark" => $link_worker_whinpark,
			"link_worker_springwell" => $link_worker_springwell,
			"link_worker_murrayfield" => $link_worker_murrayfield			
		);

		function generate_insert_sql($table, $fields){
			$sql = "INSERT INTO `$table` (";

			foreach ($fields as $field => $value){
				$sql .= "`$field`, ";
			}

			//trim trailing comma
			$sql = rtrim($sql, ", ");
			$sql .= ") VALUES (";

			foreach ($fields as $field => $value){
				$sql .= "'$value', ";
			}

			//trim trailing comma
			$sql = rtrim($sql, ", ");      

			$sql .= ");";
			return $sql;
		}

		$sql = generate_insert_sql("clients", $fields);

		// Send SQL to database
		if ($conn->query($sql) === TRUE) {
			// Record insert was successful, return primary key of new record.
			echo "OK: Client recorded successfully.";
		} else {
			// Failed to insert database record, return reason.
			echo "ERROR:" . $conn->error;
		}	

	} else {
		// Validation of POST data failed, return reason.
		echo "ERROR:$data_error";
	}
?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>