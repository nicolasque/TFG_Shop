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

    <!-- <form method="POST" id="login_form" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" value="Login">

    </form>

    <div id="error"></div> -->


    <div class="container is-max-desktop">
        <div class="notification is-primary">
            <form method="POST" id="login_form" action="">

                <div class="field">
                    <p class="control has-icons-left has-icons-right">
                        <input id="username" class="input" type="text" placeholder="Username" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <p class="control has-icons-left">
                        <input type="password" class="input" name="password" id="password" placeholder="Password"
                            required><br>
                        <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <p class="control">
                        <input type="submit" class="button is-primary is-dark" value="Login">
                    </p>
                </div>
            </form>
        </div>
    </div>


</body>
<?php include 'footer.php'; ?>

</html>