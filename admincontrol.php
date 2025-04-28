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

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Admin Controls</title>
		<link rel="stylesheet" href="pico-main/css/pico.min.css" />
        <link rel="stylesheet" href="pico-main/css/pico.colors.min.css" />
	</head>
	<body>
		<main class="container">
			<h4>Admin Controls</h4>
			<form method="POST">
				<h5> Select Account: </h5>
				<br />
				<select name='user_select'>
					<?php
						static $users = array();
						$user = "";
						$query = "SELECT uname FROM users";
						$result = $conn->query($query);
						if ($result) {
							while ($row = $result->fetch_assoc()) {
								array_push($users, $row['uname']);
								echo "<option value='" . $row['uname'] . "'>" . $row['uname'] . "</option>";
							}
						}
					?>
				</select>
				<textarea name="given" placeholder="Add Messages"></textarea>
				<input type="submit" name="send" value="Send" />
				<?php
					if(isset($_POST['send'])) {
						$us = $_POST['user_select'];
						$give = $_POST['given'];
						$query3 = "INSERT INTO todo_$us (`task`) VALUES ('$give')";
						$result = $conn->query($query3);
						if ($result) {
							console_log("Task Added to User.");
						} else {
							die("Cannot add task to user.");
						}
					}
				?>
			</form>
		</main>
	</body>
</html>