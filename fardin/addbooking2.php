<?php
        session_start();
        require_once ("config.php");
        if(isset($_POST['book_securely'])){
            // retrieve the ticket id from the form
            $ticket_id = $_POST['ticket_id'];

            // get the current user's username from the session
            $username = $_SESSION['username'];

            // connect to the database and insert the new row into the user_booking table

            $sql = "INSERT INTO user_booking (username, ticket_id) VALUES ('?', '?')";
            $stmt = mysqli_prepare($db_connection, $sql);

            //Bind the parameters
            mysqli_stmt_bind_param($stmt, "si", $username, $ticket_id);
            if(mysqli_stmt_execute($stmt)){
                // redirect the user to the "My Bookings" page
            header("Location: my_booking.php");
            exit();

            } 
        //Closing the statement and the database
        mysqli_stmt_close($stmt);
        mysqli_close($db_connection);

        }
        ?>