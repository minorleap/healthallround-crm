<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php //include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php

// DB table to use
$table = 'view_activity_attendance';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
	array( 'db' => 'id', 'dt' => 0),
	array( 'db' => 'attendance_id', 'dt' => 1),
	array( 'db' => 'meeting_date', 'dt' => 2),	
    array( 'db' => 'activity', 'dt' => 3),
	array( 'db' => 'client', 'dt' => 4),
	array( 'db' => 'client_id', 'dt' => 5),
	array( 'db' => 'action', 'dt' => 6)
);
 
// SQL server connection information
$sql_details = array(
    'user' => DATABASE_USERNAME,
    'pass' => DATABASE_PASSWORD,
    'db'   => DATABASE_DATABASENAME,
    'host' => DATABASE_SERVER
);
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require($_SERVER["DOCUMENT_ROOT"]."/includes/ssp.class.php");

// Clean GET values to prevent SQL injection
$meeting_id = $_GET['id'];
$meeting_id = filter_var($meeting_id, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$meetingIdClause = "`meeting_id`=$meeting_id";

echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $meetingIdClause )
);

?>
<?php //include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
