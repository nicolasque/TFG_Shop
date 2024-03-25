<?php

include 'create_conexion.php';

function ft_add_product($product_name, $price, $user_id, $photos, $description, $user_name, $upload_date)
{
    // Crear una nueva carpeta para el producto en el directorio de imágenes de productos
    $folder_id = uniqid();
    $product_folder = "../images/products/" . $folder_id; 
    if (!file_exists($product_folder)) {
        mkdir($product_folder, 0777, true);
    }

    // TODO : QUE LAS IMAGENE SE GUARDEN EN LA CARPETA

    // Mover cada archivo cargado a la nueva carpeta del producto
    if (is_array($photos['name'])) {
        for ($i = 0; $i < count($photos['name']); $i++) {
            $photo_name = $photos['name'][$i];
            $photo_tmp_name = $photos['tmp_name'][$i];
            $photo_path = $product_folder . "/" . $photo_name;
            move_uploaded_file($photo_tmp_name, $photo_path);
        }
    }
    // Insertar la ruta de la imagen en la base de datos en lugar del archivo de imagen
    $connexion = ft_create_conexion();
    $sql = "INSERT INTO product (product_name, price, user_id, photo, description, user_name, upload_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("sdsbsss", $product_name, $price, $user_id, $photo_path, $description, $user_name, $upload_date);
    $stmt->execute();
    $connexion->close();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $photos = $_FILES["photos"];
    $description = $_POST["description"];
    $user_name = $_COOKIE["username"];
    $user_id = $_COOKIE["user_id"];

    if (isset($_FILES["photos"])) {
        $photos = $_FILES["photos"];
        ft_add_product($product_name, $price, $user_id, $photos, $description, $user_name, date("Y-m-d H:i:s"));
    } else {
        echo "No files were uploaded.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <?php include 'navbar.php'; ?>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h1>Add Product</h1>
    <form method="POST" action=""  enctype="multipart/form-data">
        <!-- Add your form fields here -->
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required><br>
        <label for="price">Price:</label>
        <input type="text" name="price" required><br>
        <label for="photo">Photo:</label>
        <input type="file" name="photos" multiple required><br>
        <label for="description">Description:</label>
        <input type="text" name="description" required><br>

        <input type="submit" value="Add Product">
    </form>
</body>
</html>