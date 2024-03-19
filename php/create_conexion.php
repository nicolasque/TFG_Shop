<?php 

function createConexon() {
    //Informacion de conexion a la base de datos
    $host  = "localhost";
    $user = "root";
    $pass = "";
    $baseDatos = "web_compraventa";

    //crear la conexion
    $connexion = new mysqli($host, $user, $pass, $baseDatos);


    if($connexion->connect_errno)
    {
        echo "Fallo conectando a la MySQL:  )" . $connexion->connect_errno . ") ". $connexion->connect_error;
    }
    mysqli_select_db($connexion, 'web_compraventa') or die('No se puede seleccionar la base de datos web_compraventa');
    // echo "Conexion exitosa";
    return $connexion;
}

function cerrarConexion($connexion) {
    $connexion->close();
}

?>