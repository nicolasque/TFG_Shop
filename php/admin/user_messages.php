<?php

// Include your database connection code here
// include '../navbar.php';
// include '../create_conexion.php';

function ft_fetch_messages()
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM admin_report";
    $result = $connexion->query($sql);
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

function ft_print_admin_messages($messages)
{
    foreach ($messages as $message)
    {
        echo '<tr>';
        echo '<td>' . $message['name'] . '</td>';
        echo '<td>' . $message['email'] . '</td>';
        echo '<td>' . $message['message'] . '</td>';
        echo '</tr>';
    }
}

?>



<!DOCTYPE html>
<html>
<head>
    <title>Mensajes al administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <style>
    </style>
</head>
<body>
<?php include 'admin_header.php';?>

    <section class="section">
        <div class="container">
            <h1 class="title">User Messages</h1>
            <table class="table is-fullwidth is-striped">
                <thead>
                    <tr>
                        <th class="has-text-centered">Name</th>
                        <th class="has-text-centered">Email</th>
                        <th class="has-text-centered">Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        ft_print_admin_messages(ft_fetch_messages());
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>