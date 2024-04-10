<!-- Yo pondria la informaciion del producto al principo y debajo el propio chat  -->

<?php
include '../navbar.php';
include '../create_conexion.php';

function ft_get_product_info()
{
    $product_id = $_GET['product_id'];
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

$product = ft_get_product_info();

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

function ft_print_photos($row)
{
    $photos = ft_get_photos($row['photo']);

    echo "<div class='' id='product-gallery-{$row['product_id']}'>";
    echo "<img class='gallery-image ' src='/tfg_shop/images/products/{$row['photo']}/{$photos[0]}' width='100px'>";
    echo "</div>";
}


function ft_print_table_product_info($product)
{
    echo "<table class='table table-bordered' style='width:100%; height:40px; border: 1px solid black;'>";
    echo "<tr style='text-align: left;'>";
    echo "<th style='padding: 10px;'>Product Name</th>";
    echo "<th style='padding: 10px;'>Price</th>";
    echo "<th style='padding: 10px;'>Photo</th>";
    echo "</tr>";
    echo "<tr style='vertical-align: middle;'>";
    echo "<td style='padding: 10px;'>" . $product['product_name'] . "</td>";
    echo "<td style='padding: 10px;'>" . $product['price'] . "€</td>";
    echo "<td style='padding: 0px; border: 0px;'width:100%; height:100%;>";
    $photos = ft_get_photos($product['photo']);
    echo "<div class='image is-48x48' id='product-{$product['product_id']}' style='padding: 0px; border: 0px;'width:100%; height:100%;>";
    if (count($photos) > 0)
    {
        echo "<img src='/tfg_shop/images/products/{$product['photo']}/{$photos[0]}' width='20px'>";
    }
    echo "</div>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";

}

function ft_new_chat($product)
{
    $product_id = $_GET['product_id'];
    $connexion = ft_create_conexion();
    $sql = "INSERT INTO chat (product_id, user_id_buyer, user_id_seller) VALUES (?, ?, ?)";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("iii", $product_id, $_COOKIE['user_id'], $product['user_id']);
    $stmt->execute();
    $connexion->close();
}

function ft_is_user_product($product)
{
    if ($product['user_id'] == $_COOKIE['user_id'])
    {
        return true;
    }
    else
    {
        return false;
    }
}

function ft_verify_chat($product)
{
    $product_id = $_GET['product_id'];
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM chat WHERE product_id = ? && user_id_buyer = ? ";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("ii", $product_id, $_COOKIE['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0 && !ft_is_user_product($product))
    {
        ft_new_chat($product);
    }
    $connexion->close();
}


function ft_get_chat_id($product)
{
    $product_id = $_GET['product_id'];
    $connexion = ft_create_conexion();
    $sql = "SELECT chat_id FROM chat WHERE product_id = ? && (user_id_buyer = ? || user_id_seller = ?)";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("iii", $product_id,  $_COOKIE['user_id'], $_COOKIE['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $connexion->close();
    return $row['chat_id'];
}

function ft_get_chat_messages($chat_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM messages WHERE chat_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $chat_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $messages = [];
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $messages[] = $row;
        }
    }
    $connexion->close();
    return $messages;
}

function ft_aling_mesajes($user_id)
{
    if ($user_id == $_COOKIE['user_id'])
    {
        return "is-pulled-right";
    }
    else
    {
        return "is-pulled-left";
    }
}

function ft_give_style_mesaje($user_id)
{
    if ($user_id == $_COOKIE['user_id'])
    {
        return "has-background-light has-text-dark is-pulled-right";
    }
    else
    {
        return "has-background-dark has-text-light is-pulled-left";
    }
}

function ft_print_chat_messages($messages)
{
    foreach ($messages as $message)
    {
        echo "<div  class=". ft_give_style_mesaje($message['user_id']) ." style='width: 100%; height: 40px; border: 1px solid black; margin-top: 10px; padding: 10px;'>";
        echo "<p class='". ft_give_style_mesaje($message['user_id'])." user_mesaje_". $message['user_id'] ."' style='margin: 0px;'>" . $message['message'] . "</p>";
        echo "</div>";
    }
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/tfg_shop/js/chat.js"></script>
    <script src="/tfg_shop/js/jquery.js"></script>
    <title>Document</title>


</head>
<body>
    <?php
        ft_print_table_product_info($product);
        ft_verify_chat($product);
    ?>
<div class="columns is-vcentered is-centered" style="height: 80vh;">

<div id="chat-container container is-fluid columns is-vcentered is-centered" style="width: 80%; height: 100%; border: 1px solid green; margin-top: 20px; padding: 10px;">
        <div id="chat-box " class="column is-half is-vcentered is-centered" style="width: 600px; height: 80%; border: 1px solid green; overflow-y: scroll;">
            <!-- Aquí se mostrarán los mensajes del chat -->
            <?php
                $chat_id = ft_get_chat_id($product);
                echo $chat_id;
                echo "<p style='display: none;' id='chat_id'>" . $chat_id . "</p>";
                echo "<p style='display: none;' id='user_id_buyer'>" . $_COOKIE['user_id'] . "</p>";
                // echo "<p style='display: none;' id='user_id_seller'>" . $product['user_id'] . "</p>";

                $messages = ft_get_chat_messages($chat_id);
                ft_print_chat_messages($messages);
            ?>
        </div>
        <div id="message-input" class="" style="width: 600px; height: 10%; margin-top: 10px;">
            <textarea id="message-text" style="width: 80%; height: 100%;"></textarea>
            <button id="send-button" class="button is-primary" style="width: 20%; height: 100%;">Send</button>
        </div>
    </div>
</div>

</body>
</html>