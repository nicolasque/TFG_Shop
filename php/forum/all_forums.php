<?php
include "../create_conexion.php";

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

function ft_print_forums($forums)
{
    foreach ($forums as $forum)
    {
        echo "<div class='column'>";
        echo "<div class='box'>";
        echo "<a class='' href='forum_site.php?forum_id=" . $forum['forum_id'] . "'>";
        echo "<h2 class='subtitle is-primary is-2 has-text-primary'>" . $forum['forum_name'] . "</h2>";
        echo "<p><h3 class='has-text-primary' >Topic: ". $forum['topic'] ."</h3></p>";
        echo "<p>" . $forum['description'] . "</p>";
        echo "<p><span class='tag is-primary'>Active Users: ". $forum['number_users'] ."</span></p>";
        echo "</a>";
        echo "</div>";
        echo "</div>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Forum Information</title>
</head>
<body>
    <?php include '../navbar.php'; ?>
    <section class="section">
        <div class="container">
            <a href="create_forum.php" class="button is-primary">Create Forum</a>
            <h1 class="title">Forum Information</h1>
            
            <div class="columns">
                <?php
                $forums = ft_get_forums();
                ft_print_forums($forums);
                ?>
            </div>
            
        </div>
    </section>
</body>
</html>