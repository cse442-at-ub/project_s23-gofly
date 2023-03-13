<?php
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
        
        // Validate form data
        if ($new_password != $confirm_password) {
            $error = "New passwords do not match";
        } else {
            // Connect to database
            $servername = "oceanus.cse.buffalo.edu:3306";
            $username = "mamuin";
            $password = "50424784";
            $dbname = "mamuin_db";
          
            
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            // Update password in database
            $username = $_SESSION['username'];
            
            $sql = "UPDATE users SET password='$new_password' WHERE username='$username' AND password='$current_password'";
            
            if (mysqli_query($conn, $sql)) {
                // Redirect the user to the login page
                 header("Location: successpw.html");
                 exit;
            } else {
                $error = "Error updating password: " . mysqli_error($conn);
            }
            
            mysqli_close($conn);
        }
    }
?>