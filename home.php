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
				if (isset($_SESSION['test_db'])) {
					$uname = $_SESSION['test_db'];
					echo "<h2>Welcome user $uname!</h2>";
				}
			?>
			<a href="logout.php">Logout</a>
		</main>
	</body>
</html>