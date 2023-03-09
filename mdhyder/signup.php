<?php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Connect to the database (replace with your own database credentials)
    $servername = "oceanus.cse.buffalo.edu:3306";
    $username = "mamuin";
    $password = "50424784";
    $dbname = "mamuin_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

     // Get the user input
     $user = $_POST['uid'];
     $email = $_POST['email'];
     $password = $_POST['pwd'];
     $FirstName = $_POST['fname'];
     $LastName = $_POST['lname'];
     $PhoneNumber = $_POST['num'];
 
     // Validate the user input (e.g. check for empty fields, validate email address, etc.)
     // ...
 
    //  // Hash the password for security
    //  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the new user data into the database
    $sql = "INSERT INTO users (username, email, password, FirstName, LastName, PhoneNumber)
            VALUES ('$user', '$email', '$password', '$FirstName', '$LastName', '$PhoneNumber')";

    if ($conn->query($sql) === TRUE) {
        // Redirect the user to the login page
        header("Location: login.html");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}

?>