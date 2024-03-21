<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <script src="../js/jquery.js"></script>
    <script src="../js/add_user_ft.js"></script>
</head>
<body>
    <?php
        include 'navbar.php';
        include 'create_conexion.php';
    ?>
        
        <h1>Create User</h1>
        <form method="POST" id="add_user_form" action="">

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="surname">Surname:</label>
        <input type="text" name="surname" id="surname" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
    
        <label for="password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required><br>

        <input type="submit" value="Create User" al>
    
    </form>
    <div id="message"></div> 
    <!-- Esto es para hacer comprobaciones  -->
</body>
</html>