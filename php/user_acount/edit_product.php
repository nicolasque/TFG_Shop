<?php 
include '../my_account.php';

function ft_get_product($product_id)
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
        return false;
    }
}

function ft_daw_product_edit($product_id)
{
    $product = ft_get_product($product_id);
    echo "<form action='edit_product.php' method='post'>";
    echo "<input type='hidden' name='product_id' value='{$product['product_id']}'>";
    echo "<label for='product_name'>Product Name:</label><br>";
    echo "<input type='text' name='product_name' value='{$product['product_name']}'><br>";
    echo "<label for='description'>Description:</label><br>";
    echo "<textarea name='description' rows='4' cols='50'>{$product['description']}</textarea><br>";
    echo "<label for='price'>Price:</label><br>";
    echo "<input type='text' name='price' value='{$product['price']}'><br>";
    echo "<input type='submit' value='Edit'>";
    echo "</form>";
}

function ft_edit_product($product_id, $product_name, $description, $price)
{
    $connexion = ft_create_conexion();
    $sql = "UPDATE product SET product_name = ?, description = ?, price = ? WHERE product_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("ssdi", $product_name, $description, $price, $product_id);
    $stmt->execute();
    $connexion->close();
    header('Location: ../my_account.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    ft_edit_product($product_id, $product_name, $description, $price);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
</head>
<body>
    <?php ft_daw_product_edit($_GET['product_id']); ?>
    <br>
    

</body>

