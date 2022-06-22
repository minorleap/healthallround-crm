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

	$core10_id = $form_data['core10_id'];
	$client_id = $form_data['client_id'];
	$assessment_date = $form_data['assessment_date'];
	$q1 = $form_data['q1'];
	$q2 = $form_data['q2'];
	$q3 = $form_data['q3'];
	$q4 = $form_data['q4'];
	$q5 = $form_data['q5'];
	$q6 = $form_data['q6'];
	$q7 = $form_data['q7'];
	$q8 = $form_data['q8'];
	$q9 = $form_data['q9'];
	$q10 = $form_data['q10'];


	// Check required data is valid
	if (!validate_string_isnumber($core10_id)) {$data_error = 1;}
	if (!validate_string_isnumber($client_id)) {$data_error = 2;}
	if (!validate_string_isdate($assessment_date)) {$data_error = 3;}

	// Check optional data is valid
	if ($q1 && !validate_string_isnumber($q1)) {$data_error = 4;}
	if ($q2 && !validate_string_isnumber($q2)) {$data_error = 5;}
	if ($q3 && !validate_string_isnumber($q3)) {$data_error = 6;}
	if ($q4 && !validate_string_isnumber($q4)) {$data_error = 7;}
	if ($q5 && !validate_string_isnumber($q5)) {$data_error = 8;}
	if ($q6 && !validate_string_isnumber($q6)) {$data_error = 9;}
	if ($q7 && !validate_string_isnumber($q7)) {$data_error = 10;}
	if ($q8 && !validate_string_isnumber($q8)) {$data_error = 11;}
	if ($q9 && !validate_string_isnumber($q9)) {$data_error = 12;}
	if ($q10 && !validate_string_isnumber($q10)) {$data_error = 13;}

	if($data_error==0) {
    
	// required fields
    $fields = array(
      "client_id" => $client_id,
      "assessment_date" => date("Y-m-d", strtotime(str_replace('/','-',$assessment_date))),
      "q1" => $q1,
      "q2" => $q2,
      "q3" => $q3,
      "q4" => $q4,
      "q5" => $q5,
      "q6" => $q6,
      "q7" => $q7,
      "q8" => $q8,
      "q9" => $q9,
      "q10" => $q10
    );

    
    function generate_update_sql($table, $fields, $core10_id)
    {
      $sql = "UPDATE `$table` SET ";
      
      foreach ($fields as $field => $value)
      {		  
	    if ($value === '') {
			$sql .= "`$field` = NULL, ";
		}
	    else {
			$sql .= "`$field` = '$value', ";
		}
      }
      
      //trim trailing comma
      $sql = rtrim($sql, ", ");
      
      $sql .= " WHERE id=$core10_id;";
      return $sql;
    }
    
    $sql = generate_update_sql("core10", $fields, $core10_id);


		// Send SQL to database
		if ($conn->query($sql) === TRUE) {
			// Record insert was successful, return primary key of new record.
			echo "OK: Enquiry updated successfully.";
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
