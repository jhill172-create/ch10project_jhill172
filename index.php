<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Ch10 Project - Contact Form</title>
    <!-- Link to stylesheet inside styles folder -->
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <h1>Ch10 Project - Contact Form</h1>
    <p>Author: J. Hill</p>
    <p>Date: <?php echo date('F j, Y'); ?></p>

    <!--
      Contact form:
      - Uses POST method
      - Action points to confirm.php
      - HTML5 validation attributes are present (required, type=email)
    -->
    <form action="confirm.php" method="POST" novalidate>
        <div>
            <label for="name">Name:</label><br>
            <input id="name" name="name" type="text" required placeholder="Your full name">
        </div>

        <div>
            <label for="email">Email:</label><br>
            <input id="email" name="email" type="email" required placeholder="you@example.com">
        </div>

        <div>
            <label for="message">Message:</label><br>
            <textarea id="message" name="message" rows="6" required placeholder="Your message..."></textarea>
        </div>

        <div>
            <input type="submit" value="Submit">
        </div>
    </form>
</body>
</html>
