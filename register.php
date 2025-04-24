<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<link rel="stylesheet" href="pico-main/css/pico.min.css" />
        <link rel="stylesheet" href="pico-main/css/pico.colors.min.css" />
	</head>
	<body>
		<main class="container">
			<form method="POST">
				<p> Create a username <input type="text" name="regname" required /></p>
				<p> Create a password <input type="password" name="regpass" required /></p>
				<p> Confirm your password <input type="password" name="confpass" required /></p>
				<input type="submit" name="regbutton" value="Register" />
			</form>
			<p> Or you can <a href="index.php">login</a> to your existing user.</p>
		</main>
	</body>
</html>

<?php
	
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "test_db";

	$conn = new mysqli($host, $user, $pass, $db);

	if ($conn->connect_error) {
		echo $conn->connect_error;
	} else {
		echo "<script>console.log('Database connected successfully.')</script>";
	}

	if (isset($_POST['regbutton'])) {
		$regName = $_POST['regname'];
		$regPass = $_POST['regpass'];
		$confPass = $_POST['confpass'];

		if (strcmp($regPass, $confPass) == 0) {
			$query = "INSERT INTO users (uname, pass) VALUES ('$regName', '$regPass')";
			$result = $conn->query($query);
			if ($result) {
				echo "<script>console.log('User registered.')</script>";
				echo "<script>alert('User now registered! Login to your existing user.')</script>";
				echo "<script>window.location.assign('index.php')</script>";
				// header("location: index.php");
			} else {
				die("User cannot register.");
			}
		} else {
			echo "<script>alert('Passwords are not the same')</script>";
			header("location: register.php");
		}
	}
?>