<!DOCTYPE html>
<html>

<head>
    <title>Create User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <script src="../js/jquery.js"></script>
    <script src="../js/add_user_ft.js"></script>
</head>

<body>
    <?php
    include 'navbar.php';
    include 'create_conexion.php';
    ?>

    <section class="section">
        <div class="container">
            <h1 class="title">Create User</h1>
            <form method="POST" id="add_user_form" action="">

                <div class="field">
                    <label class="label" for="username">Username:</label>
                    <div class="control">
                        <input class="input" type="text" name="username" id="username" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="name">Name:</label>
                    <div class="control">
                        <input class="input" type="text" name="name" id="name" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="surname">Surname:</label>
                    <div class="control">
                        <input class="input" type="text" name="surname" id="surname" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="email">Email:</label>
                    <div class="control">
                        <input class="input" type="email" name="email" id="email" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="password">Password:</label>
                    <div class="control">
                        <input class="input" type="password" name="password" id="password" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="confirm_password">Confirm Password:</label>
                    <div class="control">
                        <input class="input" type="password" name="confirm_password" id="confirm_password" required>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <input class="button is-link" type="submit" value="Create User">
                    </div>
                </div>

            </form>
            <div id="message"></div>
            <!-- Esto es para hacer comprobaciones  -->
        </div>
    </section>

    <?php include 'footer.php'; ?>

</body>

</html>