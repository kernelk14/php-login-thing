<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "test_db";

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Error connecting to database.");
    } else {
        echo "<script>console.log('Database connected')</script>";
    }

    $query = "CREATE TABLE IF NOT EXISTS test_db.users (id INT(11) AUTO_INCREMENT PRIMARY KEY, uname VARCHAR(30) NOT NULL, pass VARCHAR(80) NOT NULL)";

    $result = $conn->query($query);

    if ($result) {
        echo "<script>console.log('Table created.')</script>";
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>This is the site.</title>
        <link rel="stylesheet" href="pico-main/css/pico.min.css" />
        <link rel="stylesheet" href="pico-main/css/pico.colors.min.css" />
    </head>
    
    <body>
        <main class="container">
            <h2> Log In </h2>
            <form action="checklogin.php" method="POST">
                <p> Enter Username <input type="text" name="username" required /></p>
                <p> Enter Password <input type="password" name="password" required /></p>
                <input type="submit" value="Login" />
            </form>
            <p> Or you can <a href="register.php">register</a> today.</p>
            <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['test_db'])) {
                    header("location: home.php");
                    exit;
                }
            ?>
        </main>
    </body>
</html>
