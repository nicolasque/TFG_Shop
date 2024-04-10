<?php
include 'admin_header.php';

// Get user_id from URL
$user_id = $_GET['user_id'];

// If the user is not loged in go to index.php
if (!isset($user_id) && !ft_is_admin())
{
    header('Location: /tfg_shop/index.php');
    exit;
}

function ft_get_user_info($user_id)
{
    $connexion = ft_create_conexion();
    $sql = "SELECT * FROM user WHERE user_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("i", $user_id);
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
        return false;
    }
}

function ft_update_user_info($user_id, $username, $password, $email, $admin)
{
    $connexion = ft_create_conexion();
    $sql = "UPDATE user SET username = ?, password = ?, email = ? , admin = ? WHERE user_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("ssssi", $username, $password, $email, $admin , $user_id);
    $stmt->execute();
    if ($stmt->affected_rows > 0)
    {
        return (true);
    }
    else
    {
        return (false);
    }
    $connexion->close();
}

// Get user info
$user_info = ft_get_user_info($user_id);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $admin = isset($_POST['admin']) ? 1 : 0;
    // Update user info
    if (ft_update_user_info($user_id, $username, $password, $email, $admin))
    {

        //TODO : Add alert
        echo "
        <script type='text/javascript'>
        alert('User updated');

        </script>";
        header("Location: user_admin.php");
        // exit();
    }
    else
    {
        echo "Error updating user";
    }
    
}
else
{
    $user_id = $_GET['user_id'];
    $user_info = ft_get_user_info($user_id);
}
?>
<!-- 
<form method="post">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    Username: <input type="text" name="username" value="<?php echo $user_info['username']; ?>"><br>
    Password: <input type="password" name="password" value="<?php echo $user_info['password']; ?>"><br>
    Email: <input type="email" name="email" value="<?php echo $user_info['email']; ?>"><br>
    Admin: <input type="checkbox" name="admin" <?php if ($user_info['admin'] == 1) echo "checked"; ?>><br>
    <input type="submit" value="Update User">
</form> -->

<div class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-half">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <div class="field">
                        <label class="label">Username</label>
                        <div class="control">
                            <input class="input" type="text" name="username" value="<?php echo $user_info['username']; ?>">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Password</label>
                        <div class="control">
                            <input class="input" type="password" name="password" value="<?php echo $user_info['password']; ?>">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input class="input" type="text" name="email" value="<?php echo $user_info['email']; ?>">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Admin</label>
                        <div class="control">
                            <input class="checkbox" type="checkbox" name="admin" <?php echo $user_info['admin'] ? 'checked' : ''; ?>>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="button is-link" type="submit" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>