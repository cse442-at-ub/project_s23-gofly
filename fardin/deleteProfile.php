<?php
    require_once("config.php");
    // start the session
    session_start();

    // Get the user ID
    $uid = $_SESSION['username'];
    
    // get the password entered by the user
    $password = $_POST['password'];
    
    // Query the database for the user's password
    $sql = "SELECT password FROM users WHERE username = '$uid'";
    $result = $db_connection->query($sql);
    
    // check if the query was successful
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];
    
        // ! check if the password matches
        if (password_verify($password, $stored_password)) {
            // Delete the user's account and all associated data
            $sql = "DELETE FROM users WHERE username = '$uid'";
            if ($db_connection->query($sql) === TRUE) {
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
    $db_connection->close();

    ?>