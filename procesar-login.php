<?php

session_start();

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$conexion = mysqli_connect("localhost", "root", "", "aa_fitness")
or exit("No se pudo conectar con la base de datos");

$consulta = "SELECT * FROM administradores WHERE usuario = ?";

$preparar = mysqli_prepare($conexion, $consulta);

mysqli_stmt_bind_param($preparar, "s", $usuario);

mysqli_stmt_execute($preparar);

$resultado = mysqli_stmt_get_result($preparar);
$fila = mysqli_fetch_array($resultado);

if ($fila && password_verify($contrasena, $fila['contrasena'])) {

    session_regenerate_id(true);

    $_SESSION['id_admin'] = $fila['id_admin'];
    $_SESSION['usuario'] = $fila['usuario'];

    header("Location: admin-reservas.php");
    exit();

} else {

    echo "Usuario o contraseña incorrectos";

}
?>