<?php

session_start();
require_once ("config.php");

// Redirect to login page if user is not logged in
if(!isset($_SESSION['username'])){
    header("Location: login.html");
    exit();
}

// Process form data if it has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get user input
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $phone = $_POST['phone'];
    $username = $_SESSION['username'];

    // Construct SQL query
    $sql = "UPDATE users SET FirstName='$firstName', LastName='$lastName', PhoneNumber='$phone' WHERE username='$username'";

    // Execute query
    if ($db_connection->query($sql) === TRUE) {
         // Redirect the user to the login page
         header("Location: profile.php");
         $_SESSION['status'] = "Sucessfully Saved";
         exit;
    } else {
        echo "Error updating user data: ";
    }

    // Close database connection
    $db_connection->close();
}

?>