<script src="../js/jquery.js"></script>
  <script src="js/login.js"></script>

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