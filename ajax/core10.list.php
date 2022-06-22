<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php //include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php
// DB table to use
$table = 'view_core10';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
    array( 'db' => 'id', 'dt' => 0),
    array( 'db' => 'assessment_date', 'dt' => 1),
	array( 'db' => 'q1', 'dt' => 2),
	array( 'db' => 'q2', 'dt' => 3),
	array( 'db' => 'q3', 'dt' => 4),
	array( 'db' => 'q4', 'dt' => 5),
	array( 'db' => 'q5', 'dt' => 6),
	array( 'db' => 'q6', 'dt' => 7),
	array( 'db' => 'q7', 'dt' => 8),
	array( 'db' => 'q8', 'dt' => 9),
	array( 'db' => 'q9', 'dt' => 10),
	array( 'db' => 'q10', 'dt' => 11),
	array( 'db' => 'total_score', 'dt' => 12),
	array( 'db' => 'questions_completed', 'dt' => 13),
	array( 'db' => 'mean_score', 'dt' => 14),
	array( 'db' => 'clinical_score', 'dt' => 15),
	array( 'db' => 'action', 'dt' => 16)
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
