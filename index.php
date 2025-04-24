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
    </head>
    
    <body>
        <form action="checklogin.php" method="POST">
            <p> Enter Username <input type="text" name="username" required /></p>
            <p> Enter Password <input type="password" name="password" required /></p>
            <input type="submit" value="Login" />
        </form>
        <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['test_db'])) {
                header("location: home.php");
                exit;
            }
        ?>
    </body>
</html>
