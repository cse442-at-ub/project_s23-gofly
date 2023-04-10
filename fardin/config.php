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

$db_connection = new mysqli($servername, $username, $password, $dbname);

//Check conncection
if ($db_connection->connect_error) {
    die("Connection failed: " . $db_connection->connect_error);
}

?>