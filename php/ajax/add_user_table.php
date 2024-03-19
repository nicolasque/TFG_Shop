<?php

    include "create_conexion.php";

    $connexion = createConexon();

    $username = $_POST['username'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password != $confirm_password) {
        echo "Las contraseñas no coinciden";
    }
    // } else {
    //     $sql = "INSERT INTO users (username, surname, email, password) VALUES ('$username', '$surname', '$email', '$password')";
    //     if($connexion->query($sql) === TRUE) {
    //         echo "Usuario creado exitosamente";
    //     } else {
    //         echo "Error: " . $sql . "<br>" . $connexion->error;
    //     }
    // }

    cerrarConexion($connexion);

?>