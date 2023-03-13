<?php
require_once ("config.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     // Get the user input
     $user = $_POST['uid'];
     $email = $_POST['email'];
     $password = $_POST['pwd'];
     $FirstName = $_POST['fname'];
     $LastName = $_POST['lname'];
     $PhoneNumber = $_POST['num'];
 
     // Validate the user input (e.g. check for user's info is already in the database)
     $sql = "SELECT * FROM users WHERE email = '$email' OR username = '$username' OR phoneNumber = '$PhoneNumber'";
     $result = $db_connection->query($sql);
     if($result -> num_rows > 0){
        echo "The user already exists";
        exit();
     }
    //  // Hash the password for security
     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    // Insert the new user data into the database
    $sql = "INSERT INTO users (username, email, password, FirstName, LastName, PhoneNumber)
            VALUES ('$user', '$email', '$hashedPassword', '$FirstName', '$LastName', '$PhoneNumber')";

    if ($db_connection->query($sql) === TRUE) {
        // Redirect the user to the login page
        header("Location: login.html");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db_connection);
    }

    $db_connection->close();


}

?>