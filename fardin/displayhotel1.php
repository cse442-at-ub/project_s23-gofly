<?php
session_start();

if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();

}

// // Check if the user is logged in and has the user type "admin"
// if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'user') {
//     // The user is not an admin, so redirect to regular users' landing page.
//     header('Location: admin_displaylist.php');
//     exit();
// }


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
    <link href="https://fonts.googleapis.com/css2?family=Plaster&family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="display.css">
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

    <div class="wel"> 
    <?php
        if(isset($_SESSION["username"])) {
            $username = $_SESSION['username'];
            echo "<h1>Welcome, $username!</h1>";
        }
    ?>
    </div>


    <style>
        .sort-dropdown {
        display: inline-block;
        margin: 10px;
        }

        .sort-label {
        font-size: 17px;
        font-weight: bold;
        color: white;
        font-family: 'Poppins', sans-serif;
        letter-spacing: 3px;
        }

        .select-container {
        position: relative;
        display: inline-block;
        }

        .sort-select {
        appearance: none;
        background-color: rgb(130, 111, 236);
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        font-weight: bold;
        letter-spacing: 3px;
        padding: 5px 10px;
        width: auto;
        }

        .select-container::after {
        content: "▼";
        color: white;
        font-size: 12px;
        position: absolute;
        right: 10px;
        top: 8px;
        }
    </style>
    <div class="sort-dropdown">
        <form action="sort_listing.php" method="post">
            <label for="sort" class="sort-label">Sort by:</label>
            <div class="select-container">
                <select name="sort" id="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="">Select</option>
                    <option value="price_high_low" <?= isset($_SESSION['selected_sort']) && $_SESSION['selected_sort'] == 'price_high_low' ? 'selected' : ''; ?>>Price High-Low</option>
                    <option value="price_low_high" <?= isset($_SESSION['selected_sort']) && $_SESSION['selected_sort'] == 'price_low_high' ? 'selected' : ''; ?>>Price Low-High</option>
                    <option value="duration" <?= isset($_SESSION['selected_sort']) && $_SESSION['selected_sort'] == 'duration' ? 'selected' : ''; ?>>Duration</option>
                    <option value="airline" <?= isset($_SESSION['selected_sort']) && $_SESSION['selected_sort'] == 'airline' ? 'selected' : ''; ?>>Airline</option>
                    <option value="destination" <?= isset($_SESSION['selected_sort']) && $_SESSION['selected_sort'] == 'destination' ? 'selected' : ''; ?>>Destination</option>
                </select>
            </div>


 
    <?php
	require_once("config.php");

	$limit = 5;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$offset = ($page - 1) * $limit;

    if (isset($_SESSION["sorted_listings"])) {
        $listings = $_SESSION["sorted_listings"];
    } else {
        $sql = "SELECT * FROM hotel_listings LIMIT $limit OFFSET $offset";
        $result = mysqli_query($db_connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            $listings = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            $listings = [];
        }
    }
    

	if (count($listings) > 0) {
		// output data of each row
		foreach ($listings as $row) {
			?>

<div class="hotel-listing">
		<div class="hotel-image">
        
        <?php
                        $image_data = $row["hotel_image"];
                        $encoded_image = base64_encode($image_data);
                        $image_src = "data:image/jpeg;base64," . $encoded_image;
                    ?>
                    <img src="<?php echo $image_src; ?>" alt="Hotel Image">
		</div>
		<div class="hotel-info">
			<h2><?php echo $row["hotel_name"]; ?></h2>
			<p><strong>Room type:</strong><?php echo $row["hotel_room"]; ?></p>
			<p><strong>City:</strong><?php echo $row["hotel_city"]; ?></p>
			<p><strong>Price per night:</strong><?php echo $row["hotel_price"]; ?></p>
			<!-- <button>Book Now</button> -->
            <a href="addbookinghotel.php?id=<?php echo $row['id']; ?>" style="width:60%;" class="btn-2">Book Now</a>

		</div>
	</div>

		<br>
        <?php
		}
        unset($_SESSION["sorted_listings"]); // Unset the sorted_listings session variable so that the next time the page is loaded, the listings are not sorted.

		// add pagination links
		$sql = "SELECT COUNT(*) AS count FROM flight_listings";
		$result = mysqli_query($db_connection, $sql);
		$row = mysqli_fetch_assoc($result);
		$count = $row['count'];
		$pages = ceil($count / $limit);
		if ($pages > 1) {
			?>
            <div class="pagination">
            <?php
			for ($i = 1; $i <= $pages; $i++) {
				if ($i == $page) {
					echo "<span class='current'>$i</span>";
				} else {
					echo "<a href='?page=$i'>$i</a>";
				}
			}
			?>
            </div>
            <?php
		}
	} else {
		echo "<p>No results found.</p>";
	}

	mysqli_close($db_connection);
?>

<style>
  .hotel-listing {
	background-color: #fff;
    width:800px;
    margin-left:5%;
    margin-top:10%;
    padding: 20px;
	box-shadow: 0px 0px 10px #ccc;
	display: flex;
    justify-content: left;
	align-items: center;
}

.hotel-image {
	width: 200px;
	height: 200px;
	margin-right: 20px;
}

.hotel-image img {
	width: 100%;
	height: 100%;
	object-fit: cover;
}

.hotel-info h2 {
	margin-top: 0;
	font-weight: bold;
	font-size: 24px;
	margin-bottom: 10px;
}

.hotel-info p {
	margin-bottom: 10px;
	font-size: 16px;
}

.hotel-info strong {
	font-weight: bold;
}

.hotel-info button {
	background-color: #008CBA;
	color: #fff;
	padding: 10px 20px;
	border: none;
	border-radius: 5px;
	cursor: pointer;
	font-size: 16px;
	margin-top: 10px;
}

.hotel-info button:hover {
	background-color: #004265;
}

</style>






    

    <script src="https://kit.fontawesome.com/fe66f9ddbe.js" crossorigin="anonymous"></script>
    <script src="land.js"></script>
</body>
</html>