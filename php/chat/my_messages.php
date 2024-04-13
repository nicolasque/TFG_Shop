<?php
include '../navbar.php';
include '../create_conexion.php';

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
        return FALSE;
    }
}


function ft_get_my_chats($user_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM chat WHERE user_id_buyer = ? OR user_id_seller = ?";
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

function ft_get_other_perosn_name($user_id_buyer, $user_id_seller)
{
    if ($user_id_buyer == $_COOKIE['user_id'])
    {
        return ft_get_user_info($user_id_seller)['username'];
    }
    else
    {
        return ft_get_user_info($user_id_buyer)['username'];
    }
}

function ft_is_my_product($user_id_buyer)
{
    if ($user_id_buyer == $_COOKIE['user_id'])
    {
        return "has-background-info-light	"; 
    }
    else
    {
        return "has-background-success-light	";
    }
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
    if (file_exists($folder_path))
    {
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
    if (count($photos) > 0)
    {
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
        echo "<h3>" . ft_get_other_perosn_name($chat['user_id_buyer'], $chat['user_id_seller']) . "</h3>";
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
        .chats {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;

        }
        .chat {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 10px;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container chats">
        <?php
        $chats = ft_get_my_chats($_COOKIE['user_id']);
        if (count($chats) > 0)
        {
            echo "<div class='columns is-multiline'>"; // Creates multi-column layout
            foreach ($chats as $chat)
            {
                $product_class = ft_is_my_product($chat['user_id_buyer']);
                echo "<div class='box chat $product_class p-5 has-shadow is-flex is-align-items-center is-justify-content-space-between is-flex-direction-column'>"; // Box for styling
                echo "<a href='chat_product.php?product_id=" . $chat['product_id'] . "'>";
                echo "<div class=' p-3 mb-3'>";
                $product_name = ft_get_produc_info($chat['product_id']);
                echo "<h3 class='has-text-primary'>" . $product_name['product_name'] . "</h3>";
                echo "</div>";
                ft_print_photo($chat['product_id']);
                echo "</a>";
                echo "<h3 class='mt-3'>" . ft_get_other_perosn_name($chat['user_id_buyer'], $chat['user_id_seller']) . "</h3>";
                echo "</div>"; // Close chat box
            }
            echo "</div>"; // Close columns
        }
        else
        {
            echo "<p>You have no messages.</p>";
        }
        ?>
    </div>
</body>

</html>