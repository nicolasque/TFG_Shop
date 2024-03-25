<?php
include '../create_conexion.php';
include '../navbar.php';

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
    ft_update_user_info($user_id, $username, $password, $email, $admin);
    // Refresh the page to show updated info
    header("Refresh:0");
}
else
{
    $user_id = $_GET['user_id'];
    $user_info = ft_get_user_info($user_id);
}
?>

<form method="post" action="edit_user.php?user_id=<?php echo $user_id; ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    Username: <input type="text" name="username" value="<?php echo $user_info['username']; ?>"><br>
    Password: <input type="password" name="password" value="<?php echo $user_info['password']; ?>"><br>
    Email: <input type="email" name="email" value="<?php echo $user_info['email']; ?>"><br>
    Admin: <input type="checkbox" name="admin" <?php if ($user_info['admin'] == 1) echo "checked"; ?>><br>
    <input type="submit" value="Update User">
</form>