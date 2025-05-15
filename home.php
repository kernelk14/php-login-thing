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

				$query2 = "CREATE TABLE IF NOT EXISTS done_$uname (id INT(11) AUTO_INCREMENT PRIMARY KEY, task VARCHAR(800) NOT NULL)";

				$result = $conn->query($query2);

				if ($result) {
					console_log("Table Created.");
				} else {
					die("Could not create table: " . $conn->connect_error);
				}

			?>
			<div class="container">
				<form method="POST" role="group">
					<input type="text" name="todo_box" placeholder="Add todo notes." id="todo_box" autocomplete="off" />
					<input type="submit" name="add" />
				</form>
			</div>
			<?php
				if (strcmp($uname, "cct") == 0) {
					echo "<iframe src='admincontrol.php' width='1200px' height='550px'></iframe>";
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

				if (isset($_POST['add'])) {
					$todo_text = $_POST['todo_box'];
					$send = $conn->query("INSERT INTO todo_$uname (`task`) VALUES ('$todo_text')");
					if (!$send) {
						die("Error transferring TODO Text.");
					} else {
						console_log("Transferred TODO.");
					}
					assign("");
				}

			?>
			</ul>

			<a href="logout.php">Logout</a>
		</main>
	</body>
</html>

