<?php

// Determine if user is logged on. Logged on users will have the session variable USER_UserID set.
// If a user is not logged on, redirect to the log on page.

session_start();

if (!isset($_SESSION["user.id"])) {
	header("location: logon.php");
	die();
}

?>