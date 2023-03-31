<?php
       session_start();
       require_once ("config.php");
       require_once ("config.php");


       
       // Retrieve user data
       $username = $_SESSION['username'];
       $query = "SELECT * FROM users WHERE username = '$username'";
       $result = mysqli_query($db_connection, $query);
       $result = mysqli_query($db_connection, $query);
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
        <li><a href="displaylist.php">Listings</a></li>
        <li><a href="displaylist.php">Listings</a></li>
            <li><a href="#">Reviews</a></li>
            <li><a href="#">Contact Us</a></li>
            <li>
                <div class="dropdown">
                    <a href="#">
                    <i class="fa-solid fa-user"></i>
                    <?php
                        if(isset($_SESSION["username"])) {
                            $username = $_SESSION['username'];
                            echo "$username";
                        }
                    ?>
                    </a>
                <!-- dropdown for the user -->
                    <div class="dropdown-content">
                        <a href="post_listing.php">Post Listing</a>
                        <a class="fpwd" href="change_pass.php">Change Password</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>


            </li>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>

    <div class="container">
        <form action="editprofile.php" method="post" class="form-3">
            <h2 style="font-size: 2rem; margin: 1%;">Edit Profile</h2>
            <p class="sucess">
                <?php
                    if(isset($_SESSION['status'])){
                        echo $_SESSION['status'];
                        unset($_SESSION['status']);
                    }
                ?>
            </p>
            
            
            <p>FirstName</p>
            <input class="box" type="text" name="firstname" value= <?php echo $row['FirstName']; ?> required>
            <p>LastName</p>
            <input class="box" type="text" name="lastname" value= <?php echo $row['LastName']; ?> required>
            <p>Phone</p>
            <input class="box" type="number" name="phone" value= <?php echo $row['PhoneNumber']; ?> required>
            
            <input type="submit" value="Save" id="submit">
            <a class="btn-1" href="delete.php">Delete Account</a>
        </form>
    </div>



    <script src="https://kit.fontawesome.com/fe66f9ddbe.js" crossorigin="anonymous"></script>
    <script src="land.js"></script>
    
</body>
</html>
