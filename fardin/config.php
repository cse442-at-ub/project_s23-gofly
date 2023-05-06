<?php
global $db_connection;

// if ($_SERVER['HTTPS'] !== 'on') {
//     header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
//     exit();
// }

//Connect to the databse using mysqli
$servername = "oceanus.cse.buffalo.edu:3306";
$username = "mdhyder";
$password = "50313569";
$dbname = "cse442_2023_spring_team_y_db";

define('SENDGRID_API_KEY', "SG.Go3WsEFDQt-YiWo81L9mcQ.LQRRZ9SztycbtHrQXz2m1SLlaEU1-Gaoz4IU1SW3ozQ");



$db_connection = new mysqli($servername, $username, $password, $dbname);

//Check conncection
if ($db_connection->connect_error) {
    die("Connection failed: " . $db_connection->connect_error);
}

?>