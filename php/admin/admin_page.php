<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <?php include '../navbar.php'; 
    if (!isset($user_id) && !ft_is_admin())
    {
        header('Location: /tfg_shop/php/index.php');
        exit;
    }
    ?>

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