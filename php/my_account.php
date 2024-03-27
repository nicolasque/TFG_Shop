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

function ft_get_user_products($user_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM product WHERE user_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $products[] = $row;
        }
    }
    $connexion->close();
    return $products;
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

function ft_get_photos($photo_folder)
{
    $photos = [];
    $folder_path = $_SERVER['DOCUMENT_ROOT'] . "/tfg_shop/images/products/" . $photo_folder;
    if (file_exists($folder_path)) {
        $files = scandir($folder_path);
        foreach ($files as $file)
        {
            if ($file != '.' && $file != '..')
            {
                $photos[] = $file;
            }
        }
    }
    return $photos;
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
        <li><a href="/tfg_shop/php/user_acount/edit_my_profile.php">Actualizar datos de perfil</a></li>
        <br>
        <li><a href="/tfg_shop/php/user_acount/my_products.php">Actualizar mis productos</a></li>
        <br>
        <li><a href="message_admin.php">Administrar mensajes</a></li>
        <!-- Add more buttons for other admin functionalities -->
    </ul>

</body>
</html>
