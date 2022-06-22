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

	if (isset($form_data['client_id'])) {
		$_SESSION["client_id"] = $form_data['client_id'];
		echo $_SESSION["client_id"];
	}
?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>