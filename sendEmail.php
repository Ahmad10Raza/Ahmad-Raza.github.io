<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $to = "rjaahmad60@gmail.com";
    $subject = "New Contact Form Submission";
    $headers = "From: $email";

    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Message:\n$message";

    mail($to, $subject, $email_message, $headers);

    echo "Thank you for your message! We'll get back to you soon.";
} else {
    echo "Invalid request method.";
}
?>
