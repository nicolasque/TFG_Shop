<?php
    include '../account.php';
    

    function ft_daw_product($product_id)
    {
        echo "<table id='col'>";
        echo "<tr>";
        echo "<th>Product Name</th>";
        echo "<th>Description</th>";
        echo "<th>Price</th>";
        echo "<th>Photos</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        $products = ft_get_user_products($_COOKIE['user_id']);
        foreach ($products as $product)
        {
            if ($product['product_id'] == $product_id)
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
                echo "<td>";
                echo "<form method='POST' action='my_products.php'>";
                echo "<input type='hidden' name='product_id' value='$product_id'>";
                echo "<input type='submit' value='Delete'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <?php ft_daw_product($_GET['product_id']); ?>
    <br>
    <h2 style="color: red;"  >Are you sure you want to delete this product?</h2>
    

</body>
</html>