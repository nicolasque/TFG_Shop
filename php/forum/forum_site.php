<?php

include '../create_conexion.php';

function ft_get_forum_info($forum_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM forum WHERE forum_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $forum_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0)
    {
        $forum = $result->fetch_assoc();
        $connexion->close();
        return $forum;
    }
    else
    {
        $connexion->close();
        return FALSE;
    }
}

function ft_get_mesages($forum_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM forum_post WHERE forum_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $forum_id);
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

$forum_info = ft_get_forum_info($_GET['forum_id']);
$messages = ft_get_mesages($_GET['forum_id']);

function ft_get_username_by_id($user_id)
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
        return FALSE;
    }
}

function ft_print_messages($messages)
{
    foreach ($messages as $message)
    {
        $color = sprintf('#%06X', $message['user_id'] * 123456); // Multiplica por un número para obtener colores diferentes

        echo "<div class='box'>";
        echo "<p class='subtitle is-5'>" . $message['message'] . "</p>";
        echo "<p class='subtitle is-6' style='color: " . $color . "'>Posted by: " . ft_get_username_by_id($message['user_id']) . "</p>";
        echo "</div>";
    }
}

function ft_send_message($forum_id, $content)
{
    $connexion = ft_create_conexion();
    $sql = "INSERT INTO forum_post (forum_id, user_id, message) VALUES (?, ?, ?)";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("iis", $forum_id, $_COOKIE['user_id'], $content);
    $stmt->execute();
    $connexion->close();
    if ($stmt->affected_rows > 0)
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

if (isset($_POST['content']))
{
    if (ft_send_message($_GET['forum_id'], $_POST['content']) == TRUE)
    {
        header("Location: forum_site.php?forum_id=" . $_GET['forum_id']);
    }
    else
    {
        echo "Error sending message";
    }
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>Forum Site</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <?php include '../navbar.php'; ?>
</head>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title"> <?php echo $forum_info['forum_name'] ?></h1>
            <!-- Display forum info here -->

            <?php ft_print_messages($messages); ?>

            <div class="container">
                <h2 class="subtitle">New Post</h2>
                <form action="" method="POST">
                    <!-- Form to write a new post -->
                    <div class="field">
                        <label class="label">Mensaje</label>
                        <div class="control">
                            <textarea class="textarea" name="content" placeholder="Escribe tu mensjaet"></textarea>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <button class="button is-primary" type="submit">Submit</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>