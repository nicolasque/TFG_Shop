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
        return FALSE;
    }
}

$product = ft_get_product_info();

function ft_get_photos($photo_folder)
{
    $photos = [];
    $folder_path = $_SERVER['DOCUMENT_ROOT'] . "/tfg_shop/images/products/" . $photo_folder;
    if (file_exists($folder_path))
    {
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
    echo "<table class='table is-fullwidth is-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Producto</th>";
    echo "<th>Precio</th>";
    echo "<th>Foto</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    echo "<tr>";
    echo "<td>" . $product['product_name'] . "</td>";
    echo "<td>" . $product['price'] . "€</td>";
    echo "<td>";
    $photos = ft_get_photos($product['photo']);
    echo "<figure class='image is-48x48'>";
    if (count($photos) > 0)
    {
        echo "<img src='/tfg_shop/images/products/{$product['photo']}/{$photos[0]}'>";
    }
    echo "</figure>";
    echo "</td>";
    echo "</tr>";
    echo "</tbody>";
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
        return TRUE;
    }
    else
    {
        return FALSE;
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
    $stmt->bind_param("iii", $product_id, $_COOKIE['user_id'], $_COOKIE['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $connexion->close();
    return $row['chat_id'];
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/tfg_shop/js/chat.js"></script>
    <script src="/tfg_shop/js/jquery.js"></script>
    <title>Chat</title>

</head>

<body>
    <div id="page_container " class="container is-fluid is-vcentered is-centered">

        <div class="columns is-vcentered is-centered">
            <div class="column is-vcentered is-centered">
                <h1 class="title is-1">Producto: </h1>
                <div class="box">
                    <?php
                    ft_print_table_product_info($product);
                    ft_verify_chat($product);
                    $chat_id = ft_get_chat_id($product);
                    echo "<p style='display: none;' id='chat_id'>" . $chat_id . "</p>";
                    echo "<p style='display: none;' id='user_id_buyer'>" . $_COOKIE['user_id'] . "</p>";
                    ?>
                </div>
            </div>
        </div>
        <div class="columns is-vcentered is-centered">
            <div id="chat-container" class="container is-fluid is-vcentered is-centered"
                style="scroll-behavior: smooth; height: 600px; width: 70%;">
                <div id="chat-box" class="column is-vcentered is-centered box"
                    style="overflow-y: auto; max-height: 500px;">
                    <!-- Aquí se mostrarán los mensajes del chat -->
                </div>
                <div id="message-input" class="column is-vcentered is-centered">
                    <textarea id="message-text" style="width: 100%; height: 10%;"></textarea>
                    <button id="send-button" class="button is-primary">Enviar</button>
                </div>
            </div>
        </div>

</body>

</html>

</html>