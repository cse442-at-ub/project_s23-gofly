<?php
       session_start();

       // Establish database connection
       $servername = "oceanus.cse.buffalo.edu:3306";
       $username = "mamuin";
       $password = "50424784";
       $dbname = "mamuin_db";
       $conn = mysqli_connect($servername, $username, $password, $dbname);
       
       // Retrieve user data
       $username = $_SESSION['username'];
       $query = "SELECT * FROM users WHERE username = '$username'";
       $result = mysqli_query($conn, $query);
       $row = mysqli_fetch_assoc($result);
       
       // Display user data
       echo "Welcome, " . $row['username'] . "!<br>";
       echo "Your email address is: " . $row['email'] . "<br>";
       echo "Your First Name is: " . $row['FirstName'] . "<br>";
       echo "Your Last Name: " . $row['LastName'] . "<br>";
       echo "Your phone number is: " . $row['PhoneNumber'] . "<br>";
       ?>
        