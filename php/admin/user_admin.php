
<link rel="stylesheet" href="../../css/navbar.css">

<?php
// Include your database connection code here
// include '../navbar.php';
include 'admin_header.php';


if (!isset($user_id) && !ft_is_admin())
{
    header('Location: /tfg_shop/php/index.php');
    exit;
}

function ft_fetch_users($connexion)
{
    $sql = "SELECT * FROM user";
    $result = $connexion->query($sql);
    $users = [];
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $users[] = $row;
        }
    }
    $connexion->close();
    return $users;
}

// Fetch all users from the database
$users = ft_fetch_users(ft_create_conexion()); // Replace this with your actual code to fetch users

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Admin</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">User Admin</h1>
            <table class="table is-fullwidth is-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Is Admin</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['surname']; ?></td>
                            <td><?php echo $user['admin'] ? 'Yes' : 'No'; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><a class="button is-small is-link" href="edit_user.php?user_id=<?php echo $user['user_id']; ?>">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>