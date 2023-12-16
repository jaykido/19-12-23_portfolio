<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: *");

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'josphatKe@outlook.com';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // Validate email address format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email address');
    }

    // Include PHP Email Form library
    $php_email_form = '../assets/vendor/php-email-form/php-email-form.php';
    if (file_exists($php_email_form)) {
        include($php_email_form);
    } else {
        die('Unable to load the "PHP Email Form" Library!');
    }

    // Create PHP Email Form object
    $contact = new PHP_Email_Form;
    $contact->ajax = true;

    // Set email parameters
    $contact->to = $receiving_email_address;
    $contact->from_name = $name;
    $contact->from_email = $email;
    $contact->subject = $subject;

    // Add message content
    $contact->add_message($name, 'From');
    $contact->add_message($email, 'Email');
    $contact->add_message($message, 'Message', 10);

    // Log data to the server error log
    // error_log("Received data from the form:");
    // error_log("Name: " . $name);
    // error_log("Email: " . $email);
    // error_log("Subject: " . $subject);
    // error_log("Message: " . $message);

    // Log the result of sending
    if ($contact->send()) {
        error_log("Email sent successfully");
        echo 'success'; // or any response you want to send to the client
    } else {
        error_log("Failed to send email");
        echo 'error'; // or any response you want to send to the client
    }
} else {
    // Handle cases where the form was not submitted using POST method
    echo 'Invalid form submission';
}
?>
