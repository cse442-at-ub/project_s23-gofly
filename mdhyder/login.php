<?php
require_once('config.php');
// Establish database connection
session_start();


// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = mysqli_real_escape_string($db_connection, $_POST['uid']);
    $password = mysqli_real_escape_string($db_connection, $_POST['pwd']);
    

    // Query the database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($db_connection, $sql);

    // Check if the query returned any rows
    if (mysqli_num_rows($result) == 1) {
        // Get the user's data
        $user = mysqli_fetch_assoc($result);
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Login successful
            session_start();
            $_SESSION['username'] = $username;
            header("Location: landing.php");
            exit;
        } else {
            // Login failed
            echo "Invalid username or password.";
        }
    } else {
        // Login failed
        echo "Invalid username or password.";
    }
}

mysqli_close($db_connection);
?>