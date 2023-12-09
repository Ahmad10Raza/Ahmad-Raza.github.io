<?php

// Replace this with your own email address
$siteOwnersEmail = 'rjaahmad60@gmail.com';

if ($_POST) {

    $name = trim(stripslashes($_POST['contactName']));
    $email = trim(stripslashes($_POST['contactEmail']));
    $subject = trim(stripslashes($_POST['contactSubject']));
    $contact_message = trim(stripslashes($_POST['contactMessage']));

    // Validation
    $error = array();

    // Check Name
    if (strlen($name) < 2) {
        $error['name'] = "Please enter your name.";
    }

    // Check Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Please enter a valid email address.";
    }

    // Check Message
    if (strlen($contact_message) < 15) {
        $error['message'] = "Please enter your message. It should have at least 15 characters.";
    }

    // Subject
    if ($subject == '') {
        $subject = "Contact Form Submission";
    }

    if (empty($error)) {

        // Set Message
        $message = "Email from: " . $name . "<br />";
        $message .= "Email address: " . $email . "<br />";
        $message .= "Message: <br />";
        $message .= $contact_message;
        $message .= "<br /> ----- <br /> This email was sent from your site's contact form. <br />";

        // Set From: header
        $from =  $name . " <" . $email . ">";

        // Email Headers
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        // Send email
        $mail = mail($siteOwnersEmail, $subject, $message, $headers);

        if ($mail) {
            echo "OK";
        } else {
            echo "Something went wrong. Please try again later.";
        }

    } else {

        $response = '';
        $response .= (isset($error['name'])) ? $error['name'] . "<br /> \n" : '';
        $response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : '';
        $response .= (isset($error['message'])) ? $error['message'] . "<br />" : '';

        echo $response;

    }

} else {
    echo "Invalid request. Please try again.";
}
?>
