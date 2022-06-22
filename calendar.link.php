<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php 

	// Sanitise data
	$form_data = $_GET;
	foreach ($form_data as $key => $value) {
		$value = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		$value = $conn->real_escape_string($value);
		$form_data[$key] = $value;
	}

	$data_error = 0;

	$activity_id = $form_data['id'];

	// Check required data is valid
	if (!validate_string_isnumber($activity_id)) {$data_error = 1;}

	if($data_error==0) {
				
		$redirect_url = "https://" . $_SERVER["SERVER_NAME"] . "/activity.php?activity_id=$activity_id";
		$page= file_get_contents($redirect_url);
		echo $page;		
	}

?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>