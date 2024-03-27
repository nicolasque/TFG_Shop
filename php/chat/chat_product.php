<!-- Yo pondria la informaciion del producto al principo y debajo el propio chat  -->

<?php
include '../navbar.php';
include '../create_conexion.php';

function ft_get_product_info()
{
    $product_id = $_GET['product_id'];
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
        return false;
    }
}

function ft_print_table_product_info($product)
{
    echo "<table class='table table-bordered'>";
    echo "<tr>";
    echo "<th>Product Name</th>";
    echo "<td>" . $product['product_name'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Product Description</th>";
    echo "<td>" . $product['product_description'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Product Price</th>";
    echo "<td>" . $product['product_price'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Product Category</th>";
    echo "<td>" . $product['product_category'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Product Condition</th>";
    echo "<td>" . $product['product_condition'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Product Photos</th>";
    echo "<td>";
    $photos = ft_get_photos($product['product_photo_folder']);
    foreach ($photos as $photo)
    {
        echo "<img src='/tfg_shop/images/products/" . $product['product_photo_folder'] . "/" . $photo . "' class='img-thumbnail' width='200' height='200'>";
    }
    echo "</td>";
    echo "</tr>";
    echo "</table>";
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        ft_print_table_product_info(ft_get_product_info());
    ?>
</body>
</html>