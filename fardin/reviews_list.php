<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="landing.css">
    <link rel="stylesheet" href="reviews_list.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plaster&family=Poppins:wght@200&display=swap" rel="stylesheet">
    <title>Reviews List</title>
</head>
<body>
    <nav>
        <div class="logo">
            <h4><a href="landing2.html">Gofly</a></h4>
        </div>
        <ul class="nav-links">
            <li><a href="reviews.php">Reviews</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="signup.php">Register</a></li>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>

    <div class="container">
        <h2>Reviews</h2>
        <div class="reviews-container">
            <?php
            $filename = 'reviews_data.txt';
            if (file_exists($filename)) {
                $json_data = file_get_contents($filename);
                $reviews = json_decode($json_data, true);
                if (count($reviews) > 0) {
                    foreach ($reviews as $review) {
                        $full_name = $review['full_name'];
                        $rating = $review['rating'];
                        $comment = $review['comment'];
            ?>
            <div class="review-container">
                <div class="review">
                <h3><?php echo htmlspecialchars($full_name); ?></h3>
                    <div class="rating">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            echo $i <= $rating ? '&#9733;' : '&#9734;';
                        }
                        ?>
                    </div>
                    <p><?php echo htmlspecialchars($comment); ?></p>
                </div>
            </div>
            <?php
                    }
                } else {
                    echo '<p>No reviews found.</p>';
                }
            } else {
                echo '<p>No reviews found.</p>';
            }
            ?>
        </div>
    </div>

</body>
</html>

