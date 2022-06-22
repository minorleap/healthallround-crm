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

	// Check data is valid
	if (!validate_string_isnumber($meeting_id)) {$data_error = 1;}

	if($data_error==0) {
		
		// Delete meeting's attendance records
		$sql = "DELETE FROM activity_attendance WHERE activity_attendance.activity_meeting_id=$meeting_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Attendance deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}
		
		// Delete meeting record
		$sql = "DELETE FROM activity_meetings WHERE id=$meeting_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Meeting deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}

	} else {
		// Validation of POST data failed, return reason.
		echo "ERROR:$data_error";
	}
?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>