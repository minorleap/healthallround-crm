<?php

	// Create connection
	$conn = new mysqli('localhost', 'kingswaycc', 'UUQT4g6KmT.ZCakHZc3!n_nK', 'kingswaycc');
	// Check connection
	if ($conn->connect_error) {
		die("Couldn't connect to MySQL Server: " . $conn->connect_error);
	} 
	  
?>