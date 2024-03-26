<?php

include 'get_user_info.php';
include 'get_product_info.php';


function ft_veryfy_user($user_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM user WHERE user_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
        $connexion->close();
        return (true);
    }
    else
    {
        $connexion->close();
        return (false);
    }
}

function ft_is_admin()
{
    if (isset($_COOKIE['admin']) && $_COOKIE['admin'] == 1)
    {
        return (true);
    }
    else
    {
        return (false);
    }
}

function ft_is_user()
{
    if (isset($_COOKIE['admin']) && $_COOKIE['admin'] == 0)
    {
        return (true);
    }
    else
    {
        return (false);
    }
}

function ft_is_logged()
{
    if (isset($_COOKIE['user_id']))
    {
        return (true);
    }
    else
    {
        return (false);
    }
}

function ft_compare_id_user($user_id)
{
    if ($_COOKIE['user_id'] == $user_id)
    {
        return (true);
    }
    else
    {
        return (false);
    }
}

function compareid_user_and_product($user_id, $product_id)
{
    $product_info = ft_get_product_info($product_id);
    if ($product_info['user_id'] == $user_id)
    {
        return (true);
    }
    else
    {
        return (false);
    }
}

function chek_admin_db($user_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT admin FROM user WHERE user_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $connexion->close();
    if ($row['admin'])
        return (true);
    else
        return (false);
}



?>