<?php

include '../create_conexion.php';
function process_files($photos)
{
	$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
	$max_file_size = 5000000;
	$folder_id = uniqid();
	$folder_path = "../../images/products/" . $folder_id;


	for ($i = 0; $i < count($photos['name']); $i++)
	{

		if ($photos['size'][$i] > $max_file_size)
		{
			die("File is too large...");
		}

		$ext = pathinfo($photos['name'][$i], PATHINFO_EXTENSION);


		if (!in_array($ext, $allowed_extensions))
		{
			die("Invalid file type...");
		}
	}


	if (!mkdir($folder_path, 0777, TRUE))
	{
		die("Failed to create folder...");
	}


	for ($i = 0; $i < count($photos['name']); $i++)
	{
		$ext = pathinfo($photos['name'][$i], PATHINFO_EXTENSION);


		$new_name = uniqid() . "." . $ext;

		if (!move_uploaded_file($photos['tmp_name'][$i], $folder_path . "/" . $new_name))
		{
			die("Failed to upload file...");
		}
	}

	return $folder_id;
}

function ft_add_product($product_name, $price, $user_id, $photos, $description, $city, $user_name, $upload_date)
{
	$folder_id = process_files($photos);


	if (empty($folder_id))
	{
		return FALSE;
	}

	$connexion = ft_create_conexion();
	$sql = "INSERT INTO product (product_name, price, user_id, photo, description, city ,user_name, upload_date) VALUES (?, ?, ?, ?, ? , ?, ?, ?)";
	$stmt = $connexion->prepare($sql);

	$stmt->bind_param("sdssssss", $product_name, $price, $user_id, $folder_id, $description, $city, $user_name, $upload_date);

	$stmt->execute();
	$connexion->close();

	return (TRUE);
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$product_name = $_POST["product_name"];
	$price = $_POST["price"];
	$photos = $_FILES["photos"];
	$description = $_POST["description"];
	$city = $_POST["city"];
	$user_name = $_COOKIE["username"];
	$user_id = $_COOKIE["user_id"];

	if (isset($photos) && $photos['error'][0] === UPLOAD_ERR_OK)
	{
		$success = ft_add_product($product_name, $price, $user_id, $photos, $description, $city, $user_name, date("Y-m-d H:i:s"));
		if ($success)
		{
			echo "Product added successfully!";
		}
		else
		{
			echo "Error adding product. Please try again.";
		}
	}
	else
	{
		echo "Error uploading photos.";
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Add Product</title>
	<?php include '../navbar.php'; ?>
	<style>
	</style>
</head>

<body>
	<div class="container" style="margin-top: 20px; height: 100hv;">
		<div class="notification is-primary">
			<h1 class="title is-2 is-spaced">Add Product</h1>
			<div class="content columns is-vcentered is-centered"
				style="border: 4px solid #fff; padding: 20px; border-radius: 5px;">
				<form method="POST" action="" enctype="multipart/form-data">
					<label for="product_name">Product Name:</label>
					<input type="text" name="product_name" required><br><br>
					<label for="price">Price:</label>
					<input type="text" name="price" required><br><br>
					<label for="photos">Photos:</label>
					<input type="file" name="photos[]" multiple required><br><br>
					<label for="description">Description:</label>
					<textarea name="description" rows="4" cols="50" required></textarea><br><br>
					<label for="city">City:</label>
					<input type="text" name="city" required><br><br>

					<input class="button" type="submit" value="Add Product">
				</form>
			</div>

		</div>
	</div>


</body>
<?php include '../footer.php'; ?>

</html>