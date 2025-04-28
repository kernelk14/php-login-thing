<!DOCTYPE html>
<html>
	<head>
		<title>PHP Test</title>
		<link rel="stylesheet" href="pico-main/css/pico.min.css" />
        <link rel="stylesheet" href="pico-main/css/pico.colors.min.css" />
	</head>
	<body>
		<main class="container">
			<?php
				session_start();
				include 'functions.php';

				$host = "localhost";
				$user = "root";
				$pass = "";
				$db = "test_db";

				$conn = new mysqli($host, $user, $pass, $db);

				$uname = "";
				
				if ($conn->connect_error) {
					echo $conn->connect_error;
				} else {
					console_log('Database connected successfully.');
				}
				
				if (isset($_SESSION['test_db'])) {
					global $uname;
					$uname = $_SESSION['test_db'];
					if (strcmp($uname, "cct") == 0) {
						echo "<h2>Welcome user $uname (admin)</h2>";
						echo "<iframe src='admincontrol.php' width='1200px' height='550px'></iframe>";
					} else {
						echo "<h2>Welcome user $uname!</h2>";
					}
				}

				$query = "CREATE TABLE IF NOT EXISTS todo_$uname (id INT(11) AUTO_INCREMENT PRIMARY KEY, task VARCHAR(800) NOT NULL)";

				$result = $conn->query($query);

				if ($result) {
					console_log("Table Created.");
				} else {
					die("Could not create table: " . $conn->connect_error);
				}
			?>
			
			<h3>Tasks: </h3>
			<ul>

			<?php

				$query2 = "SELECT * FROM todo_$uname";
				$read = $conn->query($query2);

				if (mysqli_num_rows($read) < 1) {
					echo "<p>No pending activities found.</p>";
				} else {

					while ($row = $read->fetch_assoc()) {
						$acts = $row['task'];
						printCard($acts);
					}
				}
			?>
			</ul>

			<a href="logout.php">Logout</a>
		</main>
	</body>
</html>

