<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Ch10 Project - Confirmation</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <h1>Ch10 Project - Contact Form</h1>
    <p>Author: J. Hill</p>
    <p>Date: <?php echo date('F j, Y'); ?></p>

<?php
// Check if the request method is POST to determine if the form was submitted.
// This prevents this page from showing confirmation when opened directly.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve form inputs from the $_POST superglobal
    // Use trim() to remove leading/trailing whitespace (sanitization step).
    $raw_name    = isset($_POST['name']) ? trim($_POST['name']) : '';
    $raw_email   = isset($_POST['email']) ? trim($_POST['email']) : '';
    $raw_message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Sanitize the email input to remove illegal characters.
    $sanitized_email = filter_var($raw_email, FILTER_SANITIZE_EMAIL);

    // Additional server-side validation:
    // - Check that none of the fields are empty
    // - Check that the sanitized email is a valid email format
    $errors = [];

    if ($raw_name === '') {
        $errors[] = "Name is required.";
    }

    if ($sanitized_email === '') {
        $errors[] = "Email is required.";
    } elseif (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if ($raw_message === '') {
        $errors[] = "Message is required.";
    }

    // Decide what message to show to the user
    if (!empty($errors)) {
        // If there are validation errors, join them and set the class to "error".
        $output_class = "error";
        $output_text = "There were problems with your submission:<br>" . implode("<br>", array_map('htmlspecialchars', $errors));
    } else {
        // Inputs are valid. Use htmlspecialchars when echoing back to avoid XSS.
        $output_class = "success";

        // Create a confirmation message using submitted values
        $safe_name = htmlspecialchars($raw_name, ENT_QUOTES, 'UTF-8');
        $safe_email = htmlspecialchars($sanitized_email, ENT_QUOTES, 'UTF-8');
        $safe_message = nl2br(htmlspecialchars($raw_message, ENT_QUOTES, 'UTF-8'));

        $output_text = "Thank you, {$safe_name}! Your message has been received.";
    }

    // Display the message inside a styled div and then echo submitted values below it.
    echo "<div class=\"output {$output_class}\">";
    echo $output_text;
    echo "</div>";

    // If valid, show the sanitized values. If invalid, show whatever user had entered (escaped).
    echo "<div class=\"submitted-data\">";
    echo "<h2>Submitted Information</h2>";
    echo "<p><strong>Name:</strong> " . (isset($safe_name) ? $safe_name : htmlspecialchars($raw_name, ENT_QUOTES, 'UTF-8')) . "</p>";
    echo "<p><strong>Email:</strong> " . (isset($safe_email) ? $safe_email : htmlspecialchars($raw_email, ENT_QUOTES, 'UTF-8')) . "</p>";
    echo "<p><strong>Message:</strong><br>" . (isset($safe_message) ? $safe_message : nl2br(htmlspecialchars($raw_message, ENT_QUOTES, 'UTF-8'))) . "</p>";
    echo "</div>";

} else {
    // If the page is opened without a POST, show a helpful message.
    echo "<div class=\"output error\">No form submission detected. Please go back and submit the form.</div>";
}
?>

</body>
</html>
