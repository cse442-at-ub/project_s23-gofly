<!DOCTYPE html>
<html>
<head>
	<title>Hotel Listings</title>
	<style>
		/* Add some basic styles for readability */
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		.container {
			width: 80%;
			margin: 0 auto;
			padding: 20px;
		}
		h1 {
			margin-top: 0;
		}
		.hotel {
			margin-bottom: 20px;
			padding: 20px;
			border: 1px solid #ddd;
		}
		.hotel img {
			max-width: 60%;
			height: auto;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Hotel Listings</h1>
		<?php
			// Connect to database
			require_once("config.php");
			
			// Retrieve hotels from database
			$sql = "SELECT * FROM hotel_listings";
			$result = $db_connection->query($sql);

			// Display each hotel
			while($row = $result->fetch_assoc()) {
				$name = $row["hotel_name"];
				$description = $row["hotel_description"];
				$address = $row["hotel_address"];
				$city = $row["hotel_city"];
				$zipcode = $row["hotel_zipcode"];
				$room = $row["hotel_room"];
				$price = $row["hotel_price"];
				$image = $row["hotel_image"];
				$id = $row["id"];

				// Output HTML to display hotel information
				echo "<div class='hotel'>";
				echo "<h2>$name</h2>";
				echo "<img src='data:image/jpeg;base64,".base64_encode($image)."'/>";
				echo "<p><strong>Description:</strong> $description</p>";
				echo "<p><strong>Address:</strong> $address, $city $zipcode</p>";
				echo "<p><strong>Room type:</strong> $room</p>";
				echo "<p><strong>Price:</strong> $price</p>";
				echo "</div>";
			}

			// Close database connection
			$db_connection->close();
		?>
	</div>
</body>
</html>
