<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<link rel="stylesheet" href="pico-main/css/pico.min.css" />
        <link rel="stylesheet" href="pico-main/css/pico.colors.min.css" />
	</head>
	<body>
		<main class="container">
			<h2>Register User</h2>
			<form method="POST">
				<p> Create a username <input type="text" name="regname" required autocomplete="off" /></p>
				<p> Create a password <input type="password" name="regpass" required autocomplete="off" /></p>
				<p> Confirm your password <input type="password" name="confpass" required autocomplete="off"  /></p>
				<input type="submit" name="regbutton" value="Register" />
			</form>
			<p> Or you can <a href="index.php">login</a> to your existing user.</p>
		</main>
	</body>
</html>

<?php
	
	include 'functions.php';

	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "test_db";

	$conn = new mysqli($host, $user, $pass, $db);

	if ($conn->connect_error) {
		echo $conn->connect_error;
	} else {
		console_log('Database connected successfully.');
	}

	if (isset($_POST['regbutton'])) {
		$regName = $_POST['regname'];
		$regPass = $_POST['regpass'];
		$confPass = $_POST['confpass'];

		$query1 = "SELECT * FROM users WHERE uname = '$regName'";
		$exists = $conn->query($query1);

		if (mysqli_num_rows($exists) != 0) {
			alert("User already existed.");
			assign('register.php');
			
		} else {
			if (strcmp($regPass, $confPass) == 0) {
				$query = "INSERT INTO users (uname, pass) VALUES ('$regName', '$regPass')";
				$result = $conn->query($query);
				if ($result) {
					console_log('User registered.');
					alert('User now registered! Login to your existing user.');
					assign('index.php');
					// header("location: index.php");
				} else {
					die("User cannot register.");
				}
			} else {
				alert('Passwords are not the same');
				assign('register.php');
			}
		}
	}
?>