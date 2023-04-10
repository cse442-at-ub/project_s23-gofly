<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $review_data = [
        'full_name' => $full_name,
        'rating' => $rating,
        'comment' => $comment,
    ];

    $reviews_file = 'reviews_data.txt';
    $existing_reviews = [];

    if (file_exists($reviews_file)) {
        $existing_reviews = json_decode(file_get_contents($reviews_file), true);
    }

    $existing_reviews[] = $review_data;
    file_put_contents($reviews_file, json_encode($existing_reviews));

    header('Location: reviews_list.php');
    exit;
}
?>
