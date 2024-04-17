<?php

include 'forum_functions.php';

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
    <?php ft_chount_active_user($_GET['forum_id']); ?>
</body>

</html>