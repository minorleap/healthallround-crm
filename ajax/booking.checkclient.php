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

	$activity_id = $form_data['activity_id'];
	$client_id = $form_data['client_id'];

	// Check required data is valid
	if (!validate_string_isnumber($activity_id)) {$data_error = 1;}
	if (!validate_string_isnumber($client_id)) {$data_error = 2;}

	if($data_error==0) {
    
    	$sql = "SELECT `client_id`, `activity_id` FROM `activity_bookings` WHERE `activity_bookings`.`client_id`=$client_id AND `activity_bookings`.`activity_id`=$activity_id;";
		
		$result = $conn->query($sql);
		if ($result->num_rows == 0){
			echo "OK: Booking does not yet exist";
		} else {
    		echo "ERROR: Booking already exists";
		}

	} else {
		// Validation of POST data failed, return reason.
		echo "ERROR: $data_error";
	}
?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>