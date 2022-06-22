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
	SELECT `ethnic_group_description`,
	SUM(`number_of_enquiries`) AS `number_of_enquiries`,
	COUNT(`number_of_enquiries`) AS 'number_of_visits'
	FROM (
		SELECT `view_clients`.`id` AS 'client_id',
		`view_clients`.`ethnic_group_description`,
		COUNT(*) AS 'number_of_enquiries'
		FROM `view_clients`
		INNER JOIN `enquiries` ON `enquiries`.`client_id` = `view_clients`.`id`
		INNER JOIN `enquiry_type` ON `enquiries`.`enquiry_type_id` = `enquiry_type`.`id`
		INNER JOIN `services` ON `enquiries`.`service_id` = `services`.`id`
		WHERE DATE(`enquiries`.`enquiry_date`) >= DATE('$start') 
		AND DATE(`enquiries`.`enquiry_date`) <= DATE('$end')
		GROUP BY `view_clients`.`id`, `enquiries`.`enquiry_type_id`, `enquiries`.`service_id`
		) AS `the_enquiries`
	GROUP BY `ethnic_group_description`;
";

$ethnic_groups = array();
$total_enquiries = 0;
$total_visits = 0;

$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$ethnic_group_description = $row['ethnic_group_description'];
		$number_of_enquiries = $row['number_of_enquiries'];
		$number_of_visits = $row['number_of_visits'];
		$total_enquiries += $number_of_enquiries;
		$total_visits += $number_of_visits;
		$ethnic_groups[$ethnic_group_description] = ['enquiries' => $number_of_enquiries, 'visits' => $number_of_visits];
	}

foreach($ethnic_groups as $group=>$values) {
	$enquiries = $values['enquiries'];
	$enquiries_percent = round($enquiries / $total_enquiries * 100,2);
	$visits = $values['visits'];
	$visits_percent = round($visits / $total_visits * 100,2);
	
	echo "
		<tr>
			<td>$group</td>
			<td>$enquiries</td>
			<td>$enquiries_percent%</td>
			<td>$visits</td>
			<td>$visits_percent%</td>
		</tr>
	";
}

echo "
	<tr>
		<td>Total</td>
		<td>$total_enquiries</td>
		<td>100%</td>
		<td>$total_visits</td>
		<td>100%</td>
	</tr>
	";

?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>