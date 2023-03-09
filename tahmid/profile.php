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
    <title>Edit Profile</title>
</head>
<body>
    <nav>
        <div class="logo">
            <h4><a href="landing.php">Gofly</a></h4>
        </div>
        <ul class="nav-links">
            <li><a href="landing.php">Home</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>

    <div class="container">
        <form action="editprofile.php" method="post" class="form-3">
            <h2 style="font-size: 2rem;">Edit Profile</h2>
            <?php
                if(isset($_SESSION['status'])){
                    echo $_SESSION['status'];
                    unset($_SESSION['status']);
                }
            ?>
            
            <p>FirstName</p>
            <input class="box" type="text" name="firstname" value= <?php echo $row['FirstName']; ?> required>
            <p>LastName</p>
            <input class="box" type="text" name="lastname" value= <?php echo $row['LastName']; ?> required>
            <p>Phone</p>
            <input class="box" type="tel" name="phone" value= <?php echo $row['PhoneNumber']; ?> required>
            
            <a class="fpwd" href="change_password.html"><u>Change Password</u></a>

            <input type="submit" value="Save" id="submit">
        </form>
    </div>

    <script src="land.js"></script>
    
</body>
</html>
