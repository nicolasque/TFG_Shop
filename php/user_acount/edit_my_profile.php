<?php
// Include your database connection code here
// include '../navbar.php';
include '../my_account.php';

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
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = $_POST['username'];
    $old_password = $_POST['old_password'];
    $old_hashed_password = $_POST['old_hashed_password'];
    $new_password = $_POST['new_password'];
    $re_new_password = $_POST['re_new_password'];
    $email = $_POST['email'];

    // Check if old password is correct
    if (!password_verify($old_password, $old_hashed_password))
    {
        echo "Vieja contraseña incorrecta";
        return;
    }
    else
    {
        if ($new_password != $re_new_password)
        {
            echo "Las contraseñas no coinciden";
            return;
        }
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        // Update user info
        ft_update_user_info($user_id, $username, $hashed_password, $email);
        // Refresh the page to show updated info
        header("Refresh:0");
    }

}
?>



<div class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-half">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="field">
                        <label class="label">Nombre de usuario</label>
                        <div class="control">
                            <input class="input" type="text" name="username"
                                value="<?php echo $user_info['username']; ?>">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Vieja contraseña</label>
                        <div class="control">
                            <input class="input" type="password" name="old_password" value="">
                            <input type="hidden" name="old_hashed_password"
                                value="<?php echo $user_info['password']; ?>">
                        </div>
                        <div class="field">
                            <label class="label">Nueva contraseña</label>
                            <div class="control">
                                <input class="input" type="password" name="new_password" value="">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Repetir nueva contraseña</label>
                            <div class="control">
                                <input class="input" type="password" name="re_new_password" value="">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input class="input" type="text" name="email"
                                    value="<?php echo $user_info['email']; ?>">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="button is-link" type="submit" value="Actualizar">
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>
