<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php //include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php
// DB table to use
$table = 'view_appointments';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
    array( 'db' => 'id', 'dt' => 0),
    array( 'db' => 'date', 'dt' => 1),
    array( 'db' => 'time', 'dt' => 2),	
	array( 'db' => 'counsellor', 'dt' => 3),
	array( 'db' => 'appointment_type', 'dt' => 4),
	array( 'db' => 'appointment_status', 'dt' => 5),
	array( 'db' => 'fee', 'dt' => 6),
	array( 'db' => 'payment_status', 'dt' => 7),
	array( 'db' => 'notes', 'dt' => 8),
	array( 'db' => 'action', 'dt' => 9)
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

$client_id = $_SESSION['client_id'];
$clientIdClause = "client_id=$client_id";

require($_SERVER["DOCUMENT_ROOT"]."/includes/ssp.class.php");

echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $clientIdClause )
);

?>
<?php //include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
