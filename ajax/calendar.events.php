<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php

	$sql = "SELECT * FROM `view_calendar`;";

	$dbdata = array();

	$result = $conn->query($sql);
	if ($result->num_rows >0){
		while($row = $result->fetch_assoc()){
			$dbdata[]=$row;
		}
	} else {
		die();
	}

echo json_encode($dbdata);
?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
