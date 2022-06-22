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

	$client_id = $form_data['client_id'];

	// Check data is valid
	if (!validate_string_isnumber($client_id)) {$data_error = 1;}

	if($data_error==0) {
		
		// Delete client's activity bookings
		$sql = "DELETE FROM activity_bookings WHERE activity_bookings.client_id=$client_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Bookings deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}
		
		
		// Delete client's activity attendance
		$sql = "DELETE FROM activity_attendance WHERE activity_attendance.client_id=$client_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Attendance deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}
		
		
		// Delete client's appointments
		$sql = "DELETE FROM appointments WHERE appointments.client_id=$client_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Appointments deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}
		
		
		// Delete client's counselling blocks
		$sql = "DELETE FROM counselling_blocks WHERE counselling_blocks.client_id=$client_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Counselling blocks deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}
		
		
		// Delte client's measurements (Core10, DASS21, GAD07, PHQ09)
		$sql = "DELETE FROM core10 WHERE core10.client_id=$client_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Core10 measurements deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}
		
		$sql = "DELETE FROM dass21 WHERE dass21.client_id=$client_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: DASS21 measurements deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}
		
		$sql = "DELETE FROM gad07 WHERE gad07.client_id=$client_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: GAD07 measurements deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}
		
		$sql = "DELETE FROM phq09 WHERE phq09.client_id=$client_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: PHQ09 measurements deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}
		

		// Delete client's enquiries
		$sql = "DELETE FROM enquiries WHERE enquiries.client_id=$client_id;";
		// Send SQL to database
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Enquiries deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}
		
		// Delete client record
		$sql = "DELETE FROM clients WHERE id=$client_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Client deleted successfully.";
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