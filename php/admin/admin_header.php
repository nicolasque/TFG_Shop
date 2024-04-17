<?php
include '../create_conexion.php';
include '../navbar.php';


?>

<!DOCTYPE html>
<html>

<head>
    <title>Pagina de administrador</title>
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
    <h1>Bienvenido, Admin!</h1>

    <ul>
        <li><a href="user_admin.php">Administracion de usuarios</a></li>
        <br>
        <li><a href="product_admin.php">Administracion de productos</a></li>
        <br>
        <li><a href="user_messages.php">Mensajes al administrador</a></li>
        <!-- Add more buttons for other admin functionalities -->
    </ul>
</body>

</html>