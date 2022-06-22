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
	$id = $form_data['id'];
	$password = $form_data['password'];

	// Check data is valid
	if (!validate_string_isnumber($id)) {$data_error = 1;}
	if (!validate_string_length($password,8,100)) {$data_error = 2;}

	if($data_error==0) {
		
		$password = md5($password);
		$sql = "UPDATE `users` SET `password`='$password' WHERE `id`=$id;";

		// Send SQL to database
		if ($conn->query($sql) === TRUE) {
			// Record insert was successful, return primary key of new record.
			echo "OK: id[$id] updated successfully";
		} else {
			// Failed to insert database record, return reason.
			echo "ERROR:" . $conn->error;
		}	
				

	} else {
		// Validation of POST data failed, return reason.
		echo "ERROR:".$data_error;
	}

?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
