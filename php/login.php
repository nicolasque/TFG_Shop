
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <script src="../js/jquery.js"></script>
    <script src="../js/login.js"></script>
</head>
<body>
    <?php 
        include 'navbar.php';
        include 'functions/db_functions.php';
    ?>

    <!-- HTML code for the login form -->
    <form method="POST" id="login_form" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" value="Login">

    </form>

    <div id="error"></div>


</body>
</html>
