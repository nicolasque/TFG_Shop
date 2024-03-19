<?php

    include '../create_conexion.php';

    $connexion = createConexon();

    $username = $_POST['username'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, name, surname, email, password) VALUES (?, ?, ?, ?, ?)";
    // $stmt = $connexion->prepare($sql);
    // $stmt->bind_param("sssss", $username, $name, $surname, $email, $password);
    // $result = $stmt->execute();
    // if($result)
    // {
    //     echo "OK";
    //     // echo "User created successfully";
    // }
    // else
    // {
    //     echo "Error: " . $sql . "<br>" . $connexion->error;
    // }

    echo "<li>Username: $username</li>";
    echo "<li>Name: $name</li>";
    echo "<li>Surname: $surname</li>";
    echo "<li>Email: $email</li>";
    echo "<li>Password: $password</li>";
    echo "<br>";

    cerrarConexion($connexion);

?>