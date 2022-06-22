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
	$date = $form_data['date'];
	$time = $form_data['time'];
	$counsellor_user_id = $form_data['counsellor_user_id'];
	$appointment_type_id = $form_data['appointment_type_id'];
	$appointment_status_id = $form_data['appointment_status_id'];
	$notes = $form_data['notes'];
	$fee = $form_data['fee'];
	$payment_status_id = $form_data['payment_status_id'];
	$number_of_appointments = $form_data['number_of_appointments'];

//	$client_id = '1';
//	$first_date = '01/03/2021';
//	$time = '10:00';
//	$counsellor_user_id = '1';
//	$appointment_type_id = '1';
//	$appointment_status_id = '1';
//	$notes = 'some notes';
//	$fee = '25.00';
//	$payment_status_id = '1';
//	$number_of_appointments = '5';


	// Check required data is valid
	if (!validate_string_isnumber($client_id)) {$data_error = 1;}
	if (!validate_string_isdate($date)) {$data_error = 2;}
	if (!validate_string_istime($time)) {$data_error = 3;}
	if (!validate_string_isnumber($counsellor_user_id)) {$data_error = 4;}
	if (!validate_string_isnumber($appointment_type_id)) {$data_error = 5;}
	if (!validate_string_isnumber($appointment_status_id)) {$data_error = 6;}
	if (!validate_string_isnumeric($fee)) {$data_error = 7;}
	if (!validate_string_isnumber($number_of_appointments)) {$data_error = 8;}
    if (!validate_string_isnumber($payment_status_id)) {$data_error = 9;}

	function generate_insert_sql($table, $fields)
	{
	  $sql = "INSERT INTO `$table` (";

	  foreach ($fields as $field => $value)
	  {
		$sql .= "`$field`, ";
	  }

	  //trim trailing comma
	  $sql = rtrim($sql, ", ");

	  $sql .= ") VALUES (";

	  foreach ($fields as $field => $value)
	  {
		$sql .= "'$value', ";
	  }

	  //trim trailing comma
	  $sql = rtrim($sql, ", ");      

	  $sql .= ");";
	  return $sql;
	}

	if($data_error==0) {
		
		$appointment_dates = array(date("Y-m-d", strtotime(str_replace('/','-',$date))));
		for ($i=1; $i<$number_of_appointments; $i++) {
			$previous_date = $appointment_dates[$i-1];
			$next_date = date('Y-m-d', strtotime('+7 days', strtotime($previous_date)));
			array_push($appointment_dates, $next_date);
		}
		

		foreach($appointment_dates as $appointment => $date) {
			// required fields
			$fields = array(
			  "client_id" => $client_id,
			  "counsellor_user_id" => $counsellor_user_id,
			  "date" => $date,
			  "time" => $time,
			  "appointment_type_id" => $appointment_type_id,
			  "appointment_status_id" => $appointment_status_id,
			  "payment_status_id" => $payment_status_id,
			  "fee" => $fee
			);

			$sql = generate_insert_sql("appointments", $fields);

			// Send SQL to database
			if ($conn->query($sql) !== TRUE) {
				// Failed to insert database record, return reason.
				echo "ERROR:" . $conn->error;
				break;
			}
		}
		echo "OK: Booking recorded successfully.";
		
		

	} else {
		// Validation of POST data failed, return reason.
		echo "ERROR: $data_error";
	}		
?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>