<?php

$nombre_apellido = $_POST['nombre_apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$id_actividad = $_POST['id_actividad'];
$fecha_prueba = $_POST['fecha_prueba'];
$id_horario = $_POST['id_horario'];

$conexion = mysqli_connect("localhost", "root", "", "aa_fitness")
or exit("No se pudo conectar con la base de datos");

$consulta_horario = "SELECT id_actividad
                     FROM horarios
                     WHERE id_horario = ? AND disponible = 1";

$preparar_horario = mysqli_prepare($conexion, $consulta_horario);

mysqli_stmt_bind_param($preparar_horario, "i", $id_horario);

mysqli_stmt_execute($preparar_horario);

$resultado_horario = mysqli_stmt_get_result($preparar_horario);

$fila_horario = mysqli_fetch_assoc($resultado_horario);

if (!$fila_horario || $fila_horario['id_actividad'] != $id_actividad) {
    exit("Error: el horario seleccionado no corresponde a la actividad elegida.");
}
// Consultar el día correspondiente al horario
$consulta_dia = "SELECT dia_semana FROM horarios WHERE id_horario = ?";

$preparar_dia = mysqli_prepare($conexion, $consulta_dia);

mysqli_stmt_bind_param($preparar_dia, "i", $id_horario);

mysqli_stmt_execute($preparar_dia);

$resultado_dia = mysqli_stmt_get_result($preparar_dia);

$fila_dia = mysqli_fetch_assoc($resultado_dia);

// Validar el formato de la fecha
$fecha = DateTime::createFromFormat('!Y-m-d', $fecha_prueba);

if (!$fecha || $fecha->format('Y-m-d') !== $fecha_prueba) {
    exit("Error: la fecha ingresada no es válida.");
}

// Impedir fechas pasadas
$hoy = new DateTime('today');

if ($fecha < $hoy) {
    exit("Error: no podés reservar una clase en una fecha pasada.");
}

// Obtener el día de la semana
$dias = [
    1 => "Lunes",
    2 => "Martes",
    3 => "Miércoles",
    4 => "Jueves",
    5 => "Viernes",
    6 => "Sabado",
    7 => "Domingo"
];

$dia_seleccionado = $dias[(int)$fecha->format('N')];

// Comprobar que coincida con el horario
if (mb_strtolower($dia_seleccionado) !== mb_strtolower($fila_dia['dia_semana'])) {
    exit("Error: la fecha seleccionada no coincide con el día de la clase.");
}
$consulta = "INSERT INTO reservas (nombre, email, telefono, id_horario, fecha_clase)
VALUES (?, ?, ?, ?, ?)";

$preparar = mysqli_prepare($conexion, $consulta);

mysqli_stmt_bind_param(
    $preparar,
    "sssis",
    $nombre_apellido,
    $email,
    $telefono,
    $id_horario,
    $fecha_prueba
);

$resultado = mysqli_stmt_execute($preparar);

if ($resultado) {
    header("Location: reserva-exitosa.php");
    exit();
} else {
    echo "No se pudo registrar la reserva. Intentá nuevamente.";
}
?>