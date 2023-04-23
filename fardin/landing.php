<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $errors = '';
  
  // Check if required fields are filled in
  if (empty($_POST['Origin']) || empty($_POST['Destination']) || empty($_POST['Departure']) || empty($_POST['class-type']))  {
    $errors = 'Please fill in all the fields';
  }
  else{
  session_start(); // start the session
  $_SESSION['Origin'] = $_POST['Origin']; // store Origin in session
  $_SESSION['Destination'] = $_POST['Destination']; // store Destination in session
  $_SESSION['Departure'] = $_POST['Departure']; // store Departure in session
  $_SESSION['class-type'] = $_POST['class-type']; // store Departure in session

  header('Location: display2.php');
  exit;
}
}
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
    <link rel="stylesheet" href="landingstyle.css">
    <title>Gofly</title>
</head>
<body>






    <div id="slide-form2" class="crossfade">
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
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
        <!-- .................Search Bar................................. -->
        <div id="search-form">
            <section>
                <h2 class="header">Search Flights</h2>
                <div class="flight" id="flightbox">
                <?php if (!empty($errors)): ?>
                <p class="error" style="color: red;"><?php echo $errors; ?></p>
                <?php endif; ?>

                    <form id="flight-form" method="post" action="">
                        <!-- TRIP TYPE -->
                        <div id="flight-type">
                            <div class="info-box">
                                <!-- <input
                                    type="radio"
                                    name="flight-type"
                                    value="Return"
                                    id="return"
                                    checked="checked"/>
                                <label for="return">
                                    RETURN</label> -->
                            </div>
                            <div class="info-box">
                                <input type="radio" name="flight-type" value="Single" id="one-way"/>
                                <label for="one-way">ONE WAY</label>
                            </div>
                        </div>

                        <!-- FROM/TO -->
                        <div id="flight-depart">
                            <div class="info-box">
                                <label for="Origin">Origin</label>
                                <select name="Origin" Placeholder="Select" >
                                    <option value="JFK">JFK</option>
                                    <option value="DAC">DAC</option>
                                    <option value="SAF">SAF</option>
                                    <option value="BOS">BOS</option>
                                </select>
                            </div>
                            <div class="info-box">
                                <label for="Destination">Destination</label>
                                <select name="Destination" Placeholder="Select" >
                                    <option value="JFK">JFK</option>
                                    <option value="DAC">DAC</option>
                                    <option value="SAF">SAF</option>
                                    <option value="BOS">BOS</option>
                                    <option value="BUF">BUF</option>
                                </select>
                            </div>
                        </div>

                        <!-- FROM/TO -->
                        <div id="flight-dates">
                            <div class="info-box">
                                <label for="">Departure</label>
                                <input
                                    class="date-box"
                                    type="date"
                                    name="Departure"
                                    class="form-control"
                                    aria-describedby="return-date-label"/>
                            </div>

                            <!-- <div  class="info-box" id="return-box">
                                <label for="">Arrival</label>
                                <input
                                    class="date-box"
                                    type="date"
                                    name="Arrival"
                                    aria-describedby="return-date-label" required/>
                            </div> -->
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
                                <input type="submit" id="search-flight" name="search-flight" value="Search"/>
                                <p class="failed"> 
                                    <?php 
                                        if(isset($_SESSION['status'])){ 
                                            echo $_SESSION['status']; 
                                            unset($_SESSION['status']); 
                                        } 
                                    ?> </p>
                    
                            </div>
                        </div>
                    </form>

                </div>
            </section>
        </div>
    </div>





<!-- ticket display -->
<div class="second-part">
<h1>
  Discover the World 
</h1>

<section class="cards">
<article class="card card--1">


  <div class="card__img"></div>
  <a href="#" class="card_link">
     <div class="card__img--hover"></div>
   </a>
  <div class="card__info">
    <span class="card__category"> Travel</span>
    <h3 class="card__title">Discover the sea</h3>
    <span class="card__by">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, beatae sint maiores dolore, cumque quidem nihil nostrum est impedit iste architecto, laborum aperiam. Odit eum praesentium aliquid quibusdam facilis maxime.</span>
  </div>
</article>
  
  
<article class="card card--2">

    

  <div class="card__img"></div>
  <a href="#" class="card_link">
     <div class="card__img--hover"></div>
   </a>
  <div class="card__info">
    <span class="card__category"> Travel</span>
    <h3 class="card__title">Discover the sea</h3>
    <span class="card__by">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, iste tenetur? Nam, corporis exercitationem nemo nesciunt earum tenetur fugit dolorem debitis dolor inventore consequatur dolore id esse suscipit temporibus minus.</span>
  </div>
</article>  
<article class="card card--3">
  <div class="card__img"></div>
  <a href="#" class="card_link">
     <div class="card__img--hover"></div>
   </a>
  <div class="card__info">
    <span class="card__category"> Travel</span>
    <h3 class="card__title">Discover the sea</h3>
    <span class="card__by">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, iste tenetur? Nam, corporis exercitationem nemo nesciunt earum tenetur fugit dolorem debitis dolor inventore consequatur dolore id esse suscipit temporibus minus.</span>
  </div>
</article>  
</section>

</div>














<!-- foooter -->


  <footer class="site-footer">
      <div class="container">
          <div class="row">
          <div class="logo">
            <h6 style="text-align:center; margin-bottom:20px;"><a href="landing.php">Gofly</a></h6>
          </div>

                  <div class="col-md-4 col-sm-6 col-xs-12">
                    
                      <ul class="social-icons">

                          <li>
                              <a class="facebook" href="#">
                                  <i class="fa fa-facebook"></i>
                              </a>
                          </li>
                          <li>
                              <a class="twitter" href="#">
                                  <i class="fa fa-twitter"></i>
                              </a>
                          </li>
                          <li>
                              <a class="dribbble" href="#">
                                  <i class="fa fa-dribbble"></i>
                              </a>
                          </li>
                          <li>
                              <a class="linkedin" href="#">
                                  <i class="fa fa-linkedin"></i>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </footer>

    <script src="https://kit.fontawesome.com/fe66f9ddbe.js" crossorigin="anonymous"></script>
    <script src="land.js"></script>
</body>
</html>