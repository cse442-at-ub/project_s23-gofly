<?php
    // Connect to database
    require_once("config.php");

    // Retrieve hotel from database based on hotel_id parameter
    $hotel_id = $_GET['id'];
    $sql = "SELECT * FROM hotel_listings WHERE id = ?";
    $stmt = $db_connection->prepare($sql);
    $stmt->bind_param("i", $hotel_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display hotel information
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["hotel_name"];
        $description = $row["hotel_description"];
        $address = $row["hotel_address"];
        $city = $row["hotel_city"];
        $zipcode = $row["hotel_zipcode"];
        $room = $row["hotel_room"];
        $price = $row["hotel_price"];
        $image = $row["hotel_image"];
        $id = $row["id"];

     
    }

    // Close database connection
    $stmt->close();
    $db_connection->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Details</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <h1><?php echo $name ?></h1>
    </header>
    
    <main>
      <section class="room-details">
        <h2><?php echo $room ?></h2>
        <div class="room-images">
    <?php
      $room_images = json_decode($row["room_image"], true);
      foreach ($room_images as $image) {
        echo "<img src='data:image/jpeg;base64," . $image . "' alt='Room Image' />";
      }
    ?>
  </div>
        <p class="hotel-description">
        <h3>Description: </h3>
        <?php echo $description ?>
        
        

        </p>

        <div class="address">

        </div>
        <div class="amenities">
          <h3>Amenities</h3>
          <div class="amenity">
            <img class="amenity-icon" src="photos/wifi.jpg" alt="Amenity Icon">
            <div class="amenity-label">Free Wifi</div>
          </div>
          <div class="amenity">
            <img class="amenity-icon" src="photos/swim.jpg" alt="Amenity Icon">
            <div class="amenity-label">Swimming Pool</div>
          </div>
          <div class="amenity">
            <img class="amenity-icon" src="photos/gym.png" alt="Amenity Icon">
            <div class="amenity-label">Fitness Center</div>
          </div>
          <div class="amenity">
            <img class="amenity-icon" src="photos/desk.png" alt="Amenity Icon">
            <div class="amenity-label">24-Hour Front Desk</div>
          </div>
        </div>
        <div class="price">
        <h3>Address</h3>
          <p><?php echo $address ?></p>
          <p><?php echo $city . ", " . $zipcode; ?></p>
          <h3>Price</h3>
          <div class="price-label">Price per night:</div>
          <div class="price-amount"><?php echo $price ?></div>
          <a href="addbookinghotel.php?id=hotel<?php echo $row['id']; ?>" style="width:45%;" class="btn-2">Book Now</a>
        </div>
      </section>
    </main>
  </body>
</html>

<style>
    /* Global styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
}

/* Header styles */
header {
  background-color: #333;
  color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
}

h1 {
  font-size: 28px;
}

nav a {
  color: #fff;
  text-decoration: none;
  margin-left: 10px;
}

/* Main content styles */
main {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

.room-details {
  display: flex;
  flex-wrap: wrap;
}

.room-details h2 {
  font-size: 24px;
  margin-bottom: 20px;
  width: 100%;
}

.room-images {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.room-images img {
  max-width: 32%;
}

.hotel-description {
  margin-bottom: 30px;
}

.address {
    margin-top: 20px;
  width: 50%;
}

.address h3 {
  font-size: 20px;
  margin-bottom: 10px;
}

.address p {
  margin-bottom: 5px;
}

.amenities {
  width: 50%;
}

.amenities h3 {
  font-size: 20px;
  margin-bottom: 10px;
}

.amenity {
  display: flex;
  margin-bottom: 5px;
}

.amenity-icon {
  width: 50px;
  height: 50px;
  margin-right: 10px;
}

.price {
  margin-top: 20px;
}

.price h3 {
  font-size: 20px;
  margin-bottom: 10px;
}

.price-label {
  font-size: 18px;
  margin-right: 10px;
}

.price-amount {                  
    font-size: 28px;
    font-weight: bold;
    margin-left: 200px;
}

button {
  background-color: #333;
  color: #fff;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

button:hover {
  background-color: #555;
}



    </style>

	
