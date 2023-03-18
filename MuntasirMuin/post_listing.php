<?php
       session_start();
       require_once ("config.php");

       
       // Retrieve user data
       $username = $_SESSION['username'];
       $query = "SELECT * FROM users WHERE username = '$username'";
       $result = mysqli_query($db_connection, $query);
       $row = mysqli_fetch_assoc($result);

       if($_SERVER["REQUEST_METHOD"] == "POST") {
        $airline = mysqli_real_escape_string($db_connection, $_POST['airline']);
        $flight_number = mysqli_real_escape_string($db_connection, $_POST['flightnumber']);
        $departure = mysqli_real_escape_string($db_connection, $_POST['departure']);
        $arrival = mysqli_real_escape_string($db_connection, $_POST['arrival']);
        $date = mysqli_real_escape_string($db_connection, $_POST['date']);
        $time = mysqli_real_escape_string($db_connection, $_POST['time']);
        $duration = mysqli_real_escape_string($db_connection, $_POST['duration']);
        $price = mysqli_real_escape_string($db_connection, $_POST['price']);
        $seats = mysqli_real_escape_string($db_connection, $_POST['seats']);
        $class = mysqli_real_escape_string($db_connection, $_POST['fclass']);
        
        $query = "INSERT INTO flight_listings (airline, flight_number, departure, arrival, departure_date, departure_time, duration, price, seats, class) VALUES ('$airline', '$flight_number', '$departure', '$arrival', '$date', '$time', '$duration', '$price', '$seats', '$class')";
        mysqli_query($db_connection, $query);
        
        header("location: displaylist2.php");
        exit();
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
    <title>Edit Profile</title>
</head>
<body>
    <nav>
        <div class="logo">
            <h4><a href="landing.php">Gofly</a></h4>
        </div>
        <ul class="nav-links">
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
        <form method="post" class="form-3">
            <h2 style="font-size: 2rem; margin: 1%;">Post Flight Listing</h2> 
            
            <p>Airline Name</p>
            <input class="box" type="text" name="airline"required>
            
            <p>Flight Number</p>
            <input class="box" type="text" name="flightnumber"required>

            <label for="departure">Departure Airport:</label>
            <input class="box" type="text" id="departure" name="departure" required><br>

            <label for="arrival">Arrival Airport:</label>
            <input class= "box" type="text" id="arrival" name="arrival" required><br>

            <label for="date">Departure Date:</label>
            <input class= "box" type="date" id="date" name="date" required><br>

            <label for="time">Departure Time:</label>
            <input class ="box" type="time" id="time" name="time" required><br>

            <label for="duration">Duration:</label>
            <input class ="box" type="text" id="duration" name="duration" required><br>

            <label for="price">Price:</label>
            <input class ="box" type="number" id="price" name="price" required><br>

            <label for="seats">Available Seats:</label>
            <input class ="box" type="number" id="seats" name="seats" required><br>

            <label for="seats">Flight Class:</label>
            <input class ="box" type="text" id="seats" name="fclass" required><br>

            
            <input type="submit" value="Post Listing" id="submit">
        </form>
    </div>



    <script src="https://kit.fontawesome.com/fe66f9ddbe.js" crossorigin="anonymous"></script>
    <script src="land.js"></script>
    
</body>
</html>
