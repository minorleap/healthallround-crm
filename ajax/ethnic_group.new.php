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

	$description = $form_data['description'];
	$is_enabled = $form_data['is_enabled'];

	// Check required data is valid
    if (!validate_string_length($description,0,128)) {$data_error = 1;}
	if (!validate_string_isnumber($is_enabled)) {$data_error = 2;}

	if($data_error==0) {
    
	// required fields
    $fields = array(
	  "description" => $description,
	  "is_enabled" => $is_enabled
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
    
    $sql = generate_insert_sql("ethnic_group", $fields);
    
		
		// Send SQL to database
		if ($conn->query($sql) === TRUE) {
			// Record insert was successful, return primary key of new record.
			echo "OK: Ethnic group recorded successfully.";
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