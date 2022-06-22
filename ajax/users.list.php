<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php
// DB table to use
$table = 'view_users';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
    array( 'db' => 'id', 'dt' => 0),
    array( 'db' => 'username', 'dt' => 1),
    array( 'db' => 'first_name', 'dt' => 2),
    array( 'db' => 'last_name', 'dt' => 3),
	array(
        'db' => 'is_enabled',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
			if($d==1){
				return "<i class='fas fa-check' style='color: green;'></i>";
			} else {
				return "<i class='fas fa-times' style='color: red;'></i>";
			}
        }
    ),
	array(
        'db' => 'is_counsellor',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
			if($d==1){
				return "<i class='fas fa-check' style='color: green;'></i>";
			} else {
				return "<i class='fas fa-times' style='color: red;'></i>";
			}
        }
    ),	
	array(
        'db' => 'is_admin',
        'dt'        => 6,
        'formatter' => function( $d, $row ) {
			if($d==1){
				return "<i class='fas fa-check' style='color: green;'></i>";
			} else {
				return "<i class='fas fa-times' style='color: red;'></i>";
			}
        }
    ),
	array(
        'db' => 'is_super_admin',
        'dt'        => 7,
        'formatter' => function( $d, $row ) {
			if($d==1){
				return "<i class='fas fa-check' style='color: green;'></i>";
			} else {
				return "<i class='fas fa-times' style='color: red;'></i>";
			}
        }
    ),
	array( 'db' => 'action', 'dt' => 8)
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