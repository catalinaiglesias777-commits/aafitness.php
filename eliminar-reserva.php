<?php

session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: admin-reservas.php");
    exit();
}

if (!isset($_POST['id_reserva'])) {
    exit("No se recibió el identificador de la reserva");
}

$id_reserva = filter_var($_POST['id_reserva'], FILTER_VALIDATE_INT);

if ($id_reserva === false || $id_reserva <= 0) {
    exit("Identificador de reserva inválido");
}

$conexion = mysqli_connect("localhost", "root", "", "aa_fitness")
or exit("No se pudo conectar con la base de datos");

$consulta = "DELETE FROM reservas WHERE id_reserva = ?";

$preparar = mysqli_prepare($conexion, $consulta);

mysqli_stmt_bind_param($preparar, "i", $id_reserva);

mysqli_stmt_execute($preparar);

header("Location: admin-reservas.php");
exit();

?>