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

	$booking_id = $form_data['booking_id'];
	$client_id = $form_data['client_id'];
	$activity_id = $form_data['activity_id'];

	// Check data is valid
	if (!validate_string_isnumber($booking_id)) {$data_error = 1;}
	if (!validate_string_isnumber($client_id)) {$data_error = 2;}
	if (!validate_string_isnumber($activity_id)) {$data_error = 3;}

	if($data_error==0) {
		
		// Delete client's attendance records for all meetings related to this activity
		$sql = "DELETE `activity_attendance`
				FROM `activity_attendance`
				INNER JOIN `activity_meetings` ON `activity_meetings`.`id` = `activity_attendance`.`activity_meeting_id`
				INNER JOIN `activities` ON `activities`.`id`=`activity_meetings`.`activity_id`
				WHERE `client_id` = $client_id
				AND `activity_id` = $activity_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Attendance deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}
		
		// Delete booking record
		$sql = "DELETE FROM activity_bookings WHERE id=$booking_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Booking deleted successfully.";
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
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>t