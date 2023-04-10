<?php
require_once("config.php");
    // Start the session
    session_start();
    
    // Check if the user is logged in
    if(!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }
    
    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve the form data
        $current_password = $_POST['cpwd'];
        $new_password = $_POST['newp'];
        $confirm_password = $_POST['cnewp'];

        //Get the username form the databse for this account
         $username = $_SESSION['username'];

        //Getting the user's password from the databse using bind;
        $stmt = $db_connection->prepare("SELECT password FROM users WHERE username = ?");
        $stmt -> bind_param('s', $username);
        $stmt -> execute();
        $result = $stmt -> get_result();
        $user = $result -> fetch_assoc();

        //If current password is equal to the one in the database
        if(!password_verify($current_password, $user['password'])){
            header("Location: change_pass.php");
            $_SESSION['status'] = "Incorrect current password";
            exit();
        }


        // Validate form data
        if ($new_password != $confirm_password) {
            header("Location: change_pass.php");
            $_SESSION['status'] = "New passwords do not match";
            exit();
        } 

        if(password_verify($new_password, $user['password'])){
            header("Location: change_pass.php");
            $_SESSION['status'] = "Cannot use previous passwords";
            exit();
        }
    
        else {

            $hasshedNewPassword = password_hash($new_password, PASSWORD_DEFAULT);
    
            
            $sql = "UPDATE users SET password='$hasshedNewPassword' WHERE username='$username'";
            
            if (mysqli_query($db_connection, $sql)) {
                // Redirect the user to the login page
                 header("Location: successpw.html");
                 exit;
            } else {
                $error = "Error updating password: " . mysqli_error($db_connection);
            }
            
            mysqli_close($db_connection);
        }
    }
?>