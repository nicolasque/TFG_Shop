<link rel="stylesheet" href="../../css/navbar.css">

<?php
// Include your database connection code here
// include '../navbar.php';
include 'admin_header.php';


if (!isset($user_id) && !ft_is_admin())
{
    header('Location: /tfg_shop/php/index.php');
    exit;
}

function ft_get_products()
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM product";
    $result = $connexion->query($sql);
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
// Fetch all users from the database

function ft_get_product_owner($user_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT username FROM user WHERE user_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $connexion->close();
    return $row ? $row['username'] : NULL;
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

?>

<!DOCTYPE html>
<html>

<head>
    <title>Administrador de productos</title>
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
</head>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Administrador de productos</h1>
            <table class="table is-fullwidth is-striped">
                <thead>
                    <tr>
                        <th>Photos</th>
                        <th>Product</th>
                        <th>Username</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $products = ft_get_products();
                    foreach ($products as $product): ?>
                        <tr>
                        <td><?php ft_print_photo($product['photo']) ?></td>
                            <td><?php echo $product['product_name']; ?></td>
                            <td><?php echo ft_get_product_owner($product['user_id']); ?></td>
                            <td><?php echo $product['price']; ?>€</td>
                            <td><?php echo $product['description']; ?></td>
                            <td><a class="button is-small is-link"
                                    href="../user_acount/edit_product.php?product_id=<?php echo $product['product_id']; ?>">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>