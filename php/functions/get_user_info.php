<?php

include '/tfgh_shop/php/functions/create_conexion.php';

function ft_get_user_info($user_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM user WHERE user_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $user_id);
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

function ft_get_user_username($user_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT username FROM user WHERE user_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $connexion->close();
        return $row['username'];
    }
    else
    {
        $connexion->close();
        return false;
    }
}

function ft_get_with_username($username)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("s", $username);
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




?>