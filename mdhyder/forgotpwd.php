<?php
require_once "vendor/autoload.php";

use SendGrid\Mail\Mail;

// Connect to SQL database
// Connect to the database (replace with your own database credentials)
$servername = "oceanus.cse.buffalo.edu:3306";
$username = "mamuin";
$password = "50424784";
$dbname = "mamuin_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if (isset($_POST['email'])) {
    // Get the username from the form
    $username = $_POST['email'];

    // Generate a unique token for the password reset link
    $token = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);


    // Save the token and expiration time in the database
    $sql = "UPDATE users SET reset_token='$token' WHERE email='$username'";
    
    mysqli_query($conn, $sql);

    // Construct the password reset link
    $reset_link = "http://localhost/GoflyPractice/fardin/reset_password.php";

    // Set up the email message
    $email = new Mail();
    $email->setFrom("jkace0252@gmail.com", "GoFly");
    $email->setSubject("Password reset request for Example");
    $email->addTo($username);
    $email->addContent(
        "text/html",
        "<p>Hello,</p><p>We have received a request to reset the password for your Example account. Please copy and paste the following token into the reset password page: <strong>$token</strong></p><p>Alternatively, you can click the link below to reset your password:</p><p><a href='$reset_link'>$reset_link</a></p>"
    );

    // Send the email using SendGrid API
    $sendgrid = new \SendGrid('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');
    try {
        $response = $sendgrid->send($email);
        echo "An email has been sent to your email address with instructions on how to reset your password.";
    } catch (Exception $e) {
        echo "Error sending email: " . $e->getMessage();
    }
}
?>