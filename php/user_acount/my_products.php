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
    $photo_folder = $row ? $row['photo'] : null;
    $connexion->close();
    return $photo_folder;
}

function ft_delete_photos($photo_folder)
{

    $folder_path = $_SERVER['DOCUMENT_ROOT'] . "/tfg_shop/images/products/" . $photo_folder;
    if (file_exists($folder_path)) {
        $files = scandir($folder_path);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $file_path = $folder_path . '/' . $file;
                if (is_file($file_path)) {
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

function ft_print_products()
{
    $products = ft_get_products();
    echo "<table id='col'>";
    echo "<tr>";
    echo "<th>Product Name</th>";
    echo "<th>Description</th>";
    echo "<th>Price</th>";
    echo "<th>Photos</th>";
    echo "</tr>";
    foreach ($products as $product)
    {
        echo "<tr>";
        echo "<td>" . $product['product_name'] . "</td>";
        echo "<td>" . $product['description'] . "</td>";
        echo "<td>" . $product['price'] . "€</td>";
        echo "<td>";
        $photos = ft_get_photos($product['photo']);
        echo "<div class='image-gallery' id='product-{$product['product_id']}'>";
        foreach ($photos as $photo)
        {
            echo "<img src='/tfg_shop/images/products/{$product['photo']}/{$photo}' width='100px'>";
        }
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
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
        th, td {
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
    <h1>My Products</h1>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Photos</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($user_products as $product): ?>
            <tr>
                <td><?php echo $product['product_name']; ?></td>
                <td><?php echo $product['description']; ?></td>
                <td><?php echo $product['price']; ?>€</td>
                <td>
                    <?php
                    $photos = ft_get_photos($product['photo']);
                    echo "<div class='image-gallery' id='product-{$product['product_id']}'>";
                    foreach ($photos as $photo)
                    {
                        echo "<img src='/tfg_shop/images/products/{$product['photo']}/{$photo}' width='100px'>";
                    }
                    echo "</div>";
                    ?>
                </td>
                <td>
                    <a  class="button is-primary" href="/tfg_shop/php/user_acount/edit_product.php?product_id=<?php echo $product['product_id']; ?>">Edit</a>
                    <a class="button is-danger is-dark" href="/tfg_shop/php/user_acount/delete_product.php?product_id=<?php echo $product['product_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

    <?php include '../footer.php'; ?> 
