<?php

	// Create connection
	$conn = new mysqli(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_DATABASENAME);
	// Check connection
	if ($conn->connect_error) {
		die("Couldn't connect to MySQL Server: " . $conn->connect_error);
	} 
	  
?>