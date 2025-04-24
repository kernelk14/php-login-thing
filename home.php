<html>
	<head>
		<title>PHP Test</title>
	</head>
	<body>
		<?php
			session_start();
			
			if (isset($_SESSION['test_db'])) {
				$uname = $_SESSION['test_db'];
				echo "<h2>Welcome user $uname!</h2>";
			}
		?>
		<a href="logout.php">Logout</a>
	</body>
</html>