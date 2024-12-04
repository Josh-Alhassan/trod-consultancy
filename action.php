<?php

// Write a code to send an email to the email address below with subject Enquiry

$from = $_POST['email'];
$phone = $_POST['phone'];
$comments = $_POST['comments'];
$name = $_POST['name'];

// Validate the input fields and sanitize

if (empty($from) || empty($phone) || empty($comments) || empty($name)) {
    echo "All fields are required";
    exit();
}

if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address";
    exit();
}

if (!preg_match("/^[0-9]{11}$/", $phone)) {
    echo "Invalid phone number";
    exit();
}

$from = filter_var($from, FILTER_SANITIZE_EMAIL);

$phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);

$comments = filter_var($comments, FILTER_SANITIZE_STRING);

$name = filter_var($name, FILTER_SANITIZE_STRING);

// Create an HTML Template with the input as placeholders

$template = "<html>
<head>
    <title>Contact Enquiry</title>
</head>
<body>
    <h1>Contact Enquiry</h1>
    <p>Name: $name</p>
    <p>Email: $from</p>
    <p>Phone: $phone</p>
    <p>Comments: $comments</p>
</body>
</html>";




$to = "info@trodconsulting.com";
$subject = "Contact Enquiry";
$message = "Hello, I am interested in your services. Please contact me.";
$headers = "From: $from" . "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

if (mail($to, $subject, $template, $headers)) {
    echo "Email sent successfully";
} else {
    echo "Email not sent";
}
