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
	SELECT DISTINCT `id` AS 'id', TIMESTAMPDIFF(YEAR, `date_of_birth`, CURDATE()) AS 'age'
	FROM (  
	  SELECT `clients`.`id` AS 'id', `clients`.`date_of_birth` as 'date_of_birth'
	  FROM `clients`
	  INNER JOIN `enquiries` ON `clients`.`id` = `enquiries`.`client_id`
	  WHERE DATE(`enquiries`.`enquiry_date`) >= DATE('$start') 
	  AND DATE(`enquiries`.`enquiry_date`) <= DATE('$end')

	  UNION ALL

	  SELECT `clients`.`id` AS 'id', `clients`.`date_of_birth` as 'date_of_birth'
	  FROM `clients`
	  INNER JOIN `activity_attendance` ON `clients`.`id` = `activity_attendance`.`client_id`
	  INNER JOIN `activity_meetings` ON `activity_attendance`.`activity_meeting_id` = `activity_meetings`.`id`
	  WHERE DATE(`activity_meetings`.`meeting_date`) >= DATE('$start')
	  AND DATE(`activity_meetings`.`meeting_date`) <= DATE('$end')
	) as client_visits;
	";

$result = $conn->query($sql);
$age_band_counts = array("0-4"=>0, "5-15"=>0, "16-19"=>0, "20-24"=>0, "25-39"=>0, "40-59"=>0, "60+"=>0, "Unknown"=>0);
$total_count = $result->num_rows;

while($row = $result->fetch_assoc()){
	$age = $row['age'];
	if (is_null($age)) {
		$age_band_counts["Unknown"]++;
	} elseif ($age < 5) {
		$age_band_counts["0-4"]++;
	} elseif ($age < 16) {
		$age_band_counts["5-15"]++;
	} elseif ($age < 20) {
		$age_band_counts["16-19"]++;
	} elseif ($age < 25) {
		$age_band_counts["20-24"]++;
	} elseif ($age < 40) {
		$age_band_counts["25-39"]++;
	} elseif ($age < 60) {
		$age_band_counts["40-59"]++;
	} else {
		$age_band_counts["60+"]++;
	}
}

echo "
	<thead><tr>
		<th>Age Band</th>
		<th>Count</th>
		<th>Percent</th>
	</tr></thead>
	<tbody>
	";

foreach ($age_band_counts as $age_band=>$count) {
	$percent = $count==0? 0 : round(($count / $total_count) * 100, 0);
	echo "
		<tr>
			<td>$age_band</td>
			<td>$count</td>
			<td>$percent</td>
		</tr>
		";
}
echo "<tr><td>Total</td><td>$total_count</td><td>100</td></tr>";
echo "</tbody>";


?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>