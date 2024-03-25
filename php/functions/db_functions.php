<?php 

include '../create_conexion.php';

function ft_login($username, $password)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
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