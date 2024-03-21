<?php

include 'navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the username and password are provided
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // TODO: Validate the username and password against your authentication system
        // For example, you can check against a database or an API

        // If the username and password are valid, redirect to the home page
        if ($username === 'admin' && $password === 'password') {
            header('Location: home.php');
            exit;
        } else {
            $error = 'Invalid username or password';
        }
    } else {
        $error = 'Please enter both username and password';
    }
}

?>

<!-- HTML code for the login form -->
<form method="POST" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br>

    <input type="submit" value="Login">
</form>

<?php
// Display the error message if there is any
if (isset($error)) {
    echo '<p>' . $error . '</p>';
}
?>