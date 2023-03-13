<?php

    // start the session
    session_start();

    $servername = "oceanus.cse.buffalo.edu:3306";
    $user = "mamuin";
    $password = "50424784";
    $dbname = "mamuin_db";
    
    
    // Get the user ID
    $uid = $_SESSION['username'];
    

    $conn = new mysqli($servername, $user, $password, $dbname);
    
    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // get the password entered by the user
    $password = $_POST['password'];
    
    // Query the database for the user's password
    $sql = "SELECT password FROM users WHERE username = '$uid'";
    $result = $conn->query($sql);
    
    // check if the query was successful
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];
    
        // ! check if the password matches
        if ($password == $stored_password) {
            // Delete the user's account and all associated data
            $sql = "DELETE FROM users WHERE username = '$uid'";
            if ($conn->query($sql) === TRUE) {
                // Logout the user and redirect to the signup page
                session_destroy();
                header("Location: successDeleteProf.html");
                exit;
            }
        } else {
            // Deletion failed because the password was incorrect
            echo "Invalid password.";
        }
    }

 
    // close the database connection
    $conn->close();

    ?>
    