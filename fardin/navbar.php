<nav>
    <div class="logo">
        <h4><a href="landing.php">Gofly</a></h4>
    </div>
    <ul class="nav-links">
        <li><a href="mybooking.php"><i class="fa-solid fa-suitcase-rolling fa-bounce" style="color: #f2f2f2;"></i>
                My Booking</a></li>
        <?php
        // Check if user is logged in and has a role
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];
            
            // Display different items based on the user's role
            if ($role === 'admin') {
                echo '<li><a href="postlisting.php">Post Listing</a></li>';
            } else if ($role === 'regular') {
                echo '<li><a href="displaylist.php">Listings</a></li>';
            }
        }
        ?>
        <li><a href="contact.php">Contact Us</a></li>

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
                    <a href="profile.php">My Profile</a>
                    <a href="reviews.php">Reviews</a>
                    <?php
                    // Check if user is logged in and has a role
                    if (isset($_SESSION['user_type'])) {
                        $role = $_SESSION['user_type'];
                        
                        // Display different items based on the user's role
                        if ($role === 'admin') {
                            echo '<a href="post_listing.php">Post Airline</a>';
                            echo '<a href="posthotel.php">Post Hotel</a>';
                        }
                    }
                    ?>
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
