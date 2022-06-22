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

if($data_error==0) {

	$start = date("Y-m-d", strtotime(str_replace('/','-',$start_date)));
	$end = date("Y-m-d", strtotime(str_replace('/','-',$end_date)));

	$services = array();
	$sql = "SELECT `id`, `description` FROM `services`;";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$id = $row['id'];
		$description = $row['description'];
		$services[$id] = $description;
	}

	$activities = array();
	$sql = "SELECT `id`, `name` FROM `activities`;";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$id = $row['id'];
		$name = $row['name'];
		$activities[$id] = $name;
	}

	$clients = array();
	$used_services = array();
	$used_activities = array();

	foreach($services as $service_id=>$service_name) {
		$sql = "SELECT client_id AS 'client_id', COUNT(*) AS 'uses'
				FROM enquiries
				WHERE service_id=$service_id
				AND DATE(`enquiries`.`enquiry_date`) >= DATE('$start')
				AND DATE(`enquiries`.`enquiry_date`) <= DATE('$end')
				GROUP BY client_id;";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			$client_id = $row['client_id'];
			$uses = $row['uses'];
			$clients[$client_id][$service_name] = $uses;
			if (!array_key_exists($service_name, $used_services)) {
				$used_services[$service_name] = $service_name;
			}
		}
	}

	foreach($activities as $activity_id=>$activity_name) {
		$sql = "SELECT client_id AS 'client_id', COUNT(*) AS 'uses'
				FROM `activity_attendance`
				INNER JOIN `activity_meetings` ON `activity_attendance`.`activity_meeting_id` = `activity_meetings`.`id`
				WHERE `activity_meetings`.`activity_id`=$activity_id
				AND DATE(`activity_meetings`.`meeting_date`) >= DATE('$start')
				AND DATE(`activity_meetings`.`meeting_date`) <= DATE('$end')
				GROUP BY client_id;";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			$client_id = $row['client_id'];
			$uses = $row['uses'];
			$clients[$client_id][$activity_name] = $uses;
			if (!array_key_exists($activity_name, $used_activities)) {
				$used_activities[$activity_name] = $activity_name;
			}		
		}
	}

	echo chr(34) . "Client ID" . chr(34);
	foreach ($used_services as $service_name) {
		echo "," . chr(34) . $service_name . chr(34);
	}
	foreach ($used_activities as $activity_name) {
		echo "," . chr(34) . $activity_name . chr(34);
	}
	echo "\r\n";
	foreach ($clients as $client_id=>$client_uses) {
		echo $client_id;
		foreach ($used_services as $service_name) {
			$uses = 0 + $client_uses[$service_name];
			echo ",$uses";
		}
		foreach ($used_activities as $activity_name) {
			$uses = 0 + $client_uses[$activity_name];
			echo ",$uses";
		}	
		echo "\r\n";
	}
	//echo "</tbody>";	
	
}


?>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>