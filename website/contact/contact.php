<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $message = trim($_POST["msg"]);

  if (empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    exit;
  }

  $recipient = "meetzemup.dev@gmail.com";

  $subject = "New MZU Contact Form";

  $email_content .= "Email: $email\n\n";
  $email_content .= "Message:\n$message\n";

  $email_headers = "From: <$email>";

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

