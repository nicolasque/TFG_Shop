<?php
// Include your database connection code here
// include '../navbar.php';
include '../account.php';

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

echo "<h1>My Products</h1>";

// Function print user products 

$user_products = ft_get_user_products($user_id);

foreach ($user_products as $product)
{
    echo "<div style='border: 1px solid black; margin: 10px; padding: 10px'>";
    echo "<h2>" . $product['product_name'] . "</h2>";
    echo "<p>" . $product['description'] . "</p>";
    echo "<p>" . $product['price'] . "€</p>";

    $photos = ft_get_photos($product['photo']);
        echo "<div class='image-gallery' id='product-{$product['product_id']}'>";
        foreach ($photos as $photo)
        {
            echo "<img src='/tfg_shop/images/products/{$product['photo']}/{$photo}' width='100px'>";
        }
        echo "</div>";

    echo "<a href='/tfg_shop/php/user_acount/edit_product.php?product_id=" . $product['product_id'] . "'>Edit</a>";
    echo "<a href='/tfg_shop/php/user_acount/delete_product.php?product_id=" . $product['product_id'] . "'>Delete</a>";
    echo "</div>";
}

?>