<?php
include 'create_conexion.php';
include 'navbar.php';

// Get user_id from cookie
$user_id = $_COOKIE['user_id'];

// If yhe user is not loged in go to index.php
if (!isset($user_id))
{
    header('Location: index.php');
    exit;
}

function ft_get_user_info($user_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM user WHERE user_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $connexion->close();
        return $row;
    }
    else
    {
        $connexion->close();
        return false;
    }
}

 $user_info = ft_get_user_info($user_id);
?>
<!DOCTYPE html>
<html>
<head>
  <title>My Account</title>
  <style>
    /* Add your CSS styles here */
  </style>
</head>

<body>
<h1>Welcome, <?php echo $user_info['username']?>!</h1>
    
    <ul>
        <li><a href="/tfg_shop/php/user_acount/my_profile.php">User Administration</a></li>
        <li><a href="/tfg_shop/php/user_acount/my_products.php">Product Administration</a></li>
        <li><a href="message_admin.php">Message Administration</a></li>
        <!-- Add more buttons for other admin functionalities -->
    </ul>

</body>
</html>
