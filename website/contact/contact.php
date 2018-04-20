<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $message = trim($_POST["message"]);

  if (empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    exit;
  }

  $recipient = "martin.pras@epitech.eu";

  $subject = "New contact form";

  $email_content .= "Email: $email\n\n";
  $email_content .= "Message:\n$message\n";

  $email_headers = "From: $name <$email>";

  if (mail($recipient, $subject, $email_content, $email_headers)) {
    http_response_code(200);
  }
  else {
    http_response_code(500);
  }

}
else {
  http_response_code(403);
}

