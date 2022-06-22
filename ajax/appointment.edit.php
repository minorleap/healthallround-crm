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
	$appointment_id = $form_data['appointment_id'];
	$client_id = $form_data['client_id'];
	$date = $form_data['date'];
	$time = $form_data['time'];
	$counsellor_user_id = $form_data['counsellor_user_id'];
	$appointment_type_id = $form_data['appointment_type_id'];
	$appointment_status_id = $form_data['appointment_status_id'];
	$notes = $form_data['notes'];
	$fee = $form_data['fee'];
	$payment_status_id = $form_data['payment_status_id'];

	// Check required data is valid
	if (!validate_string_isnumber($client_id)) {$data_error = 1;}
	if (!validate_string_isdate($date)) {$data_error = 2;}
	if (!validate_string_istime($time)) {$data_error = 3;}
	if (!validate_string_isnumber($counsellor_user_id)) {$data_error = 4;}
	if (!validate_string_isnumber($appointment_type_id)) {$data_error = 5;}
	if (!validate_string_isnumber($appointment_status_id)) {$data_error = 6;}
	if (!validate_string_isnumeric($fee)) {$data_error = 7;}

	// Check optional data is valid
	if ($feedback_date && !validate_string_isnumber($payment_status_id)) {$data_error = 8;}

	if($data_error==0) {
    
	// required fields
    $fields = array(
      "client_id" => $client_id,
      "counsellor_user_id" => $counsellor_user_id,
      "date" => date("Y-m-d", strtotime(str_replace('/','-',$date))),
      "time" => $time,
      "appointment_type_id" => $appointment_type_id,
      "appointment_status_id" => $appointment_status_id,
	  "fee" => $fee,
      "notes" => $notes
    );
		
	// optional fields
	if ($payment_status) {
		$fields['payment_status_id'] = $payment_status_id;
	}
    
    function generate_update_sql($table, $fields, $appointment_id)
    {
      $sql = "UPDATE `$table` SET ";
      
      foreach ($fields as $field => $value)
      {
        $sql .= "`$field` = '$value', ";
      }
      
      //trim trailing comma
      $sql = rtrim($sql, ", ");
      
      $sql .= "WHERE id=$appointment_id;";
      return $sql;
    }
    
    $sql = generate_update_sql("appointments", $fields, $appointment_id);


		// Send SQL to database
		if ($conn->query($sql) === TRUE) {
			// Record insert was successful, return primary key of new record.
			echo "OK: Appointment updated successfully.";
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
