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

	// Check data is valid
	if (!validate_string_isnumber($activity_id)) {$data_error = 1;}

	if($data_error==0) {
		
		// Delete all attendance for the activity
		$sql = "DELETE `activity_attendance`
				FROM `activity_attendance`
				INNER JOIN `activity_meetings` ON `activity_meetings`.`id` = `activity_attendance`.`activity_meeting_id`
				INNER JOIN `activities` ON `activities`.`id`=`activity_meetings`.`activity_id`
				WHERE `activity_id` = $activity_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Attendance deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}		
		
		// Delete all meetings for the activity
		$sql = "DELETE FROM `activity_meetings`
				WHERE `activity_id` = $activity_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Meetings deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}			
		
		// Delete all bookings for the activity
		$sql = "DELETE FROM `activity_bookings`
				WHERE `activity_id` = $activity_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Bookings deleted successfully.";
		} else {
			// Failed to delete database records, return reason.
			echo "ERROR:" . $conn->error;
			return;
		}	
		
		// Delete the activity
		$sql = "DELETE FROM activities WHERE id=$activity_id;";
		if ($conn->query($sql) === TRUE) {
			// Record delete was successful
			echo "OK: Activity deleted successfully.";
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