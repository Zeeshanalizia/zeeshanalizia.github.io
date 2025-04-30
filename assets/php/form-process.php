<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Optional fields (in case you add them later)
    $phone   = isset($_POST["phone_number"]) ? trim($_POST["phone_number"]) : '';
    $subject = isset($_POST["subject"]) ? trim($_POST["subject"]) : 'New Contact Form Submission';

    // Recipient email
    $to = "zeeshanalizia@gmail.com";

    // Email headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Email content
    $email_body = "You have received a new message from your website contact form:\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n";
    if ($phone) {
        $email_body .= "Phone: $phone\n";
    }
    if ($subject) {
        $email_body .= "Subject: $subject\n";
    }
    $email_body .= "Message:\n$message\n";

    // Send the email
    if (mail($to, $subject, $email_body, $headers)) {
        echo "success";
    } else {
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }
} else {
    // Not a POST request
    echo "Invalid request.";
}
