<?php include("includes/application.php"); ?>
<?php
	session_start();

	// Clear USER session data
	unset($_SESSION['user.id']);
	unset($_SESSION['user.username']);
	unset($_SESSION['user.first_name']);
	unset($_SESSION['user.last_name']);

	// Clear Application session data
	unset($_SESSION['client_id']);
	unset($_SESSION['activity_id']);

	// Destroy the session data
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

	session_destroy();
	header("location: logon.php");

?> 