<!-- <script src="../../js/jquery.js"></script> -->
<?php

include '../create_conexion.php';
function ft_get_chat_messages($chat_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM messages WHERE chat_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $chat_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $messages = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    }
    $connexion->close();
    return $messages;
}

function ft_give_style_mesaje($user_id)
{
    if ($user_id == $_COOKIE['user_id']) {
        return "has-text-right has-background-info-light has-text-black";
    } else {
        return "has-text-left has-background-light has-text-black";
    }
}

function ft_print_chat_messages($messages)
{
    foreach ($messages as $message) {
        $messageClass = ft_give_style_mesaje($message['user_id']);

        echo "<div class='box notification  $messageClass'> ";
        echo "<p class='is-size-4 user_mesaje_" . $message['user_id'] . "'>" . $message['message'] . "</p>";
        echo "</div>";
    }
}

$chat_id = $_POST['chat_id'];

ft_print_chat_messages(ft_get_chat_messages($chat_id));