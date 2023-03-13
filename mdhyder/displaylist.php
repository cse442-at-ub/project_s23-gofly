
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="landing.css">
    <title>Gofly</title>
    <!-- <style>
      .listing-container {
        display: grid;
        
        justify-content: space-between;
        
        
      }
      .listing-item {
        text-align: Center;
        width:500px;
        height: 400px;
        background-color: #f5f5f5;
        margin-bottom: 20px;
        padding: 20px;
        box-sizing: border-box;
        border-style: outset;
      }
      .listing-item img {
        width: 100%;
        height: auto;
      }
      .listing-item h2 {
        font-size: 20px;
        margin-top: 10px;
      }
      .listing-item p {
        font-size: 14px;
        margin-top: 10px;
      }
      .listing-item span {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin-top: 10px;
      }
    </style> -->
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
            echo "<h1>Welcome, Bitch!</h1>";
        }
        ?>
    </div>
    <!-- <div class="listing-container">
      <div class="listing-item">
        <img src="item1.jpg" alt="Item 1">
        <h2>Item 1</h2>
        <p>Description of Item 1.</p>
        <span>$19.99</span>
      </div>
      <div class="listing-item">
        <img src="item2.jpg" alt="Item 2">
        <h2>Item 2</h2>
        <p>Description of Item 2.</p>
        <span>$29.99</span>
      </div>
      <div class="listing-item">
        <img src="item3.jpg" alt="Item 3">
        <h2>Item 3</h2>
        <p>Description of Item 3.</p>
        <span>$39.99</span>
      </div>
    </div> -->

<!-- Travel Search Bar using bootsstrap and javascript-->
<div class="searchbar">
    <div class="container-sm">
        <div class="my-2 card">
            <div class="card-body">
        <h5 class="card-title">Search Flights</h5>
        <div class="row">
          <div class="col-sm">
            <div class="mb-2">
              <label id="origin-label" for="origin-input" class="form-label">Origin</label>
              <label id="destination-label" for="destination-input" class="form-label">Destination</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi-pin-map"></i> </span>
                <input type="text" class="form-control" list="origin-options" id="origin-input" placeholder="Origin"
                  aria-describedby="origin-label" />
                <datalist id="origin-options"></datalist>
                <span class="input-group-text"><i class="bi-pin-map-fill"></i> </span>
                <input type="text" class="form-control" list="destination-options" id="destination-input"
                  placeholder="Destination" aria-describedby="destination-label" />
                <datalist id="destination-options"></datalist>
                <select id="flight-type-select" class="form-select" aria-describedby="flight-type-label">
                  <option value="one-way">One-way</option>
                  <option value="round-trip">Round-trip</option>
                </select>
                <!--Destination -->
              </div>
              <div class="mb-2">
                <div id="departure-date"></div>
                <div id="return-date"></div>
                <div id="return-date" class="mb-2">
                  <label id="return-date-label" for="return-date-input" class="form-label">Return date</label>
                  <label id="departure-date-label" for="departure-date-input" class="form-label">Departure
                    date</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi-calendar-fill"></i> </span>
                    <input type="date" class="form-control" id="return-date-input"
                      aria-describedby="return-date-label" />
                    <span class="input-group-text"><i class="bi-calendar"></i></span>
                    <input type="date" class="form-control" id="departure-date-input"
                      aria-describedby="departure-date-label" />
                    <div id="departure-date" class="mb-2">
                    </div>
                  </div>
                </div>

                <div class="input-group">
                  <label id="travel-class-label" for="travel-class-select" class="form-label">Travel class</label>
                </div>
                <div class="input-group">
                  <select class="form-select" id="travel-class-select" aria-describedby="travel-class-label">
                    <option value="ECONOMY">Economy</option>
                    <option value="PREMIUM_ECONOMY">Premium Economy</option>
                    <option value="BUSINESS">Business</option>
                    <option value="FIRST">First</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="passenger-type">Passenger Type</label>
                  <select class="form-control" id="passenger-type" onchange="resetPassengerCount()">
                    <option id="adult-count" value="adult">0 Adult</option>
                    <option id="child-count" value="child">0 Child</option>
                    <option id="infant-count" value="infant">0 Infant</option>
                  </select>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="passenger-count">Passenger Count</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <button class="btn btn-outline-secondary" type="button"
                        onclick="decrementPassengerCount()">-</button>
                    </div>
                    <input class="form-control" id="passenger-count" type="number" min="0" max="10" value="0" readonly>
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button"
                        onclick="incrementPassengerCount()">+</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <p>Total: <span id="total-count">0</span> Passenger(s)</p>
            </div>
          </div>
        </div>

        <button id="search-button" class="w-100 btn btn-primary">
          Search
        </button>
      </div>
    </div>
  </div>
  <!-- .. End of Search bar. -->











    <script src="https://kit.fontawesome.com/fe66f9ddbe.js" crossorigin="anonymous"></script>
    <script src="land.js"></script>
</body>
</html>