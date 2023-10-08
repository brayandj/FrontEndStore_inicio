<?php

function conectionBD() : mysqli {
$conexion = mysqli_connect( "127.0.0.1:3306", "root", "Bradiji8910$", "frontendstore");

if(!$conexion) {
    echo "Error de conexion";
    exit;
}
return $conexion;
    }