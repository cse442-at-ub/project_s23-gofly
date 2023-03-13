<?php

session_start();

// Redirect to login page if user is not logged in
if(!isset($_SESSION['username'])){
    header("Location: login.html");
    exit();
}

// Process form data if it has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Set up database connection
    $servername = "oceanus.cse.buffalo.edu:3306";
    $username = "mamuin";
    $password = "50424784";
    $dbname = "mamuin_db";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $phone = $_POST['phone'];
    $username = $_SESSION['username'];

    // Construct SQL query
    $sql = "UPDATE users SET FirstName='$firstName', LastName='$lastName', PhoneNumber='$phone' WHERE username='$username'";

    // Execute query
    if ($conn->query($sql) === TRUE) {
         // Redirect the user to the login page
         header("Location: profile.php");
         $_SESSION['status'] = "Sucessfully Saved";
         exit;
    } else {
        echo "Error updating user data: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}

?>