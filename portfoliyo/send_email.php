<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $to = "dybeyaadarsh221305@gmail.com"; // Your email address
    $subject = "Contact Form Submission from $name";
    $headers = "From: $email";
    $message = "Name: $name\nEmail: $email\n\n$message";

    mail($to, $subject, $message, $headers);
}
?>
