
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="search.scss">
    <link href="https://fonts.googleapis.com/css2?family=Plaster&family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="display.css">
    <title>Listings</title>
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
                        session_start();

                        if(isset($_SESSION["username"])) {
                            $username = $_SESSION['username'];
                            echo "$username";
                        }
                    ?>
                    </a>
                <!-- dropdown for the user -->
                    <div class="dropdown-content">
                        <a href="profile.php">My Profile</a>
                        <a href="post_listing.php">Post Listing</a>
                        <a class="fpwd" href="change_pass.php">Change Password</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </li>
        </ul>
        
        <!-- Create a burger for mobile view -->
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>

    <div class="wel"> 
    <?php
        if(isset($_SESSION["username"])) {
            $username = $_SESSION['username'];
            echo "<h1>Welcome, $username!</h1>";
        }
    ?>
    </div>



    <!-- Sort dropdown -->
    <div class="sort-dropdown">
        <form action="sort_listing.php" method="post">
            <label for="sort">Sort by:</label>
            <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="">Select</option>
                <option value="price_high_low" <?= isset($_SESSION['selected_sort']) && $_SESSION['selected_sort'] == 'price_high_low' ? 'selected' : ''; ?>>Price High-Low</option>
                <option value="price_low_high" <?= isset($_SESSION['selected_sort']) && $_SESSION['selected_sort'] == 'price_low_high' ? 'selected' : ''; ?>>Price Low-High</option>
                <option value="duration" <?= isset($_SESSION['selected_sort']) && $_SESSION['selected_sort'] == 'duration' ? 'selected' : ''; ?>>Duration</option>
                <option value="airline" <?= isset($_SESSION['selected_sort']) && $_SESSION['selected_sort'] == 'airline' ? 'selected' : ''; ?>>Airline</option>
                <option value="destination" <?= isset($_SESSION['selected_sort']) && $_SESSION['selected_sort'] == 'destination' ? 'selected' : ''; ?>>Destination</option>
            </select>
        </form>
    </div>



 
<?php
    require_once("config.php");


    if (isset($_SESSION["sorted_listings"])) {
        $result_array = $_SESSION["sorted_listings"];
        unset($_SESSION["sorted_listings"]);
    } else {
        $sql = "SELECT * FROM flight_listings";
        $result = mysqli_query($db_connection, $sql);
        $result_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    if (count($result_array) > 0) {
        // output data of each row
        foreach($result_array as $row) {
?>
            <div class="container">
                <div class="box">
                    <ul class="left">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>

                    <ul class="right">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <div class="ticket">
                        <span class="airline"><?php echo $row["airline"]; ?></span>
                        <span class="airline airlineslip">Price</span>
                        <div class="content">
                            <span class="logo-1">
                                <img src="photos/lufthansa.svg"></span>
                            <span class="jfk"><?php echo $row["departure"]; ?></span>
                            <span class="plane">
                                <!-- Include the plane SVG here -->
                            </span>
                            <span class="sfo"><?php echo $row["arrival"]; ?></span>

                            <span style="align-items: center;" class="plane price">
                                <h1><?php echo "USD" . " " . $row["price"]; ?></h1>
                            </span>
                            <div class="sub-content">
                                <span class="watermark"><?php echo $row["airline"]; ?></span>
                                <span class="name">BOARDING TIME<span>
                                        <br>
                                            <span><?php echo $row["departure_date"] . " " . $row["departure_time"]; ?></span>
                                        </span>
                                    </span>

                                <span class="gate">FLIGHT N&deg;<br>
                                        <span><?php echo $row["flight_number"]; ?></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php
        }
    } else {
        echo "<p>No results found.</p>";
    }

    mysqli_close($db_connection);
?>

       





    

    <script src="https://kit.fontawesome.com/fe66f9ddbe.js" crossorigin="anonymous"></script>
    <script src="land.js"></script>
</body>
</html>