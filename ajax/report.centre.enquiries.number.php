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

$start_date = $form_data['start_date'];
$end_date = $form_data['end_date'];

if (!validate_string_isdate($start_date)) {$data_error = 1;}
if (!validate_string_isdate($end_date)) {$data_error = 2;}

$start = date("Y-m-d", strtotime(str_replace('/','-',$start_date)));
$end = date("Y-m-d", strtotime(str_replace('/','-',$end_date)));

$sql = "
	SELECT `view_clients`.`id` AS 'client_id',
	`view_clients`.`last_name` AS 'last_name',
	`view_clients`.`first_name` AS 'first_name',
	`view_clients`.`residency_status_description` AS 'residency_status_description',
	`view_clients`.`ethnic_group_description` AS 'ethnic_group_description',
	COUNT(*) AS 'number_of_enquiries',
	`services`.`description` AS 'service_description',
	`enquiry_type`.`description` AS 'enquiry_type_description'
	FROM `view_clients`
	INNER JOIN `enquiries` ON `enquiries`.`client_id` = `view_clients`.`id`
	INNER JOIN `enquiry_type` ON `enquiries`.`enquiry_type_id` = `enquiry_type`.`id`
	INNER JOIN `services` ON `enquiries`.`service_id` = `services`.`id`
	WHERE DATE(`enquiries`.`enquiry_date`) >= DATE('$start') 
	AND DATE(`enquiries`.`enquiry_date`) <= DATE('$end')
	GROUP BY `view_clients`.`id`, `enquiries`.`enquiry_type_id`, `enquiries`.`service_id`;
";

$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$last_name = $row['last_name'];
		$first_name = $row['first_name'];
		$id = $row['client_id'];
		$ethnic_group_description = $row['ethnic_group_description'];
		$residency_status_description = $row['residency_status_description'];
		$number_of_enquiries = $row['number_of_enquiries'];
		$service_description = $row['service_description'];
		$enquiry_type_description = $row['enquiry_type_description'];
		
		echo "
			<tr>
				<td>$id</td>			
				<td>$last_name</td>
				<td>$first_name</td>
				<td>$ethnic_group_description</td>				
				<td>$residency_status_description</td>
				<td>$number_of_enquiries</td>
				<td>$service_description</td>
				<td>$enquiry_type_description</td>
			</tr>
		";
	}

?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>