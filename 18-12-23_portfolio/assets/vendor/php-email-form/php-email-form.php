<?php

// $receiving_email_address = 'josphatKe@outlook.com';

// if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
//     include($php_email_form);
// } else {
//     die('Unable to load the "PHP Email Form" Library!');
// }

// $contact = new PHP_Email_Form;
// $contact->ajax = true;

// $contact->to = $receiving_email_address;
// $contact->from_name = $_POST['name'];
// $contact->from_email = $_POST['email'];
// $contact->subject = $_POST['subject'];

// Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
/*
$contact->smtp = array(
  'host' => 'example.com',
  'username' => 'example',
  'password' => 'pass',
  'port' => '587'
);
*/

// $contact->add_message($_POST['name'], 'From');
// $contact->add_message($_POST['email'], 'Email');
// $contact->add_message($_POST['message'], 'Message', 10);

// echo $contact->send();


/////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['submit'])) {
  // Replace with your actual email address
  $to = 'jaykidokenya@gmail.com';
  
  $subject = $_POST['subject'];
  $message = "Name: " . $_POST['name'] . "\r\n";
  $message .= "Email: " . $_POST['email'] . "\r\n";
  $message .= "Message: " . $_POST['message'];

  $headers = 'From: ' . $_POST['email'] . "\r\n" .
      'Reply-To: ' . $_POST['email'] . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

  if (mail($to, $subject, $message, $headers)) {
      echo 'success';
  } else {
      echo 'error';
  }
} else {
  echo 'Invalid request';
}
?>