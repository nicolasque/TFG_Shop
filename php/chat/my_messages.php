<?php 
include '../navbar.php';
include '../create_conexion.php';

function ft_get_my_chats($user_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM chat WHERE user_id_1 = ? OR user_id_2 = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("ii", $user_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $chats = [];
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $chats[] = $row;
        }
    }
    $connexion->close();
    return $chats;
}

function ft_get_produc_info($product_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM product WHERE product_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product_name = $result->fetch_assoc();
    $connexion->close();
    return $product_name;
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

function ft_print_photo($product_id)
{
    $product = ft_get_produc_info($product_id);

    $photos = ft_get_photos($product['photo']);
    echo "<div class='image-gallery' id='product-{$product['product_id']}'>";
    if (count($photos) > 0) {
        echo "<img src='/tfg_shop/images/products/{$product['photo']}/{$photos[0]}' width='100px'>";
    }
    echo "</div>";
}

function ft_print_chats($chats)
{
    foreach ($chats as $chat)
    {
        echo "<div class='chat'>";
        echo "<a href='chat_product.php?product_id=" . $chat['product_id'] . "'>";
        $product_name = ft_get_produc_info($chat['product_id']);
        echo "<h3>" . $product_name['product_name'] . "</h3>";
        echo "<br>";

        echo "</a>";
        ft_print_photo($chat['product_id']);
        echo "</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My messages</title>
    <!-- <link rel="stylesheet" href="../css/my_messages.css"> -->
    <style>
        .chats
        {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }

        .chat
        {
            width: 80%;
            height: 100px;
            border: 1px solid black;
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .chat h3
        {
            margin: 0px;
        }
    </style>
</head>
<body>
    <div class="chats">
        <?php
        $chats = ft_get_my_chats($_COOKIE['user_id']);
        ft_print_chats($chats);
        ?>
    </div>
</body>
</html>
