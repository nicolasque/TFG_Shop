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

if (isset($_GET['forum_id']))
{
    $forum_info = ft_get_forum_info($_GET['forum_id']);
    $messages = ft_get_mesages($_GET['forum_id']);
}


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
        $color = sprintf('#%06X', $message['user_id'] * 123456 % 0x888888 + 0x444444);

        echo "<div class='box'>";
        echo "<p class='subtitle is-5'>" . $message['message'] . "</p>";
        echo "<p class='subtitle is-6' style='color: " . $color . "'>Envado por: " . ft_get_username_by_id($message['user_id']) . "</p>";
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



function ft_add_user_count($forum_id, $user_count)
{
    $connexion = ft_create_conexion();
    $sql = "UPDATE forum SET active_users = ? WHERE forum_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("ii", $user_count, $forum_id);
    $stmt->execute();
    $connexion->close();
}




function ft_chount_active_user($forum_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT COUNT(DISTINCT user_id) AS user_count FROM forum_post WHERE forum_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $forum_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $connexion->close();
        ft_add_user_count($forum_id, $row['user_count']);
        return $row['user_count'];
    }
    else
    {
        $connexion->close();
        return FALSE;
    }
}



function ft_get_forums()
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM forum";
    $result = $connexion->query($sql);
    $forums = [];
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $forums[] = $row;
        }
    }
    $connexion->close();
    return $forums;
}

function ft_chec_valid_forum($forums)
{
    if (isset($_POST['forum_name']) && isset($_POST['topic']) && isset($_POST['description']))
    {
        foreach ($forums as $forum)
        {
            if ($forum['forum_name'] == $_POST['forum_name'])
            {
                echo "Forum already exists";
                return (FALSE);
            }
        }
        return (TRUE);
    }
    else
    {
        echo "All fields are required";
        return (FALSE);
    }


}

function ft_create_forum()
{
    if (ft_chec_valid_forum(ft_get_forums()) == FALSE)
        return;
    $connexion = ft_create_conexion();
    $sql = "INSERT INTO forum (forum_name, topic, description) VALUES (?, ?, ?)";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("sss", $_POST['forum_name'], $_POST['topic'], $_POST['description']);
    $stmt->execute();
    $connexion->close();
    if ($stmt->affected_rows > 0)
    {
        echo "Forum created successfully";
        return (TRUE);
    }
    else
    {
        echo "Error creating forum";
        return (FALSE);
    }
}



function ft_print_forums($forums)
{
    echo "<div class='panel isx-max-desktop'>";
    foreach ($forums as $forum)
    {
        echo "<a class='panel-block' href='forum_site.php?forum_id=" . $forum['forum_id'] . "'>";
        echo "<div class='columns is-multiline'>";
        echo "<div class='column is-12'><h2 class='subtitle is-primary is-2 has-text-primary'>" . $forum['forum_name'] . "</h2></div>";
        echo "<div class='column is-12'><p><h3 class='has-text-primary'>Tema: " . $forum['topic'] . "</h3></p></div>";
        echo "<div class='column is-12'><p>" . $forum['description'] . "</p></div>";
        echo "<div class='column is-12'><p><span class='tag is-primary'>Active Users: " . $forum['active_users'] . "</span></p></div>";
        echo "</div>";
        echo "</a>";
    }
    echo "</div>";
}