<?php
include 'create_conexion.php';
include 'navbar.php';

// Get user_id from cookie
$user_id = $_COOKIE['user_id'];

// If yhe user is not loged in go to index.php
if (!isset($user_id))
{
    header('Location: index.php');
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

function ft_update_user_info($user_id, $username, $password, $email)
{
    $connexion = ft_create_conexion();
    $sql = "UPDATE user SET username = ?, password = ?, email = ? WHERE user_id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("sssi", $username, $password, $email, $user_id);
    $stmt->execute();
    $connexion->close();
}

// Get user info
$user_info = ft_get_user_info($user_id);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Update user info
    ft_update_user_info($user_id, $username, $password, $email);

    // Refresh the page to show updated info
    header("Refresh:0");
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    Username: <input type="text" name="username" value="<?php echo $user_info['username']; ?>"><br>
    Password: <input type="password" name="password" value="<?php echo $user_info['password']; ?>"><br>
    Email: <input type="text" name="email" value="<?php echo $user_info['email']; ?>"><br>
    <input type="submit" value="Update">
</form>