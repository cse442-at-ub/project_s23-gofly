<?php
session_start();
require_once ("config.php");

// Check if the user is logged in.
// If not, redirect them to the login page.
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Retrieve the records from the user_booking table based on the current user's username
$sql = "SELECT * FROM user_booking WHERE user='$username'";
$result = $db_connection->query($sql);

// Create an empty array to store ticket IDs
$ticket_ids = array();

// Loop through the records and add the ticket IDs to the array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ticket_ids[] = $row["ticket_id"];
    }
} else {
    echo "<p>No tickets found for $username</p>";
}

// Loop through the ticket IDs and retrieve the corresponding flight data
foreach ($ticket_ids as $ticket_id) {
    // Retrieve the flight data based on the ticket ID
    $sql = "SELECT * FROM flight_listings WHERE id='$ticket_id'";
    $result = $db_connection->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="search.css">
    <link href="https://fonts.googleapis.com/css2?family=Plaster&family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="display.css">
    <link rel="stylesheet" href="addbook.css">
    <link rel="stylesheet" href="book.css" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>Listings</title>
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

    <h1 class="header">
    <?php
        if(isset($_SESSION["username"])) {
            $username = $_SESSION['username'];
            echo "$username's Booking";
        }
    ?>
    </h1>
    
    <div class="container2">
    
    <?php
    // Display the flight data
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
<div class="ticket">
	<div class="left">
		<div class="image">
			<p class="admit-one">
				<span>TICKET</span>
				<span>TICKET</span>
				<span>TICKET</span>
			</p>
			<div class="ticket-number">
				<p>
                <?php  echo $row["flight_number"];?>
				</p>
			</div>
		</div>
		<div class="ticket-info">
			<p class="date">
				<span>TUESDAY</span>
				<span class="june-29">JUNE 29TH</span>
				<span>2021</span>
			</p>
			<div class="show-name">
            <?php  echo  $row["airline"];?>
				
				<h2>  <?php  echo $row["departure"];?>
                <span><svg
                                clip-rule="evenodd"
                                fill-rule="evenodd"
                                height="60"
                                width="60"
                                image-rendering="optimizeQuality"
                                shape-rendering="geometricPrecision"
                                text-rendering="geometricPrecision"
                                viewBox="0 0 500 500"
                                xmlns="http://www.w3.org/2000/svg">
                                <g stroke="#222">
                                    <line
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-width="30"
                                        x1="300"
                                        x2="55"
                                        y1="390"
                                        y2="390"/>
                                    <path
                                        d="M98 325c-9 10 10 16 25 6l311-156c24-17 35-25 42-50 2-15-46-11-78-7-15 1-34 10-42 16l-56 35 1-1-169-31c-14-3-24-5-37-1-10 5-18 10-27 18l122 72c4 3 5 7 1 9l-44 27-75-15c-10-2-18-4-28 0-8 4-14 9-20 15l74 63z"
                                        fill="#222"
                                        stroke-linejoin="round"
                                        stroke-width="10"/>
                                </g>
                            </svg> <?php  echo $row["arrival"];?></h2>
                            
                        </span>
			</div>
			<div class="time">
				<p><?php  echo $row["departure_date"];?></</p>
				<p><?php  echo $row["departure_time"];?></p>
			</div>

		</div>
	</div>
	<div class="right">

			<div class="barcode">
				<img src="https://external-preview.redd.it/cg8k976AV52mDvDb5jDVJABPrSZ3tpi1aXhPjgcDTbw.png?auto=webp&s=1c205ba303c1fa0370b813ea83b9e1bddb7215eb" alt="QR code">
			</div>
		</div>
	</div>
</div>
       <?php  echo "<p>Airline: " . $row["airline"] . "</p>";?>
        <!-- echo "<p>Flight Number: " . $row["flight_number"] . "</p>";
        echo "<p>Departure: " . $row["departure"] . "</p>";
        echo "<p>Arrival: " . $row["arrival"] . "</p>";
        echo "<p>Departure Date: " . $row["departure_date"] . "</p>";
        echo "<p>Departure Time: " . $row["departure_time"] . "</p>";
        echo "<p>Duration: " . $row["duration"] . "</p>";
        echo "<p>Price: " . $row["price"] . "</p>";
        echo "<p>Seats: " . $row["seats"] . "</p>";
        echo "<p>Class: " . $row["class"] . "</p>"; -->
    <?php
    } else {
        echo "<p>No flight data found for ticket ID $ticket_id</p>";
    }
    }

    $db_connection->close();
    ?>

    </div>

    <script src="https://kit.fontawesome.com/fe66f9ddbe.js" crossorigin="anonymous"></script>
    <script src="land.js"></script>  
   
</body>
</html>