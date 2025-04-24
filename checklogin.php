<?php

	session_start();

	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "test_db";

	$conn = new mysqli($host, $user, $pass, $db);

	$username = $conn->escape_string($_POST['username']);
	$password = $conn->escape_string($_POST['password']);

	if ($conn->connect_error) {
		echo $conn->connect_error;
	} else {
		echo "<script>console.log('Database connected successfully.')</script>";
	}

	$query = "SELECT * FROM users WHERE uname='$username'";
	$exists = $conn->query($query);

	$fetch_uname = "";
	$fetch_pass = "";

	if ($exists > 0) {
		while ($row = $exists->fetch_assoc()) {

			$fetch_uname = $row['uname'];
			$fetch_pass = $row['pass'];

			if (($username == $fetch_uname) && ($password == $fetch_pass)) {
				if ($password == $fetch_pass) {
					$_SESSION['test_db'] = $username;
					header("location: home.php");
				}
			} else {
				echo "<script>alert('Incorrect Password!')</script>";
				echo "<script>window.location.assign('index.php')</script>";
			}
		}
	} else {
		echo "<script>alert('Incorrect Username!')</script>";
		echo "<script>window.location.assign('index.php')</script>";
	}
?>