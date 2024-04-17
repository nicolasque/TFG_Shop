<?php

include '../create_conexion.php';

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
    {
        return ;
    }
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