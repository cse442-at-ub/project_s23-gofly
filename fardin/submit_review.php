<?php
require_once("config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $stmt = $db_connection->prepare("INSERT INTO reviews (full_name, rating, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $full_name, $rating, $comment);

    if ($stmt->execute()) {
        header("Location: reviews.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $db_connection->close();
}
?>
