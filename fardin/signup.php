<?php
require_once ("config.php");


// Check if the form is submitted
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     // Get the user input
     $user = filter_input(INPUT_POST, 'uid', FILTER_SANITIZE_STRING);
     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
     $password = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING);
     $FirstName = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
     $LastName = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
     $PhoneNumber = filter_input(INPUT_POST, 'num', FILTER_SANITIZE_STRING);
     $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : 'user';

    //Check the type of user;
    if($user_type == 'admin') {
        $secret_key = filter_input(INPUT_POST, 'admin_Key', FILTER_SANITIZE_STRING);
        if($secret_key != "goflyadmin"){
            header("Location: signup.php");
            $_SESSION['status'] = "Invalid key";
            exit();

        }
    }


     // Validate the user input (e.g. check for user's info is already in the database)
     $sql = "SELECT * FROM users WHERE email = '$email' OR username = '$user' OR phoneNumber = '$PhoneNumber'";
     $result = $db_connection->query($sql);
     if($result -> num_rows > 0){
        header("Location: signup.php");
        $_SESSION['status'] = "User Already Exists";
        exit();
     }
    //  // Hash the password for security
     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);



    // Insert the new user data into the database
    $sql = "INSERT INTO users (username, email, password, FirstName, LastName, PhoneNumber, user_type)
            VALUES ('$user', '$email', '$hashedPassword', '$FirstName', '$LastName', '$PhoneNumber', '$user_type')";
           

    if ($db_connection->query($sql) === TRUE) {
        // Redirect the user to the login page
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db_connection);
    }

    $db_connection->close();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="landing.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plaster&family=Poppins:wght@200&display=swap" rel="stylesheet">
    <title>signup</title>
</head>

<body>
    <nav>
        <div class="logo">
            <h4><a href="landing2.html">Gofly</a></h4>
        </div>
        <ul class="nav-links">
            <li><a href="#">Reviews</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>

    <div class="container-2">
        <form action="signup.php" method="post" class="form color-g">
            <h2>Register</h2>
            <p class="failed">
                <?php
                    if(isset($_SESSION['status'])){
                        echo $_SESSION['status'];
                        unset($_SESSION['status']);
                    }
                ?>
            </p>
            <div id="error-msg"></div>
            <input class="box" type="text" name="fname" placeholder="First Name" id='firstname' required>
            <input class="box" type="text" name="lname" placeholder="Last Name" id='lastname' required>
            <input class="box" type="tel" name="num" placeholder="Phone Number" id='pnum' required>
            <input class="box" type="text" name="uid" placeholder="Username" id='username' required>
            <input class="box" type="email" name="email" placeholder="Email" id='email' required>
            <input class="box" type="password" name="pwd" placeholder="password" id='password' required>


            <select class = "box" id="user_type" name = 'user_type' onchange="Div()">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            
            <div id="key" style="display: none">
                <input class ='box' type="password" name="admin_Key" placeholder="Secret key" id='admin_key' required>   
            </div>

            <input type="submit" value="Sign Up" id="submit">
            <p1 id="p-login">Already a member? <a href="login.php"><u>Login</u></a></p1>
        </form>


        <div class="side-2">
            <img src="photos/bgpic1.png" alt="">
        </div>
    </div>
    <script>
      function Div() {
         var Passport1 = document.getElementById("user_type");
         var dvPassport = document.getElementById("key");
         key.style.display = user_type.value == "admin" ? "block" : "none";
      };
    </script>

    <script src="land.js"></script>

</body>

</html>