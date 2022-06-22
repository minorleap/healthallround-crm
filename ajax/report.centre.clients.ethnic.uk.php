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
	SELECT `ethnic_group_description` AS 'ethnic_group_description', COUNT(*) AS 'count'
	FROM (  
	  SELECT `clients`.`id` AS 'id', `ethnic_group`.`description` AS 'ethnic_group_description'
	  FROM `clients`
	  INNER JOIN `ethnic_group` ON `clients`.`ethnic_group_id`=`ethnic_group`.`id`
	  INNER JOIN `enquiries` ON `clients`.`id` = `enquiries`.`client_id`
	  WHERE DATE(`enquiries`.`enquiry_date`) >= DATE('$start') 
	  AND DATE(`enquiries`.`enquiry_date`) <= DATE('$end')
	  AND `clients`.`residency_id`=0

	  UNION ALL

	  SELECT `clients`.`id` AS 'id', `ethnic_group`.`description` AS 'ethnic_group_description'
	  FROM `clients`
	  INNER JOIN `ethnic_group` ON `clients`.`ethnic_group_id`=`ethnic_group`.`id`	  
	  INNER JOIN `activity_attendance` ON `clients`.`id` = `activity_attendance`.`client_id`
	  INNER JOIN `activity_meetings` ON `activity_attendance`.`activity_meeting_id` = `activity_meetings`.`id`
	  WHERE DATE(`activity_meetings`.`meeting_date`) >= DATE('$start')
	  AND DATE(`activity_meetings`.`meeting_date`) <= DATE('$end')
	  AND `clients`.`residency_id`=0	  
	) as client_visits
	GROUP BY `ethnic_group_description`;
	";

$result = $conn->query($sql);
$ethnic_group_counts = array();
$total_count = 0;

echo "
	<thead><tr>
		<th>Ethnic Group</th>
		<th>Count</th>
		<th>Percent</th>
	</tr></thead>
	<tbody>
	";

while($row = $result->fetch_assoc()){
	$ethnic_group_description = $row['ethnic_group_description'];
	$count = $row['count'];
	$ethnic_group_counts[$ethnic_group_description] = $count;
	$total_count += $count;
}

foreach ($ethnic_group_counts as $ethnic_group=>$count) {
	$percent = $count==0? 0 : round(($count / $total_count) * 100, 0);
	echo "
		<tr>
			<td>$ethnic_group</td>
			<td>$count</td>
			<td>$percent</td>
		</tr>
	";
}

echo "<tr><td>Total</td><td>$total_count</td><td>100</td></tr>";
echo "</tbody>";


?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>