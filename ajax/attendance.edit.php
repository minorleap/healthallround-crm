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

	$meeting_id = $form_data['meeting_id'];
	$client_id = $form_data['client_id'];
	$add = $form_data['add'];

	// Check required data is valid
	if (!validate_string_isnumber($meeting_id)) {$data_error = 1;}
	if (!validate_string_isnumber($client_id)) {$data_error = 2;}
	if (!validate_string_isnumber($add)) {$data_error = 3;}

	if($data_error==0) {
    
	// required fields
    $fields = array(
	  "meeting_id" => $meeting_id,
	  "client_id" => $client_id,
	  "add" => $add
    );
	
	if($add) {
		$sql = "INSERT INTO activity_attendance (`activity_meeting_id`, `client_id`) VALUES ($meeting_id, $client_id);";
	} else {
		$sql = "DELETE FROM activity_attendance WHERE `activity_meeting_id`=$meeting_id AND `client_id`=$client_id;";
	}
    
 	// Send SQL to database
	if ($conn->query($sql) === TRUE) {
		// Record insert was successful, return primary key of new record.
		echo "OK: Attendance updated successfully.";
	} else {
		// Failed to insert database record, return reason.
		echo "ERROR:[$sql] " . $conn->error;
	}	


	} else {
		// Validation of POST data failed, return reason.
		echo "ERROR:".$data_error;
	}

?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
