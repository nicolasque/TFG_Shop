<?php
    include 'create_conexion.php';
    include 'navbar.php'; 

    function ft_get_products()
    {
        $connexion = ft_create_conexion();
        $sql = "SELECT * FROM product";
        $result = $connexion->query($sql);
        $connexion->close();
        return $result;
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
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Website Name - Products</title>
  <script src="../js/jquery.js"></script>
  <script src="../js/js_products_page.js"></script>
  
  <!-- <script src="../js/script.js"></script> -->


  <style>
        .col ,table {
            border-collapse: collapse;
            width: 100%;
        }
        #col th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
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
    $products = ft_get_products();
?>

<main class="container">
    <h1>Products</h1>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Seller</th>
                <th>Description</th>
                <th>Photo</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $products->fetch_assoc()) { ?>
                <tr>
                    <!-- <td><?php echo $row['product_name']; ?></td> -->
                    <td><a href="product/product.php?product_id=<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?></a></td>
                    <td><?php echo $row['price']; ?>€</td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                    <?php 
                        $photos = ft_get_photos($row['photo']);
                        if (count($photos) > 1)
                        {
                            echo "<div class='image-gallery' id='product-gallery-{$row['product_id']}'>";
                            foreach ($photos as $index => $photo) {
                                $display = $index == 0 ? 'block' : 'none';
                                echo "<img class='gallery-image' style='display: {$display};' src='/tfg_shop/images/products/{$row['photo']}/{$photo}' width='100px'>";
                            }
                            echo "<button class='prev button is-ghost'>Prev</button>";
                            echo "<button class='next button is-ghost'>Next</button>";
                            echo "</div>";
                        }
                        else
                        {
                            echo "<div class='image-gallery' id='product-gallery-{$row['product_id']}'>";
                            echo "<img class='gallery-image' src='/tfg_shop/images/products/{$row['photo']}/{$photos[0]}' width='100px'>";
                            echo "</div>";
                        }
                    ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>


</body>
</html>
