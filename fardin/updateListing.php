<?php 
session_start();
require_once('config.php');

//Check if the user is logged in.
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

//Check if the form has been submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $airline = mysqli_real_escape_string($db_connection, $_POST['airline']);
    $flight_number = mysqli_real_escape_string($db_connection, $_POST['flightnumber']);
    $departure = mysqli_real_escape_string($db_connection, $_POST['departure']);
    $arrival = mysqli_real_escape_string($db_connection, $_POST['arrival']);
    $date = mysqli_real_escape_string($db_connection, $_POST['date']);
    $time = mysqli_real_escape_string($db_connection, $_POST['time']);
    $duration = mysqli_real_escape_string($db_connection, $_POST['duration']);
    $price = mysqli_real_escape_string($db_connection, $_POST['price']);
    $seats = mysqli_real_escape_string($db_connection, $_POST['seats']);
    $class = mysqli_real_escape_string($db_connection, $_POST['fclass']);
        // Check if the Flight Number is in the database
        $sql = "SELECT * From flight_listings where flight_number = '$flight_number'";
        
        $result = $db_connection -> query($sql);
        if($result -> num_rows == 0){
            header("Location: editlistings.php");
            $_SESSION['status'] = "The Flight does not exist";
            exit();
        }
        
        
        $query = "UPDATE  flight_listings SET 
        airline = '$airline', 
        departure = '$departure', 
        arrival = '$arrival' , 
        departure_date = '$date', 
        departure_time ='$time', 
        duration = '$duration', 
        price = '$price', 
        seats = '$seats', 
        class = '$class' WHERE flight_number = '$flight_number'";
        
        if($db_connection->query($query) === TRUE){
            //Redirect to the display listing page
            header("Location: displaylist.php");
            exit();
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db_connection);
        }
        $db_connection->close();
        
        
    }
    
       ?>