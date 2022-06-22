<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php

	$data_error = 0;
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Clean POST values to prevent SQL injection
	$username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$password = filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$username = $conn->real_escape_string($username);
	$password = $conn->real_escape_string($password);

	// Validate posted data
	if (!validate_string_isemail($username)) {$data_error = 1;}
	if (!validate_string_length($password,6,256)) {$data_error = 1;}
	
	if ($data_error == 0) {
		// Correctly formatted credentials, check username and password are valid and account is not disabled
		$sql = "SELECT * FROM users WHERE username='$username' AND is_enabled = 1;";
		$result = $conn->query($sql);
		if ($result->num_rows == 1){
			while($row = $result->fetch_assoc()){
				$userPasswordHash = $row["password"];
				$logonPasswordHash = md5($password);
				if ($logonPasswordHash == $userPasswordHash) {
					session_regenerate_id();
					$_SESSION['user.id'] = $row['id'];
					$_SESSION['user.username'] = $row['username'];
					$_SESSION['user.first_name'] = $row['first_name'];
					$_SESSION['user.last_name'] = $row['last_name'];
					$_SESSION['user.is_admin'] = $row['is_admin'];
					$_SESSION['user.is_super_admin'] = $row['is_super_admin'];
					$_SESSION['user.is_counsellor'] = $row['is_counsellor'];
					session_write_close();
				} else {
					$data_error = 1;
				}		
			}
		} else {
			$data_error = 1;
		}
	}
	
	if ($data_error == 0) {
		echo "OK";
	} else {
		echo "ERROR";
	}

?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>