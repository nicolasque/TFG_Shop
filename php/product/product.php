<?php
include '../navbar.php';
include '../create_conexion.php';

function ft_get_product_info($product_id)
{

    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM product WHERE product_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $product_id);
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

function ft_get_seller_name($seller_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM user WHERE user_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $seller_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $connexion->close();
    return $row['username'];
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

function ft_print_photos($row)
{
    $photos = ft_get_photos($row['photo']);
    if (count($photos) > 1)
    {
        echo "<div class='image-gallery' id='product-gallery-{$row['product_id']}'>";
        foreach ($photos as $index => $photo)
        {
            $display = $index == 0 ? 'block' : 'none';
            echo "<img class='gallery-image' style='display: {$display};' src='/tfg_shop/images/products/{$row['photo']}/{$photo}' width='100px'>";
        }
        echo "<button class='prev button is-link is-outlined' style='position: absolute; top: 50%; left: 0;'><-</button>";
        echo "<button class='next button is-link is-outlined' style='position: absolute; top: 50%; right: 0;'>-></button>";
        echo "</div>";
    }
    else
    {
        echo "<div class='image-gallery' id='product-gallery-{$row['product_id']}'>";
        echo "<img class='gallery-image' src='/tfg_shop/images/products/{$row['photo']}/{$photos[0]}' width='100px'>";
        echo "</div>";
    }
}


function ft_print_product()
{
    $product_id = $_GET['product_id'];
    $product_info = ft_get_product_info($product_id);
    if ($product_info)
    {
        echo "<div class='box'>";
        echo "<div class='media'>";
        echo "<div class='media-left'>";
        ft_print_photos($product_info);
        echo "</div>";
        echo "<div class='media-content'>";
        echo "<p class='title is-4'>" . $product_info['product_name'] . "</p>";
        echo "<p class='subtitle is-6'>Seller: " . ft_get_seller_name($product_info['user_id']) . "</p>";
        echo "<p>Price: " . $product_info['price'] . "€</p>";
        echo "<p>Description: " . $product_info['description'] . "</p>";
        if ($product_info['city'] != "")
        {
            echo "<p>City: " . $product_info['city'] . "</p>";
        }
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
    else
    {
        echo "<h1 class='title'>Product not found</h1>";
    }
}




function ft_is_not_my_product($product_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM product WHERE product_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        if (!isset($_COOKIE['user_id']))
        {
            echo "<a href='/tfg_shop/php/login.php'>LogIn to start chating</a>";
            return TRUE;
        }
        if ($row['user_id'] != $_COOKIE['user_id'])
        {
            echo "<a class='button is-primary' href='/tfg_shop/php/chat/chat_product.php?product_id=" . $_GET['product_id'] . "'>Chat</a>";
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    else
    {
        return FALSE;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../../js/jquery.js"></script>
    <script src="../../js/js_products_page.js"></script>
    <style>
        .image-gallery {
            width: 150px;
            height: 150px;
            position: relative;
        }

        .gallery-image {
            position: absolute;
            max-width: 85%;
            max-height: 85%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
        }
    </style>

</head>

<body>
    <?php
    ft_print_product();
    ft_is_not_my_product($_GET['product_id']);
    ?>


</body>

</html>