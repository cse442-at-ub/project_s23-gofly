<?php
require_once('config.php');
session_start();

if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();

}

// Check if the user is logged in and has the user type "admin"
if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    // The user is not an admin, so redirect to regular users' landing page.
    header('Location: displayhotel1.php');
    exit();
}

$hotel_id = $_GET['id'];




//Check if the form has been submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // $hotel_id = myali_real_escape_string($db_connection, $_POST['id']);
    $hotelName = mysqli_real_escape_string($db_connection, $_POST['hotel_name']);
    $hotelAddress =mysqli_real_escape_string($db_connection, $_POST['hotel_address']);
    $hotelZipcode =mysqli_real_escape_string($db_connection, $_POST['hotel_zipcode']);
    $hotel_room = mysqli_real_escape_string($db_connection, $_POST['hotel_room']);
    $hotel_description =mysqli_real_escape_string($db_connection, $_POST['hotel_description']);
    $hotel_price = mysqli_real_escape_string($db_connection, $_POST['hotel_price']);


    if(empty($_POST['hotel_name']) || empty($_POST['hotel_address']) || empty($_POST['hotel_zipcode']) || empty($_POST['hotel_description']) || empty($_POST['hotel_price'])){
        $_SESSION['status'] = "All fields are required";
        $_SESSION['form_data'] = $_POST;
        header("Location: errormessage.php");
        exit();
    }

    $stmt = $db_connection->prepare("SELECT * FROM hotel_listings WHERE id = ?");
    $stmt->bind_param("i", $hotel_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        header("Location: admin_editHotel.php");
        $_SESSION['status'] = "The Hotel does not exist";
        exit();
    }

    $query = "UPDATE hotel_listings SET
    hotel_name = '$hotelName',
    hotel_address = '$hotelAddress',
    hotel_zipcode = '$hotelZipcode',
    hotel_room = '$hotel_room',
    hotel_description = '$hotel_description',
    hotel_price = '$hotel_price' WHERE id = '$hotel_id'";
    
    
    if($db_connection->query($query) === TRUE){
        //Redirect to the display listing page
        header("Location: admin_hotelDisplay.php");
        exit();
    }
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db_connection);
    }
    $db_connection->close();
    
    
}


?>
