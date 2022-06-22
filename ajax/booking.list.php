<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php
// DB table to use
$table = 'view_activity_bookings';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
	array( 'db' => 'id', 'dt' => 0),
	array( 'db' => 'client_name', 'dt' => 1),
	array( 'db' => 'date_of_birth', 'dt' => 2, 'formatter' => function($d, $row) {
		return $d? date('d/m/Y', strtotime($d)) : "";
	}),
    array( 'db' => 'postcode', 'dt' => 3),
    array( 'db' => 'active', 'dt' => 4, 'formatter' => function($d, $row) {
		
		$active = $d ? "<i class='fas fa-check-circle' style='color: green'></i>" : "<i class='fas fa-times-circle' style='color: red'></i>";
		
		return $active;
	}),
	array( 'db' => 'action', 'dt' => 5)
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

$activity_id = $_SESSION['activity_id'];
$where = "activity_id=$activity_id";

echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where )
);

?>