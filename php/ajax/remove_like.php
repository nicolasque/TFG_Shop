<?php 

include '../create_conexion.php';

function ft_remove_like($user_id, $product_id)
{
    $connexion = ft_create_conexion();
    $sql = "DELETE FROM product_like WHERE user_id = ? AND product_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $connexion->close();
    if ($stmt->error)
    {
        echo "Error: " . $sql . "<br>" . $connexion->error;
        return "false";
    }
    else
    {
        echo "true";
        return "true";
    }
}

$user_id = $_POST['user_id'];
$product_id = $_POST['product_id'];

ft_remove_like($user_id, $product_id);
