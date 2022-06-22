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

$ethnicity = $form_data['ethnicity'];
$gender = $form_data['gender'];
$residency_status = $form_data['residency_status'];

if(!preg_match('/[^\d,]/', $ethnicity)) {$data_error = 1;}
if(!preg_match('/[^\d,]/', $gender)) {$data_error = 2;}
if(!preg_match('/[^\d,]/', $residency_id)) {$data_error = 3;}

$ethnicity_clause = "";
$gender_clause = "";
$residency_status_clause = "";

if (strlen($ethnicity) > 0) {
	$ethnicity_clause = "`ethnic_group_id` IN ($ethnicity)";
}

if (strlen($gender) > 0) {
	$gender_clause = "`gender_id` IN ($gender)";
}

if (strlen($residency_status) > 0) {
	$residency_status_clause = "`residency_status_id` IN ($residency_status)";
}

$where_clause = "";
if ($ethnicity_clause) {
	$where_clause .= $ethnicity_clause;
}
if ($gender_clause) {
	if ($where_clause) {
		$where_clause .= " AND ";
	}
	$where_clause .= $gender_clause;
}
if ($residency_status_clause) {
	if ($where_clause) {
		$where_clause .= " AND ";
	}
	$where_clause .= $residency_status_clause;
}

$sql = "SELECT * FROM view_clients ";
if ($where_clause) {
	$sql .= "WHERE $where_clause;";
}


$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$last_name = $row['last_name'];
		$first_name = $row['first_name'];
		$id = $row['id'];
		$address = $row['address'];
		$telephone = $row['telephone'];
		$date_of_birth = $row['date_of_birth'];
		$ethnic_group_description = $row['ethnic_group_description'];		
		$gender_description = $row['gender_description'];
		$residency_status_description = $row['residency_status_description'];
		
		echo "
			<tr>
				<td>$last_name</td>
				<td>$first_name</td>				
				<td>$id</td>
				<td>$address</td>
				<td>$telephone</td>				
				<td>$date_of_birth</td>
				<td>$gender_description</td>					
				<td>$ethnic_group_description</td>			
				<td>$residency_status_description</td>				
			</tr>
		";
	}

?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
