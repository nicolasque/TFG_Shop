<?php

include 'forum_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (ft_create_forum() == TRUE)
    {
        header('Location: all_forums.php');
    }
    else
    {
        echo "Error creating forum"
            . " <a href='all_forums.php'>Go back</a>";
        exit;
    }

}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Create Forum</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>

<body>
    <?php include '../navbar.php'; ?>
    <section class="section">
        <div class="container">
            <h1 class="title">Crea un foro</h1>
            <form action="" method="POST">
                <div class="field">
                    <label class="label">Nombre del foro</label>
                    <div class="control">
                        <input class="input" type="text" name="forum_name" placeholder="Foro de perros" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Tema</label>
                    <div class="control">
                        <input class="input" type="text" name="topic" placeholder="Perros" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Descripcion</label>
                    <div class="control">
                        <textarea class="textarea" name="description" placeholder="Ene este foro se habla de perros"
                            required></textarea>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button class="button is-primary" type="submit">Crear</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>