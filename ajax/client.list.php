<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php //include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php
// DB table to use
$table = 'view_clients';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
    array( 'db' => 'id', 'dt' => 0),
    array( 'db' => 'full_name', 'dt' => 1),
    array( 'db' => 'address', 'dt' => 2),
	array( 'db' => 'telephone', 'dt' => 3),
	array( 'db' => 'mobile', 'dt' => 4),
	array( 'db' => 'email', 'dt' => 5),
	array( 'db' => 'date_of_birth', 'dt' => 6, 'formatter' => function($d, $row) {
		return $d? date('d/m/Y', strtotime($d)) : "";
	}),
	array( 'db' => 'action', 'dt' => 7)
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
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);

?>
<?php //include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
