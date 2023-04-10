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

    <script src="https://kit.fontawesome.com/fe66f9ddbe.js" crossorigin="anonymous"></script>
    <script src="land.js"></script>
</body>
</html>