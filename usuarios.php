<?php

$errores = [];

// Importar la conexion
require 'conection.php';
$db = conectionBD();

// Crear un email y password
$username = "Esteban";
$pass = "1234";
$email = "Esteban@gmail.com";
$date = date("Y-m-d H:i:s");

//Query para crear el usuario
$query = "INSERT INTO usuarios (`id`, `nombre_usuario`, `password`, `correo_electronico`, `fecha_creacion`) VALUES (NULL, '$username', '$pass', '$email', '$date');";

echo "Datos insertados con exito";

// agregarlo a la base de datos
mysqli_query($db, $query);
?>
