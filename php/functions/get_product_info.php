<?php

include 'create_conexion.php';

function ft_get_product_info($product_id)
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

function ft_get_product_user_id($product_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT user_id FROM product WHERE product_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $connexion->close();
        return $row['user_id'];
    }
    else
    {
        $connexion->close();
        return false;
    }
}