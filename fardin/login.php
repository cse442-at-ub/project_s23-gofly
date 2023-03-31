<?php
require_once('config.php');
// Establish database connection
session_start();


// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = mysqli_real_escape_string($db_connection, $_POST['uid']);
    $password = mysqli_real_escape_string($db_connection, $_POST['pwd']);

    

    // Query the database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($db_connection, $sql);


    // Check if the query returned any rows
    if (mysqli_num_rows($result) == 1) {
        // Get the user's data
        $user = mysqli_fetch_assoc($result);
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Login successfull
            
            $_SESSION['username'] = $username;
            header("Location: landing.php");
            exit;
        } else {
            // Login failed
            header("Location: login.php");
            $_SESSION['status'] = "Invalid username or password";
            exit();
            
        }
    } else {
        // Login failed
        header("Location: login.php");
        $_SESSION['status'] = "Invalid username or password";
        exit();

    }
}

mysqli_close($db_connection);

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
    <title>Login</title>
</head>
<body>
    <nav>
        <div class="logo">
            <h4><a href="landing2.html">Gofly</a></h4>
        </div>
        <ul class="nav-links">
            <li><a href="#">Reviews</a></li>
            <li><a href="signup.php">Register</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>

    <div class="container">
        <form action="login.php" method="post" class="form color-g">
            <h2>Login</h2>
            <p class="failed">
                <?php
                    if(isset($_SESSION['status'])){
                        echo $_SESSION['status'];
                        unset($_SESSION['status']);
                    }
                ?>
            </p>
            <input class="box" type="text" name="uid" placeholder="Username" required>
            <input class="box" type="password" name="pwd" placeholder="password" required>
            <a class="fpwd" href="forgotpwd.php"><u>Forgot Password?</u></a>
            <input type="submit" value="Login" id="submit">
            <p1 id="p-login"> Don't have a Account? <a href="signup.php"><u>Register</u></a></p1>
        </form>
        <div class="side">
            <img src="photos/bgpic1.png" alt="">
        </div>
    </div>

    <script src="land.js"></script>
    
</body>
</html>

