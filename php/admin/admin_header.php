<?php
include '../create_conexion.php';
include '../navbar.php';


?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <?php
    if (!isset($user_id) && !ft_is_admin())
    {
        header('Location: /tfg_shop/php/index.php');
        exit;
    }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    <h1>Welcome, Admin!</h1>
    
    <ul>
        <li><a href="user_admin.php">User Administration</a></li>
        <li><a href="product_admin.php">Product Administration</a></li>
        <li><a href="message_admin.php">Message Administration</a></li>
        <!-- Add more buttons for other admin functionalities -->
    </ul>
</body>
</html>