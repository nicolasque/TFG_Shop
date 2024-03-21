<script src="../../js/jquery.js"></script>
<?php

include '../create_conexion.php';

function check_new_user_email($email, $connexion)
{
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("s", $email );
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0)
        return true;
    else
        return false;
}

function check_new_user_username($username, $connexion)
{
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("s", $username );
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0)
        return true;
    else
        return false;
}

$connexion = ft_create_conexion();

$username = $_POST['username'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];

if(check_new_user_email($email, $connexion))
{
    echo "<span style='color:red;'>Email already in use</span>";
    return;
}
if(check_new_user_username($username, $connexion))
{
    echo "<span style='color:red;'>Username already in use</span>";
    return;
}

$sql = "INSERT INTO `user` (`username`, `name`, `surname`, `email`, `password`) VALUES (?, ?, ?, ?, ?)";
$stmt = $connexion->prepare($sql);
$stmt->bind_param("sssss", $username, $name, $surname, $email, $password);
$result = $stmt->execute();
if($result)
{
    echo "OK";
}
else
{
    echo "Error: " . $sql . "<br>" . $connexion->error;
}

echo "<li>Username: $username</li>";
echo "<li>Name: $name</li>";
echo "<li>Surname: $surname</li>";
echo "<li>Email: $email</li>";
echo "<li>Password: $password</li>";
echo "<br>";
echo "<br>";

$connexion->close();

?>
    