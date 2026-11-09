<?php
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: admin-horarios.php");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "aa_fitness")
or exit("No se pudo conectar con la base de datos");

$id_horario = filter_input(INPUT_POST, 'id_horario', FILTER_VALIDATE_INT);
$id_actividad = filter_input(INPUT_POST, 'id_actividad', FILTER_VALIDATE_INT);
$dia_semana = $_POST['dia_semana'] ?? '';
$hora = $_POST['hora'] ?? '';

$dias_validos = [
    "Lunes", "Martes", "Miércoles", "Jueves",
    "Viernes", "Sabado", "Domingo"
];

if (!$id_horario || $id_horario <= 0 ||
    !$id_actividad || $id_actividad <= 0 ||
    !in_array($dia_semana, $dias_validos, true) ||
    !preg_match('/^([01][0-9]|2[0-3]):[0-5][0-9]$/', $hora)) {

    exit("Los datos ingresados no son válidos.");
}

// Comprobar que la actividad exista
$consulta_actividad = "SELECT id_actividad
                       FROM actividades
                       WHERE id_actividad = ?";

$preparar_actividad = mysqli_prepare($conexion, $consulta_actividad);
mysqli_stmt_bind_param($preparar_actividad, "i", $id_actividad);
mysqli_stmt_execute($preparar_actividad);

$resultado_actividad = mysqli_stmt_get_result($preparar_actividad);

if (mysqli_num_rows($resultado_actividad) === 0) {
    exit("La actividad seleccionada no existe.");
}

// Actualizar el horario
$consulta = "UPDATE horarios
             SET id_actividad = ?, dia_semana = ?, hora = ?
             WHERE id_horario = ?";

$preparar = mysqli_prepare($conexion, $consulta);

mysqli_stmt_bind_param(
    $preparar,
    "issi",
    $id_actividad,
    $dia_semana,
    $hora,
    $id_horario
);

if (mysqli_stmt_execute($preparar)) {
    header("Location: admin-horarios.php");
    exit();
} else {
    echo "No se pudo actualizar el horario.";
}
?>