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
	$command = $form_data['command'];
	$id = $form_data['id'];
	$username = $form_data['username'];
	$password = $form_data['password'];
	$first_name = $form_data['first_name'];
	$last_name = $form_data['last_name'];	
	$is_enabled = $form_data['is_enabled'];
	$is_counsellor = $form_data['is_counsellor'];
	$is_admin = $form_data['is_admin'];	
	$is_super_admin = $form_data['is_super_admin'];

	// Check data is valid
	if (!validate_string_length(command,1,30)) {$data_error = 1;}
	if (!validate_string_isnumber($id)) {$data_error = 2;}
	if (!validate_string_isemail($username)) {$data_error = 3;}
	if (!validate_string_length($username,1,150)) {$data_error = 4;}
	if (!validate_string_length($password,1,150)) {$data_error = 4;}
	if (!validate_string_length($first_name,1,150)) {$data_error = 5;}
	if (!validate_string_length($last_name,1,150)) {$data_error = 6;}
	if (!validate_string_isnumber($is_enabled)) {$data_error = 7;}
	if (!validate_string_isnumber($is_enabled)) {$data_error = 8;}
	if (!validate_string_isnumber($is_admin)) {$data_error = 9;}
	if (!validate_string_isnumber($is_super_admin)) {$data_error = 10;}

	if ($_SESSION["user.is_admin"]==0){$data_error = 11;}


	$password=md5($password);

	if($data_error==0) {
		
		switch($command) {
			case "update_user":
				
				$sql = "UPDATE `users` SET `username`='$username', `first_name`='$first_name', `last_name`='$last_name', ";
				$sql .= "`is_enabled`=$is_enabled, `is_counsellor`=$is_counsellor, `is_admin`=$is_admin, `is_super_admin`=$is_super_admin ";
				$sql .= "WHERE `id`=$id;";

				// Send SQL to database
				if ($conn->query($sql) === TRUE) {
					// Record insert was successful, return primary key of new record.
					echo "OK: id[$id] updated successfully";
				} else {
					// Failed to insert database record, return reason.
					echo "ERROR:" . $conn->error;
				}	
				break;
				
			case "add_user":
				
				$sql = "INSERT INTO `users` (`username`, `password`, `first_name`, `last_name`, `is_enabled`, `is_counsellor`, `is_admin`, `is_super_admin`) ";
				$sql .= "VALUES ('$username', '$password', '$first_name', '$last_name', $is_enabled, $is_counsellor, $is_admin, $is_super_admin); ";

				// Send SQL to database
				if ($conn->query($sql) === TRUE) {
					// Record insert was successful, return primary key of new record.
					echo "OK: id[$id] added successfully";
				} else {
					// Failed to insert database record, return reason.
					echo "ERROR:" . $conn->error;
				}	
				
				
				
				break;
		}

		} else {
			// Validation of POST data failed, return reason.
			echo "ERROR:".$data_error;
		}

?>




<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
