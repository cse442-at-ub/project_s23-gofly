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
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="landing.css">
    <title>Gofly</title>
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

    <div id="search-form">
    <section>
      <h2 class="header">Search Flights</h2>
      <div class="flight" id="flightbox">
        
        <form id="flight-form">
        <!-- TRIP TYPE -->
        <div id="flight-type">
          <div class="info-box">
            <input type="radio" name="flight-type" value="Return" id="return" checked />
            <label for="return"> RETURN</label>
          </div>
          <div class="info-box">
            <input type="radio" name="flight-type" value="Single" id="one-way" />
            <label for="one-way">ONE WAY</label>
          </div>
        </div>
        
        <!-- FROM/TO -->
        <div id="flight-depart">
          <div class="info-box">
            <label for="Origin">Origin</label>
            <select name="Origin">
              <option value="1">Select</option>
              <option value="2">JFK</option>
              <option value="3">DAC</option>
              <option value="4">SAF</option>
              <option value="5">BOS</option>
            </select>
          </div>
          <div class="info-box">
            <label for="Destination">Destination</label>
            <select name="Destination">
              <option value="1">Select</option>
              <option value="2">JFK</option>
              <option value="3">DAC</option>
              <option value="4">SAF</option>
              <option value="5">BOS</option>
            </select>
          </div>
        </div>
        
        <!-- FROM/TO -->
        <div id="flight-dates">
          <div class="info-box">
            <label for="">Departure</label>
            <input type="date" class="form-control" aria-describedby="return-date-label" />
          </div>
          
          <div class="info-box" id="return-box">
            <label for="">Arrival</label>
            <input type="date" class="form-control" aria-describedby="return-date-label" />
          </div>
        </div>
        
        <!-- PASSENGER INFO -->
        <div id="flight-info">
          <div class="info-box">
              <label for="adults">Adults</label>
              <select name="adults">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
              </select>
          </div>
          <div class="info-box">
              <label for="class-type">Class</label>
              <select name="class-type">
                  <option value="Economy">Economy</option>
                  <option value="Business">Business</option>
                  <option value="First">First Class</option>
              </select>
          </div>
      </div>

      
        <!-- SEARCH BUTTON -->
      <div id="flight-search">
        <div class="info-box">
          <input type="submit" id="search-flight" value="Search"/>
        </div>
      </div>
        
      </form> 
      </div>
    </section>
       
</div>

    <script src="https://kit.fontawesome.com/fe66f9ddbe.js" crossorigin="anonymous"></script>
    <script src="land.js"></script>
</body>
</html>