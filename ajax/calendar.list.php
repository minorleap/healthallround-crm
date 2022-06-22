<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php //include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php
// DB table to use
$table = 'view_activity_meetings';
 
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
	array( 'db' => 'action', 'dt' => 3)
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

$where = "";


echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where )
);

?>