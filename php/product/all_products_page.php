<?php
include '../create_conexion.php';
include '../navbar.php';

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
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <script src="../../js/jquery.js"></script>
    <script src="../../js/js_products_page.js"></script>

    <!-- <script src="../js/script.js"></script> -->


    <style>
        .col,
        table {
            border-collapse: collapse;
            width: 100%;
        }

        #col th,
        td {
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
    $products = (object)ft_get_products();
    ?>
    <main class="section">
        <div class="container">
            <h1 class="title">Productos: </h1>
            <div class="columns is-multiline">
                <?php while ($row = $products->fetch_assoc())
                { ?>
                    <div class="column is-one-third">
                        <div class="card">
                            <div class="card-image">
                                <?php
                                $photos = ft_get_photos($row['photo']);
                                if (count($photos) > 1)
                                {
                                    echo "<div class='image is-4by3' id='product-gallery-{$row['product_id']}'>";
                                    foreach ($photos as $index => $photo)
                                    {
                                        $display = $index == 0 ? 'block' : 'none';
                                        echo "<img class='gallery-image' style='display: {$display}; width: 100%; height: auto;' src='/tfg_shop/images/products/{$row['photo']}/{$photo}'>";
                                    }
                                    echo "<button class='prev button is-link is-outlined' style='position: absolute; top: 50%; left: 0;'><-</button>";
                                    echo "<button class='next button is-link is-outlined' style='position: absolute; top: 50%; right: 0;'>-></button>";
                                    echo "</div>";
                                }
                                else
                                {
                                    echo "<div class='image is-4by3' id='product-gallery-{$row['product_id']}'>";
                                    echo "<img class='gallery-image' style='width: 100%; height: auto;' src='/tfg_shop/images/products/{$row['photo']}/{$photos[0]}'>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-4"><a
                                                href="/tfg_shop/php/product/product.php?product_id=<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?></a>
                                        </p>
                                        <p class="subtitle is-6">
                                            <?php echo $row['user_name'];
                                            echo $row ['hello'];
                                            // echo "<h2>$row['heloo']</h2>";
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="content">
                                    <?php echo $row['description']; ?>
                                    <br>
                                    <time class="content is-medium has-text-primary"><?php echo $row['price']; ?>€</time>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>




</body>
<?php include '../footer.php'; ?>

</html>