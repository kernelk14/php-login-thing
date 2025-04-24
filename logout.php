<?php
	session_start();
	if (isset($_SESSION['test_db'])) {
		$_SESSION = array();
		session_destroy();
	}
	header("location: index.php");
	exit;
?>