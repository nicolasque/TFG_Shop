<?php
include '../my_account.php';



function ft_daw_product_edit($product_id)
{
    $product = ft_get_product($product_id);
    echo "<div class='section'>";
    echo "<div class='container'>";
    echo "<div class='columns is-centered'>";
    echo "<div class='column is-half'>";
    echo "<form action='' method='post'>";
    echo "<input type='hidden' name='product_id' value='{$product['product_id']}'>";
    echo "<div class='field'>";
    echo "<label class='label' for='product_name'>Nombre:</label>";
    echo "<div class='control'>";
    echo "<input class='input' type='text' name='product_name' value='{$product['product_name']}'>";
    echo "</div></div>";
    echo "<div class='field'>";
    echo "<label class='label' for='description'>Description:</label>";
    echo "<div class='control'>";
    echo "<textarea class='textarea' name='description' rows='4'>{$product['description']}</textarea>";
    echo "</div></div>";
    echo "<div class='field'>";
    echo "<label class='label' for='price'>Price:</label>";
    echo "<div class='control'>";
    echo "<input class='input' type='text' name='price' value='{$product['price']}'>";
    echo "</div></div>";
    echo "<div class='field'>";
    echo "<div class='control'>";
    echo "<input class='button is-link' type='submit' value='Edit'>";
    echo "</div></div>";
    echo "</form>";
    echo "</div></div></div></div>";
}

function ft_edit_product($product_id, $product_name, $description, $price)
{
    $connexion = ft_create_conexion();
    $sql = "UPDATE product SET product_name = ?, description = ?, price = ? WHERE product_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("ssdi", $product_name, $description, $price, $product_id);
    $stmt->execute();
    $connexion->close();

    if ($stmt->affected_rows > 0)
    {
        echo "<script>alert('Producto actualizado')</script>";
        // header("Location: my_products.php");
    }
    else
        echo "<script>alert('Producto actualizado')</script>";
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

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <?php ft_daw_product_edit($_GET['product_id']); ?>

</body>

<?php include '../footer.php'; ?>
