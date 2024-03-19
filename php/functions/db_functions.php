<?php

    include '../create_conexion.php';


    function createUser($username, $surname, $email, $password) {
        $sql = "INSERT INTO users (username, surname, email, password) VALUES ('$username', '$surname', '$email', '$password')";
        if ($connexion->query($sql) === TRUE)
        {
            echo "New record created successfully";
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $connexion->error;
        }
    }



?>