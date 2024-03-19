

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>

</head>
<body>
    <?php
        include 'navbar.php';
        include 'ajax/create_conexion.php';
        include 'functions/db_functions.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $username = $_POST['username'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // TODO: Validate and sanitize the form data

            // Insert the data into the database
            $query = "INSERT INTO users (username, surname, email, password) VALUES ('$username', '$surname', '$email', '$password')";
            $result = mysqli_query($connection, $query);

            if ($result) {
                echo "User created successfully!";
            } else {
                echo "Error creating user: " . mysqli_error($connection);
            }
        }
    ?>
        
        <h1>Create User</h1>
        <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="surname">Surname:</label>
        <input type="text" name="surname" id="surname" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
    
        <input type="submit" value="Create User">
    </form>
</body>
</html>