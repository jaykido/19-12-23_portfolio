<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: *");

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'josphatKe@outlook.com';

if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'];
$contact->from_email = $_POST['email'];
$contact->subject = $_POST['subject'];

// Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
/*
$contact->smtp = array(
  'host' => 'example.com',
  'username' => 'example',
  'password' => 'pass',
  'port' => '587'
);
*/

$contact->add_message($_POST['name'], 'From');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

// Log data to the server error log
error_log("Received data from the form:");
error_log("Name: " . $_POST['name']);
error_log("Email: " . $_POST['email']);
error_log("Subject: " . $_POST['subject']);
error_log("Message: " . $_POST['message']);

// Log the result of sending
if ($contact->send()) {
    error_log("Email sent successfully");
} else {
    error_log("Failed to send email");
}

echo $contact->send();
?>
