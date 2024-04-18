<?php
// Include your database connection code here
// include '../navbar.php';
include '../my_account.php';

function ft_get_photo_folder($product_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT photo FROM product WHERE product_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $photo_folder = $row ? $row['photo'] : NULL;
    $connexion->close();
    return $photo_folder;
}

function ft_delete_photos($photo_folder)
{

    $folder_path = $_SERVER['DOCUMENT_ROOT'] . "/tfg_shop/images/products/" . $photo_folder;
    if (file_exists($folder_path))
    {
        $files = scandir($folder_path);
        foreach ($files as $file)
        {
            if ($file != '.' && $file != '..')
            {
                $file_path = $folder_path . '/' . $file;
                if (is_file($file_path))
                {
                    unlink($file_path);
                }
            }
        }
        rmdir($folder_path);
    }
}

function ft_delete_chat($product_id)
{
    $connexion = ft_create_conexion();
    $sql = "DELETE FROM chat WHERE product_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $connexion->close();
}


function ft_delete_product($product_id)
{
    $connexion = ft_create_conexion();
    $sql = "DELETE FROM product WHERE product_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $connexion->close();
    ft_delete_chat($product_id);
    ft_delete_photos(ft_get_photo_folder($product_id));
}


function ft_print_photo($photo_folder)
{
    $photos = ft_get_photos($photo_folder);
    echo "<div class='image-gallery' id='product-{$photo_folder}'>";
    if (!empty($photos))
    {
        echo "<img src='/tfg_shop/images/products/{$photo_folder}/{$photos[0]}' width='100px'>";
    }
    echo "</div>";
}

function ft_get_products_like($user_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT product_id FROM product_like WHERE user_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    while ($row = $result->fetch_assoc())
    {
        $products[] = $row;
    }
    $connexion->close();
    return $products;
}

function ft_print_products_like($liked_produc_id)
{
    foreach ($liked_produc_id as $product)
    {
        $product_info = ft_get_product($product['product_id']);
        $photo_folder = ft_get_photo_folder($product['product_id']);
        echo "<tr>";
        echo "<td>";
        ft_print_photo($photo_folder);
        echo "</td>";
        echo "<td>" . "<a href='../product/product.php?product_id=" .
            $product_info['product_id']. "'>" .
            "{$product_info['product_name']}</td>"
            . "</a>";
        echo "<td>{$product_info['description']}</td>";
        echo "<td>{$product_info['price']}</td>";

        echo "</tr>";
    }

}


$user_products = ft_get_user_products($user_id);

?>

<!DOCTYPE html>
<html>

<head>
    <title>My Products</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && is_numeric($_POST['product_id']))
    {
        ft_delete_product($_POST['product_id']);
        header('Location: /tfg_shop/php/user_acount/my_products.php');
    }
    ?>
</head>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title">My Products</h1>
            <table class="table is-fullwidth is-striped">
                <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>

                    </tr>
                </thead>
                <tbody>
                    <?php ft_print_products_like(ft_get_products_like($_COOKIE['user_id'])); ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php include '../footer.php'; ?>
</body>

</html>