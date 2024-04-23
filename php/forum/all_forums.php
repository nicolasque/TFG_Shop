<?php
include "forum_functions.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Foros: </title>
</head>
<body>
    <?php include '../navbar.php'; ?>
    <section class="section">
        <div class="container">
            <a href="create_forum.php?forum_id=0" class="button is-primary">Crear foro</a>
            <h1 class="title">Foros: </h1>
            
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