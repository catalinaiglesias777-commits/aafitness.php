<?php

$conexion = mysqli_connect(
    "localhost",
    "root",
    "",
    "aa fitness"
);

if (!$conexion) {
    die("Error al conectar con la base de datos");
}

mysqli_set_charset($conexion, "utf8mb4");

?>