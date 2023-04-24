<?php
require_once("config.php");
session_start();

if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();

}

// Check if the user is logged in and has the user type "admin"
if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    // The user is not an admin, so redirect to regular users' landing page.
    header('Location: displayhotel1.php');
    exit();
}


var_dump($_GET);
//Get the ticket ID from the query parameter.
$hotel_id = $_GET['id'];


// Get the current ticket information from the database
$stmt = mysqli_prepare($db_connection, "SELECT * FROM hotel_listings WHERE id=?");

//binding the type of parameter
mysqli_stmt_bind_param($stmt, "i", $hotel_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$ticket = mysqli_fetch_assoc($result);

$hotelName = $ticket['hotel_name'];
$hotelAddress = $ticket['hotel_address'];
$hotelCity = $ticket['hotel_city'];
$hotelZipcode = $ticket['hotel_zipcode'];
$hotel_room = $ticket['hotel_room'];
$hotel_description = $ticket['hotel_description'];
$hotel_price = $ticket['hotel_price'];
$hotel_image = $ticket['hotel_image'];


mysqli_close($db_connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="post.css">
    <link rel="stylesheet" href="landing.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plaster&family=Poppins:wght@200&display=swap" rel="stylesheet">
    <title>Edit Listings</title>
</head>

<body>
    <?php 
    // Check the session status
    $status = session_status();

    if ($status === PHP_SESSION_ACTIVE) {
        // Session is active
        include_once 'navbar.php';
    } else {
        session_start();
        // Session is not active
        include_once 'navbar.php';

    }
        
    ?>


    <div class="container">
    <form method="post" action="updateHotelListing.php?id=<?php echo $hotel_id ?>">
          <h2>Edit Hotel Listing</h2>
            <p class="failed">
                <?php
                if(isset($_SESSION['status'])){
                    echo $_SESSION['status'];
                    unset($_SESSION['status']);
                }
            ?>
            </p>


            <section class="child">
                <p>Hotel Name:</p>
                <!-- <input type="hidden" name="id" value="<?php echo $hotel_id; ?>"> -->
                <input list="air-name-lists" class="box" type="text" name="hotel_name" value="<?php echo $hotelName; ?>"
                    required>
                <datalist id="air-name-lists">
                    <option>Four Seasons</option>
                    <option>Marriott Internation Hotel</option>
                    <option>Hilton WorldWide Hotels</option>
                    <option>Hyatt Hotels Coropration</option>
                </datalist>

                <p>Hotel Address:</p>
                <input class="box" type="text" name="hotel_address" value="<?php echo $hotelAddress; ?>">

                <p><label for="zipcode">Hotel Zipcode:</label></p>
                <input list="hotels" class="box" type="number" id="zipcode" name="hotel_zipcode"
                    value="<?php echo $hotelZipcode; ?>" maxlength="5" required><br>

                <p><label for="description">Description:</label></p>
                <textarea id="description" name="hotel_description" value="<?php echo $hotel_description; ?>"
                    required></textarea>



            </section>
            <section class="child">
                <p><label for="price">Price:</label></p>
                <input class="box" type="number" id="price" name="hotel_price" value="<?php echo $hotel_price; ?>"
                    required><br>


                <p><label for="seats">Hotel Room:</label></p>
                <select class="box" id="room" name="hotel_room" value="<?php echo $hotel_room; ?>">
                    <option value="Single">Single</option>
                    <option value="Double">Double</option>
                    <option value="King">King</option>
                    <option value="Queen">Queen</option>
                    <option value="Suite">Suite</option>

                </select>







            </section>





            <input type="submit" value="Save Listing" id="submit">
            <a class="btn-4" href="admin_hotelDisplay.php">Cancel</a>

        </form>


    </div>



    <script src="https://kit.fontawesome.com/fe66f9ddbe.js" crossorigin="anonymous"></script>
    <script src="land.js"></script>

</body>

</html>