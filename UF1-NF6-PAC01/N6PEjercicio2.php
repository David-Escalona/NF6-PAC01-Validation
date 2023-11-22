<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Validation</title>
    <style>
        /* Add background color to the header */
        header {
            background-color: #4CAF50;
            padding: 20px;
            color: white;
            text-align: center;
        }
    </style>
    <script>
        function validateEmail() {
            // Get the entered email value
            var email = document.getElementById("email").value;

            // Regular expression pattern for validating an email address
            var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            // Check if the email matches the pattern
            var isValid = pattern.test(email);

            // Display the validation result
            var validationMessage = document.getElementById("validationMessage");
            validationMessage.innerHTML = isValid ? "Valid email address" : "Invalid email address";
        }
    </script>
</head>
<body>

<header>
    <h1>Email Validation</h1>
</header>

<main>
    <!-- Add input for entering an email and display validation result -->
    <form method="post">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" oninput="validateEmail()">

        <p id="validationMessage"></p>
        <br><br>
        <input type="submit" value="Submit">
    </form>

    <?php
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and validate email from the form
        $email = $_POST["email"];
        $pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        if (preg_match($pattern, $email)) {
            echo "<p>Valid email address: $email</p>";
        } else {
            echo "<p>Invalid email address: $email</p>";
        }
    }
    ?>
</main>

</body>
</html>
