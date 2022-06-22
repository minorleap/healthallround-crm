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


// populate client data

$sql = "
	  SELECT `residency_status_description`, COUNT(*) AS 'count'
	  FROM (
		SELECT DISTINCT `id`, `residency_status_description`
		FROM (  
		  SELECT `clients`.`id` AS 'id', `residency_status`.`description` AS 'residency_status_description'
		  FROM `clients`
		  INNER JOIN `residency_status` ON `clients`.`residency_id`=`residency_status`.`id`
		  INNER JOIN `enquiries` ON `clients`.`id` = `enquiries`.`client_id`
		  WHERE DATE(`enquiries`.`enquiry_date`) >= DATE('$start') 
		  AND DATE(`enquiries`.`enquiry_date`) <= DATE('$end')

		  UNION ALL

		  SELECT `clients`.`id` AS 'id', `residency_status`.`description` AS 'residency_status_description'
		  FROM `clients`
		  INNER JOIN `residency_status` ON `clients`.`residency_id`=`residency_status`.`id`	  
		  INNER JOIN `activity_attendance` ON `clients`.`id` = `activity_attendance`.`client_id`
		  INNER JOIN `activity_meetings` ON `activity_attendance`.`activity_meeting_id` = `activity_meetings`.`id`
		  WHERE DATE(`activity_meetings`.`meeting_date`) >= DATE('$start')
		  AND DATE(`activity_meetings`.`meeting_date`) <= DATE('$end')
		) as client_visits
	  ) as unique_clients
	  GROUP BY `residency_status_description`
	";

$result = $conn->query($sql);
$residency_status_client_counts = array();
$total_client_count = 0;

while($row = $result->fetch_assoc()){
	$residency_status_description = $row['residency_status_description'];
	$count = $row['count'];
	$residency_status_client_counts[$residency_status_description] = $count;
	$total_client_count += $count;
}


// populate visits data

$sql = "
    SELECT `residency_status_id` AS 'residency_status_id', `residency_status`.`description` AS 'residency_status_description', COUNT(*) AS 'count'
    FROM (
      SELECT `clients`.`residency_id` AS 'residency_status_id'
	  FROM `clients`
	  INNER JOIN `enquiries` ON `clients`.`id` = `enquiries`.`client_id`
	  WHERE DATE(`enquiries`.`enquiry_date`) >= DATE('2018-01-01') 
	  AND DATE(`enquiries`.`enquiry_date`) <= DATE('2020-12-31')

	  UNION ALL

	  SELECT `clients`.`residency_id` AS 'residency_status_id'	  
	  FROM `clients`
	  INNER JOIN `activity_attendance` ON `clients`.`id` = `activity_attendance`.`client_id`
	  INNER JOIN `activity_meetings` ON `activity_attendance`.`activity_meeting_id` = `activity_meetings`.`id`
	  WHERE DATE(`activity_meetings`.`meeting_date`) >= DATE('2018-01-01')
	  AND DATE(`activity_meetings`.`meeting_date`) <= DATE('2020-12-31')
	) as visits
	INNER JOIN `residency_status` ON `visits`.`residency_status_id`=`residency_status`.`id`
	GROUP BY `residency_status_id`;
	";

$result = $conn->query($sql);
$residency_status_visit_counts = array();
$total_visit_count = 0;

while($row = $result->fetch_assoc()){
	$residency_status_description = $row['residency_status_description'];
	$count = $row['count'];
	$residency_status_visit_counts[$residency_status_description] = $count;
	$total_visit_count += $count;
}

echo "
	<thead><tr>
		<th>Residency Status</th>
		<th>Clients</th>
		<th>% of Clients</th>
		<th>Visits</th>
		<th>% of Visits</th>
	</tr></thead>
	<tbody>
	";

foreach ($residency_status_client_counts as $residency_status=>$client_count) {
	$client_percent = $client_count==0? 0 : round(($client_count / $total_client_count) * 100, 2);
	$visit_count = $residency_status_visit_counts[$residency_status];
	$visit_percent = $visit_count==0? 0 : round(($visit_count / $total_visit_count) * 100, 2);
	echo "
		<tr>
			<td>$residency_status</td>
			<td>$client_count</td>
			<td>$client_percent%</td>
			<td>$visit_count</td>
			<td>$visit_percent%</td>
		</tr>
	";
}

echo "<tr><td>Total</td><td>$total_client_count</td><td>100%</td><td>$total_visit_count</td><td>100%</td></tr>";
echo "</tbody>";


?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>