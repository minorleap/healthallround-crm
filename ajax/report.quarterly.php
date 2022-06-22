<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php

/*
	This file will generate an array called $services which contains arrays for the previous quarters of the year and for the selected year. The inner arrays contain the set of clients who accessed each service/activity. Clients will only appear under a service/activity in the 'selected' array if they do not appear in the corresponding service/activity in the 'previous' array (i.e. they only appear in the 'selected' array if they have not used the service/activity in previous quarters).
	
	FOrmat:
	
	'previous' => [
		'service1' => [client1, client2, client3, ...]
		'service2' => [client3, client4, ...]
		'activity3' => [client5, ...]
		...
	],
	'selected' => [
		'service1' => [client4, client5, ...]
		'service2' => [client5, ...]
		'activity3' => [client6, ...]	
	]
*/

// Sanitise form data
$form_data = $_POST;
foreach ($form_data as $key => $value) {
	$value = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$value = $conn->real_escape_string($value);
	$form_data[$key] = $value;
}

$data_error = 0;

$year = $form_data['year'];
$quarter = $form_data['quarter'];
$record_type = $form_data['record_type'];

if (!validate_string_isnumber($year)) {$data_error = 1;}
if (!validate_string_isnumber($quarter)) {$data_error = 2;}
if (!in_array($record_type, array('services', 'activities', 'both'))) {$data_error = 3;}

// set the report start and end dates based on the selected year and quarter
$next_year = $year + 1;
$quarter1_start = "$year-04-01";
$quarter1_end = "$year-06-30";
$quarter2_start = "$year-07-01";
$quarter2_end = "$year-09-30";
$quarter3_start = "$year-10-01";
$quarter3_end = "$year-12-31";
$quarter4_start = "$next_year-01-01";
$quarter4_end = "$next_year-03-31";

switch ($quarter) {
	case 1:
		$start = $quarter1_start;
		$end = $quarter1_end;
		$previous_start = $quarter1_start;
		$previous_end = "1970-01-01"; // don't report on anything before the start of Q1 in the selected year
		break;
	case 2:
		$start = $quarter2_start;
		$end = $quarter2_end;
		$previous_start = $quarter1_start;
		$previous_end = $quarter1_end;
		break;
	case 3:
		$start = $quarter3_start;
		$end = $quarter3_end;
		$previous_start = $quarter1_start;
		$previous_end = $quarter2_end;
		break;
	case 4:
		$start = $quarter4_start;
		$end = $quarter4_end;
		$previous_start = $quarter1_start;
		$previous_end = $quarter3_end;
		break;
}

// create an array to hold results from previous quarters and the selected quarter
$services = array('previous'=>array(), 'selected'=>array());

// get all the services/activities used from the start of quarter 1 to the end of the selected quarter
$services_sql = "
	SELECT DISTINCT `services`.`description` AS 'service/activity'
	FROM `enquiries`
	INNER JOIN `services` ON `enquiries`.`service_id`=`services`.`id`
	WHERE `enquiries`.`enquiry_date` >= DATE('$previous_start')
	AND `enquiries`.`enquiry_date` <= DATE('$end')
";

$activities_sql = "
	SELECT DISTINCT `activities`.`name` AS 'service/activity'
	FROM `activities`
	INNER JOIN `activity_meetings` ON `activity_meetings`.`activity_id`=`activities`.`id`
	INNER JOIN `activity_attendance` ON `activity_attendance`.`activity_meeting_id`=`activity_meetings`.`id`
	WHERE `activity_meetings`.`meeting_date` >= DATE('$previous_start')
	AND `activity_meetings`.`meeting_date` <= DATE('$end')
";

if ($record_type == 'services') {
	$sql = $services_sql;
} else if ($record_type == 'activities') {
	$sql = $activities_sql;
} else {
	$sql = $services_sql . " UNION ALL " . $activities_sql;
}

// pre-populate the arrays with keys for each of the used services/activities
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
	$service = $row['service/activity'];
	$services['previous'][$service] = array();
	$services['selected'][$service] = array();
}

// retrieve data for previous quarters
$services_sql = "
	SELECT `services`.`description` AS 'service/activity',
	`enquiries`.`client_id` AS 'client_id'
	FROM `enquiries`
	INNER JOIN `services` ON `enquiries`.`service_id`=`services`.`id`
	WHERE `enquiries`.`enquiry_date` >= DATE('$previous_start')
	AND `enquiries`.`enquiry_date` <= DATE('$previous_end')
	GROUP BY `enquiries`.`client_id`, `enquiries`.`service_id`
";

$activities_sql = "
	SELECT `activities`.`name` AS 'service/activity',
	`activity_attendance`.`client_id` AS 'client_id'
	FROM `activities`
	INNER JOIN `activity_meetings` ON `activity_meetings`.`activity_id` = `activities`.`id`
	INNER JOIN `activity_attendance` ON `activity_attendance`.`activity_meeting_id` = `activity_meetings`.`id`
	WHERE `activity_meetings`.`meeting_date` >= DATE('$previous_start')
	AND `activity_meetings`.`meeting_date` <= DATE('$previous_end')
	GROUP BY `activities`.`id`, `activity_attendance`.`client_id`
";

if ($record_type == 'services') {
	$sql = $services_sql;
} else if ($record_type == 'activities') {
	$sql = $activities_sql;
} else {
	$sql = $services_sql . " UNION ALL " . $activities_sql;
}

// populate the previous quarters results array with clients
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
	$service = $row['service/activity'];
	$client_id = $row['client_id'];
	array_push($services['previous'][$service], $client_id);
}

// retrieve data for selected quarter

$services_sql = "
	SELECT `services`.`description` AS 'service/activity',
	`enquiries`.`client_id` AS 'client_id'
	FROM `enquiries`
	INNER JOIN `services` ON `enquiries`.`service_id`=`services`.`id`
	WHERE `enquiries`.`enquiry_date` >= DATE('$start')
	AND `enquiries`.`enquiry_date` <= DATE('$end')
	GROUP BY `enquiries`.`client_id`, `enquiries`.`service_id`
";

$activities_sql = "
	SELECT `activities`.`name` AS 'service/activity',
	`activity_attendance`.`client_id` AS 'client_id'
	FROM `activities`
	INNER JOIN `activity_meetings` ON `activity_meetings`.`activity_id` = `activities`.`id`
	INNER JOIN `activity_attendance` ON `activity_attendance`.`activity_meeting_id` = `activity_meetings`.`id`
	WHERE `activity_meetings`.`meeting_date` >= DATE('$start')
	AND `activity_meetings`.`meeting_date` <= DATE('$end')
	GROUP BY `activities`.`id`, `activity_attendance`.`client_id`
";

if ($record_type == 'services') {
	$sql = $services_sql;
} else if ($record_type == 'activities') {
	$sql = $activities_sql;
} else {
	$sql = $services_sql . " UNION ALL " . $activities_sql;
}

// populate the selected quarter results array with clients
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
	$service = $row['service/activity'];
	$client_id = $row['client_id'];
	if (!in_array($client_id, $services['previous'][$service]))
	array_push($services['selected'][$service], $client_id);
}



// generate results table

foreach($services['selected'] as $service=>$clients) {
	// count the number of clients who accessed each service/activity in previous quarters
	$previous_count = count($services['previous'][$service]);
	// count the number of clients who accessed each service/activity in the selected quarter
	$selected_count = count($services['selected'][$service]);
	$total_count = $previous_count + $selected_count;
	echo "
		<tr>
			<td>$service</td>
			<td>$previous_count</td>
			<td>$selected_count</td>
			<td>$total_count</td>
		</tr>
	";
}

?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>