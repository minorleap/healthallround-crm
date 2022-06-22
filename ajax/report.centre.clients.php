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
	SELECT `totals`.`id` AS 'id',
	`view_clients`.`first_name` AS 'first_name',
	`view_clients`.`last_name` AS 'last_name',
	`view_clients`.`address` AS 'address',
	`view_clients`.`ethnic_group_description` AS 'ethnic_group_description',
	`view_clients`.`residency_status_description` AS 'residency_status_description',
	`totals`.`number_of_times` AS 'number_of_times'  
	FROM (
	SELECT `id` AS 'id', COUNT(*) AS 'number_of_times'
	FROM (  
	  SELECT `clients`.`id` AS 'id'
	  FROM `clients`
	  INNER JOIN `enquiries` ON `clients`.`id` = `enquiries`.`client_id`
	  WHERE DATE(`enquiries`.`enquiry_date`) >= DATE('$start') 
	  AND DATE(`enquiries`.`enquiry_date`) <= DATE('$end')

	  UNION ALL

	  SELECT `clients`.`id` AS 'id'
	  FROM `clients`
	  INNER JOIN `activity_attendance` ON `clients`.`id` = `activity_attendance`.`client_id`
	  INNER JOIN `activity_meetings` ON `activity_attendance`.`activity_meeting_id` = `activity_meetings`.`id`
	  WHERE DATE(`activity_meetings`.`meeting_date`) >= DATE('$start')
	  AND DATE(`activity_meetings`.`meeting_date`) <= DATE('$end')
	) AS attendance_and_enquiries
	GROUP BY `id`
	) AS totals
	INNER JOIN `view_clients` ON `view_clients`.`id` = `totals`.`id`
";



$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$last_name = $row['last_name'];
		$first_name = $row['first_name'];
		$id = $row['id'];
		$address = $row['address'];
		$ethnic_group_description = $row['ethnic_group_description'];		
		$residency_status_description = $row['residency_status_description'];
		$number_of_times = $row['number_of_times'];
		
		echo "
			<tr>
				<td>$id</td>			
				<td>$last_name</td>
				<td>$first_name</td>				
				<td>$address</td>		
				<td>$ethnic_group_description</td>			
				<td>$residency_status_description</td>
				<td>$number_of_times</td>
			</tr>
		";
	}

?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>