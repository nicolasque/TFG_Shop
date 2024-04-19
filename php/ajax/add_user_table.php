<script src="../../js/jquery.js"></script>
<?php

include '../create_conexion.php';

function check_new_user_email($email, $connexion)
{
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0)
        return TRUE;
    else
        return FALSE;
}

function check_new_user_username($username, $connexion)
{
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0)
        return TRUE;
    else
        return FALSE;
}

$connexion = ft_create_conexion();

$username = $_POST['username'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);


if (check_new_user_email($email, $connexion))
{
    echo "<span style='color:red;'>Ese email ya esta en uso</span>";
    return;
}
if (check_new_user_username($username, $connexion))
{
    echo "<span style='color:red;'>Ese usuario ya existe</span>";
    return;
}

$sql = "INSERT INTO `user` (`username`, `name`, `surname`, `email`, `password`) VALUES (?, ?, ?, ?, ?)";
$stmt = $connexion->prepare($sql);
$stmt->bind_param("sssss", $username, $name, $surname, $email, $hashed_password);
$result = $stmt->execute();
if ($result)
{
    echo "<script>
            alert('Usuario creado con exito');
            setTimeout(function(){
                window.location.href = '/tfg_shop/index.php';
            }, 5);
          </script>";
    exit;
}
else
{
    echo "Error: " . $sql . "<br>" . $connexion->error;
}

// echo "<li>Username: $username</li>";
// echo "<li>Name: $name</li>";
// echo "<li>Surname: $surname</li>";
// echo "<li>Email: $email</li>";
// echo "<li>Password: $hashed_password</li>";
// echo "<br>";
// echo "<br>";

$connexion->close();

?>
