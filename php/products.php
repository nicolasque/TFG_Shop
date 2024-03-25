<?php
    include 'create_conexion.php';

    function ft_get_products()
    {
        $connexion = ft_create_conexion();
        $sql = "SELECT * FROM product";
        $result = $connexion->query($sql);
        $connexion->close();
        return $result;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Website Name - Products</title>
  <script src="../js/jquery.js"></script>
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
    </style>
</head>
<body>
<?php include 'navbar.php'; 
    $products = ft_get_products();
?>

<main class="container">
    <h1>Products</h1>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>User ID</th>
                <th>Photo</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $products->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['photo']; ?></td>
                    <td><?php echo $row['descripcion']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>


</body>
</
