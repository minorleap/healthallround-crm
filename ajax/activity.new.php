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

	$name = $form_data['name'];
	$location = $form_data['location'];
	$start_date = $form_data['start_date'];
	$end_date = $form_data['end_date'];
	$weekday = $form_data['weekday'];
	$start_time = $form_data['start_time'];
	$duration_hours = $form_data['duration_hours'];
	$organiser = $form_data['organiser'];
	$contact_details = $form_data['contact_details'];
	$capacity = $form_data['capacity'];
	$frequency_id = $form_data['frequency_id'];
	$has_anonymous_attendees = $form_data['has_anonymous_attendees'];
	$is_archived = $form_data['is_archived'];


	// Check required data is valid
	if (!validate_string_length($name,0,128)) {$data_error = 1;}
	if (!validate_string_length($location,0,128)) {$data_error = 2;}
	if (!validate_string_isdate($start_date)) {$data_error = 3;}
	if (!validate_string_length($weekday,0,128)) {$data_error = 4;}
	if (!validate_string_length($start_time,0,128)) {$data_error = 5;}
	if (!validate_string_isnumeric($duration_hours)) {$data_error = 6;}
	if (!validate_string_isnumber($capacity)) {$data_error = 7;}
	if (!validate_string_isnumber($frequency_id)) {$data_error = 8;}
	if (!validate_string_isnumber($has_anonymous_attendees)) {$data_error = 9;}
	if (!validate_string_isnumber($is_archived)) {$data_error = 10;}

	// Check optional data is valid
	if ($end_date && !validate_string_isdate($end_date)) {$data_error = 20;}
	if ($organiser && !validate_string_length($organiser,0,128)) {$data_error = 21;}
	if ($contact_details && !validate_string_length($contact_details,0,128)) {$data_error = 22;}

	if($data_error==0) {
    
	// required fields
    $fields = array(
      "name" => $name,
      "location" => $location,
      "start_date" => date("Y-m-d", strtotime(str_replace('/','-',$start_date))),
      "weekday" => $weekday,
      "start_time" => $start_time,
      "duration_hours" => $duration_hours,
      "capacity" => $capacity,
      "frequency_id" => $frequency_id,
      "has_anonymous_attendees" => $has_anonymous_attendees,
      "is_archived" => $is_archived,
    );		

		
	// optional fields
	if ($end_date) {
		$fields['end_date'] = date("Y-m-d", strtotime(str_replace('/','-',$end_date)));
	}
	if ($organiser) {
		$fields['organiser'] = $organiser;
	}
	if ($contact_details) {
		$fields['contact_details'] = $contact_details;
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
    
    $sql = generate_insert_sql("activities", $fields);
    
		
		// Send SQL to database
		if ($conn->query($sql) === TRUE) {
			// Record insert was successful, return primary key of new record.
			echo "OK: Activity recorded successfully.";
		} else {
			// Failed to insert database record, return reason.
			echo "ERROR:" . $sql . $conn->error;
		}	

	} else {
		// Validation of POST data failed, return reason.
		echo "ERROR: $data_error";
	}
?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>