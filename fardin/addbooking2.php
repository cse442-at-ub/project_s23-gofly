<?php
        session_start();
        require_once ("config.php");
        if(isset($_POST['book_securely'])){
            // retrieve the ticket id from the form
            $ticket_id = $_POST['ticket_id'];

            // get the current user's username from the session
            $username = $_SESSION['username'];

            // connect to the database and insert the new row into the user_booking table

            $sql = "INSERT INTO user_booking (username, ticket_id) VALUES ('$username', '$ticket_id')";
            mysqli_query($db_connection, $sql);

            // redirect the user to the "My Bookings" page
            header("Location: my_booking.php");
            exit();
        }
        ?>