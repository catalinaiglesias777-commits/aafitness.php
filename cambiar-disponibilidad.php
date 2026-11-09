<?php
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "aa_fitness")
or exit("No se pudo conectar con la base de datos");

if (!isset($_POST['id_horario'])) {
    exit("No se seleccionó ningún horario.");
}

$id_horario = (int) $_POST['id_horario'];

if ($id_horario <= 0) {
    exit("El horario seleccionado no es válido.");
}

$consulta = "UPDATE horarios
             SET disponible = IF(disponible = 1, 0, 1)
             WHERE id_horario = ?";

$preparar = mysqli_prepare($conexion, $consulta);
mysqli_stmt_bind_param($preparar, "i", $id_horario);

if (mysqli_stmt_execute($preparar)) {
    header("Location: admin-horarios.php");
    exit();
} else {
    echo "No se pudo actualizar la disponibilidad del horario.";
}
?>