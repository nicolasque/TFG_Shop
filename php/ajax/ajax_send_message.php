<?php 
include '../create_conexion.php';

function ft_send_message($chat_id ,$sender_id, $message)
{
    $connexion = ft_create_conexion();
    $sql = "INSERT INTO messages (chat_id, user_id, message) VALUES (?, ?, ?)";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("iis", $chat_id ,$sender_id, $message);
    $stmt->execute();
    if ($stmt->error)
    {

        echo "Error: " . $sql . "<br>" . $connexion->error;
    }
    else
    {
        echo "true";
    }
    $connexion->close();
}

$chat_id = $_POST['chat_id'];
$sender_id = $_POST['user_id_buyer'];
$message = $_POST['message'];

ft_send_message($chat_id, $sender_id, $message);

?>