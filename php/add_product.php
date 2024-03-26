<?php

include 'create_conexion.php';
function process_files($photos) {
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];  // Add more as needed
    $max_file_size = 5000000;  // 5MB in bytes

    $folder_id = uniqid();  // Generate a unique id for the folder
    $folder_path = "../images/products/" . $folder_id;

    // Loop through each file
    for($i=0; $i<count($photos['name']); $i++) {
        // Check file size
        if ($photos['size'][$i] > $max_file_size) {
            die("File is too large...");
        }

        // Get the file extension
        $ext = pathinfo($photos['name'][$i], PATHINFO_EXTENSION);

        // Check file type
        if (!in_array($ext, $allowed_extensions)) {
            die("Invalid file type...");
        }
    }

    // Create the folder
    if (!mkdir($folder_path, 0777, true)) {
        die("Failed to create folder...");
    }

    // Loop through each file again to move them to the new folder
    for($i=0; $i<count($photos['name']); $i++) {
        // Get the file extension
        $ext = pathinfo($photos['name'][$i], PATHINFO_EXTENSION);

        // Generate a new name for the file
        $new_name = uniqid() . "." . $ext;

        // Move the file to the new folder
        if (!move_uploaded_file($photos['tmp_name'][$i], $folder_path . "/" . $new_name)) {
            die("Failed to upload file...");
        }
    }

    // Return the folder id
    return $folder_id;
}

function ft_add_product($product_name, $price, $user_id, $photos, $description, $user_name, $upload_date)
{
    // Process the uploaded files and create a folder
    $folder_id = process_files($photos);
  
    // Check if any images were successfully uploaded
    if (empty($folder_id))
    {
      return false;  // Indicate failure
    }
  
    // Insert product data and folder name into the database
    $connexion = ft_create_conexion();
    $sql = "INSERT INTO product (product_name, price, user_id, photo, description, user_name, upload_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connexion->prepare($sql);
  
    $stmt->bind_param("sdsssss", $product_name, $price, $user_id, $folder_id, $description, $user_name, $upload_date);
  
    $stmt->execute();
    $connexion->close();
  
    return (true);  // Indicate success
}

// Check if form is submitted and handle errors
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $product_name = $_POST["product_name"];
  $price = $_POST["price"];
  $photos = $_FILES["photos"];
  $description = $_POST["description"];
  $user_name = $_COOKIE["username"];
  $user_id = $_COOKIE["user_id"];

  if (isset($photos) && $photos['error'][0] === UPLOAD_ERR_OK) {
    $success = ft_add_product($product_name, $price, $user_id, $photos, $description, $user_name, date("Y-m-d H:i:s"));
    if ($success) {
      echo "Product added successfully!";
    } else {
      echo "Error adding product. Please try again.";
    }
  } else {
    echo "Error uploading photos.";
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
  <form method="POST" action="" enctype="multipart/form-data">
    <label for="product_name">Product Name:</label>
    <input type="text" name="product_name" required><br>
    <label for="price">Price:</label>
    <input type="text" name="price" required><br>
    <label for="photos">Photos:</label>
    <input type="file" name="photos[]" multiple required><br>
    <label for="description">Description:</label>
    <input type="text" name="description" required><br>

    <input type="submit" value="Add Product">
  </form>
</body>
</html>