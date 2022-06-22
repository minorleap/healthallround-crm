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

	$activity_id = $form_data['activity_id'];
	$meeting_date = $form_data['meeting_date'];
	$meeting_time = $form_data['meeting_time'];

	// Check required data is valid
	if (!validate_string_isnumber($activity_id)) {$data_error = 1;}
	if (!validate_string_isdate($meeting_date)) {$data_error = 2;}
	if (!validate_string_istime($meeting_time)) {$data_error = 3;}

	if($data_error==0) {
    
	// required fields
    $fields = array(
	  "activity_id" => $activity_id,
	  "meeting_date" => date("Y-m-d", strtotime(str_replace('/','-',$meeting_date))),
	  "meeting_time" => $meeting_time
    );		
      
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
    
    $sql = generate_insert_sql("activity_meetings", $fields);
    
		
		// Send SQL to database
		if ($conn->query($sql) === TRUE) {
			// Record insert was successful, return primary key of new record.
			echo "OK: Meeting recorded successfully.";
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