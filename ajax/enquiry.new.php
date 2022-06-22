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
	$enquiry_date = $form_data['enquiry_date'];
	$service_id = $form_data['service_id'];
	$enquiry_type_id = $form_data['enquiry_type_id'];
	$enquiry_method_id = $form_data['enquiry_method_id'];
	$details = $form_data['details'];
	$took_enquiry_staff_id = $form_data['took_enquiry_staff_id'];
	$passed_to_staff_id = $form_data['passed_to_staff_id'];
	$time_spent_id = $form_data['time_spent_id'];
	$requires_feedback = $form_data['requires_feedback'];
	$feedback_date = $form_data['feedback_date'];
	$user_id = $_SESSION['user.id'];


	// Check required data is valid
	if (!validate_string_isnumber($user_id)) {$data_error = 1;}
	if (!validate_string_isnumber($client_id)) {$data_error = 2;}
	if (!validate_string_isdate($enquiry_date)) {$data_error = 3;}
	if (!validate_string_isnumber($service_id)) {$data_error = 4;}
	if (!validate_string_isnumber($enquiry_type_id)) {$data_error = 5;}
	if (!validate_string_isnumber($enquiry_method_id)) {$data_error = 6;}
	if (!validate_string_length($details,0,128)) {$data_error = 7;}
	if (!validate_string_isnumber($took_enquiry_staff_id)) {$data_error = 8;}
	if (!validate_string_isnumber($passed_to_staff_id)) {$data_error = 9;}
	if (!validate_string_isnumber($time_spent_id)) {$data_error = 10;}
	if (!validate_string_isnumber($requires_feedback)) {$data_error = 11;}

	// Check optional data is valid
	if ($feedback_date && !validate_string_isdate($feedback_date)) {$data_error = 12;}

	if($data_error==0) {
    
	// required fields
    $fields = array(
      "client_id" => $client_id,
      "enquiry_date" => date("Y-m-d", strtotime(str_replace('/','-',$enquiry_date))),
      "service_id" => $service_id,
      "enquiry_type_id" => $enquiry_type_id,
      "enquiry_method_id" => $enquiry_method_id,
      "details" => $details,
      "took_enquiry_staff_id" => $took_enquiry_staff_id,
      "passed_to_staff_id" => $passed_to_staff_id,
      "time_spent_id" => $time_spent_id,
      "requires_feedback" => $requires_feedback,
    );
		
	// optional fields
	if ($feedback_date) {
		$fields['feedback_date'] = date("Y-m-d", strtotime(str_replace('/','-',$feedback_date)));
	}
      
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
    
    $sql = generate_insert_sql("enquiries", $fields);
    
    
		
		// Send SQL to database
		if ($conn->query($sql) === TRUE) {
			// Record insert was successful, return primary key of new record.
			echo "OK: Enquiry recorded successfully.";
		} else {
			// Failed to insert database record, return reason.
			echo "ERROR:" . $conn->error;
		}	

	} else {
		// Validation of POST data failed, return reason.
		echo "ERROR: $data_error";
	}
?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>