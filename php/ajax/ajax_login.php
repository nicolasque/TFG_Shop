<?php

include '../create_conexion.php';

function ft_set_user_cookie($user_id, $username, $name, $surname, $email, $admin)
{
    setcookie("user_id", $user_id, time() + (86400 * 30), "/");
    setcookie("username", $username, time() + (86400 * 30), "/");
    setcookie("name", $name, time() + (86400 * 30), "/");
    setcookie("surname", $surname, time() + (86400 * 30), "/");
    setcookie("email", $email, time() + (86400 * 30), "/");
    setcookie("admin", $admin, time() + (86400 * 30), "/");
}

$username = $_POST['username'];
$password = $_POST['password'];


$connexion = ft_create_conexion();
$sql = "SELECT * FROM user WHERE username = ? AND password = ?";
$stmt = $connexion->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    ft_set_user_cookie($row['user_id'], $row['username'], $row['name'], $row['surname'], $row['email'], $row['admin']);
    $connexion->close();
    echo "true";
    return "true";
}
else
{
        $connexion->close();
        return false;
}

?>