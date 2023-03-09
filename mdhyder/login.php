<?php
// Establish database connection
session_start();

$servername = "oceanus.cse.buffalo.edu:3306";
$user = "mamuin";
$pass = "50424784";
$dbname = "mamuin_db";

$conn = mysqli_connect($servername, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = mysqli_real_escape_string($conn, $_POST['uid']);
    $password = mysqli_real_escape_string($conn, $_POST['pwd']);
    

    // Query the database
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // Check if the query returned any rows
    if (mysqli_num_rows($result) == 1) {
        // Login successful
        session_start();
        $_SESSION['username'] = $username;
        header("Location: landing.php");
        exit;
    } else {
        // Login failed
        echo "Invalid username or password.";
    }
}

mysqli_close($conn);
?>