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
	SELECT `service_description`,
	SUM(`number_of_enquiries`) AS `number_of_enquiries`,
	COUNT(`number_of_enquiries`) AS 'number_of_clients'
	FROM (
		SELECT `view_clients`.`id` AS 'client_id',
		COUNT(*) AS 'number_of_enquiries',
		`services`.`description` AS 'service_description'
		FROM `view_clients`
		INNER JOIN `enquiries` ON `enquiries`.`client_id` = `view_clients`.`id`
		INNER JOIN `services` ON `enquiries`.`service_id` = `services`.`id`
		WHERE DATE(`enquiries`.`enquiry_date`) >= DATE('$start') 
		AND DATE(`enquiries`.`enquiry_date`) <= DATE('$end')
		AND `enquiries`.`enquiry_type_id`=7
		GROUP BY `view_clients`.`id`, `enquiries`.`enquiry_type_id`, `enquiries`.`service_id`
		) AS `the_enquiries`
	GROUP BY `service_description`;
";

$services = array();
$total_enquiries = 0;
$total_clients = 0;

$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$service_description = $row['service_description'];
		$number_of_enquiries = $row['number_of_enquiries'];
		$number_of_clients = $row['number_of_clients'];
		$total_enquiries += $number_of_enquiries;
		$total_clients += $number_of_clients;
		$services[$service_description] = ['enquiries' => $number_of_enquiries, 'clients' => $number_of_clients];
	}

foreach($services as $service=>$values) {
	$enquiries = $values['enquiries'];
	$enquiries_percent = round($enquiries / $total_enquiries * 100,2);
	$clients = $values['clients'];
	$clients_percent = round($clients / $total_clients * 100,2);
	
	echo "
		<tr>
			<td>$service</td>
			<td>$enquiries</td>
			<td>$enquiries_percent%</td>
			<td>$clients</td>
			<td>$clients_percent%</td>
		</tr>
	";
	
}

echo "
	<tr>
		<td>Total</td>
		<td>$total_enquiries</td>
		<td>100%</td>
		<td>$total_clients</td>
		<td>100%</td>
	</tr>
	";

?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>