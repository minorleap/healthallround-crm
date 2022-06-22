<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php //include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php
// DB table to use
$table = 'view_activities';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
    array( 'db' => 'id', 'dt' => 0),
	array( 'db' => 'name', 'dt' => 1),	
    array( 'db' => 'start_date', 'dt' => 2),
    array( 'db' => 'end_date', 'dt' => 3),
	array( 'db' => 'weekday', 'dt' => 4),
	array( 'db' => 'start_time', 'dt' => 5),
	array( 'db' => 'duration_hours', 'dt' => 6),
	array( 'db' => 'organiser', 'dt' => 7),
	array( 'db' => 'capacity', 'dt' => 8),
	array( 'db' => 'frequency', 'dt' => 9),
	array( 'db' => 'contact_details', 'dt' => 10),	
	array( 'db' => 'action', 'dt' => 11)
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


$where = "is_archived=0 AND (ISNULL(end_date) OR end_date  >= CURDATE())";

require($_SERVER["DOCUMENT_ROOT"]."/includes/ssp.class.php");

echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where )
);

?>
