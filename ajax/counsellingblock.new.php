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
	$counsellor_user_id = $form_data['counsellor_user_id'];
	$start_date = $form_data['start_date'];
	$end_date = $form_data['end_date'];
	$evaluation_date = $form_data['evaluation_date'];
	$history_general = $form_data['history_general'];
	$history_selfharm = $form_data['history_selfharm'];


	// Check required data is valid
	if (!validate_string_isnumber($client_id)) {$data_error = 1;}
	if (!validate_string_isdate($start_date)) {$data_error = 2;}
	if (!validate_string_isdate($end_date)) {$data_error = 3;}
	if (!validate_string_isnumber($counsellor_user_id)) {$data_error = 4;}

	// Check optional data is valid
	if ($evaluation_date && !validate_string_isdate($evaluation_date)) {$data_error = 5;}

	if($data_error==0) {
    
	// required fields
    $fields = array(
      "client_id" => $client_id,
      "start_date" => date("Y-m-d", strtotime(str_replace('/','-',$start_date))),
      "end_date" => date("Y-m-d", strtotime(str_replace('/','-',$end_date))),
      "counsellor_user_id" => $counsellor_user_id,
      "history_general" => $history_general,
	  "history_selfharm" => $history_selfharm
    );
		
	// optional fields
	if ($evaluation_date) {
		$fields['evaluation_date'] = date("Y-m-d", strtotime(str_replace('/','-',$evaluation_date)));
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
    
	
    $sql = generate_insert_sql("counselling_blocks", $fields);
    
    
		
		// Send SQL to database
		if ($conn->query($sql) === TRUE) {
			// Record insert was successful, return primary key of new record.
			echo "OK: Appointment recorded successfully.";
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