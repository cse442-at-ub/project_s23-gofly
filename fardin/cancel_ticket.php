<?php
session_start();
require_once ("config.php");


// Check if the user is logged in.
// If not, redirect them to the login page.
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}



//Get the ticket ID from the query parameter.
$ticket_id = $_GET['ticket_id'];



// Get the current ticket information from the database
$stmt = mysqli_prepare($db_connection, "SELECT * FROM user_booking WHERE ticket_id=?");

//binding the type of parameter
mysqli_stmt_bind_param($stmt, "i", $ticket_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$ticket = mysqli_fetch_assoc($result);

$id = $ticket['id'];
$user = $ticket['user'];
$ticketID = $ticket['ticket_id'];


        
$sql = mysqli_prepare($db_connection, "DELETE FROM user_booking WHERE ticket_id = ?");
mysqli_stmt_bind_param($sql, "i", $ticketID);
mysqli_stmt_execute($sql);

//Check if the ticket was deleted
if(mysqli_stmt_affected_rows($sql) > 0){
    header("Location: mybooking.php");
    exit();
} 



mysqli_stmt_close($stmt);
mysqli_stmt_close($sql);
$db_connection->close();

?>