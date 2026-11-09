<?php
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

$conexion = mysqli_connect("localhost", "root", "", "aa_fitness")
or exit("No se pudo conectar con la base de datos");

$id_horario = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id_horario || $id_horario <= 0) {
    exit("El horario seleccionado no es válido.");
}

$consulta = "SELECT id_horario, id_actividad, dia_semana, hora
             FROM horarios
             WHERE id_horario = ?";

$preparar = mysqli_prepare($conexion, $consulta);
mysqli_stmt_bind_param($preparar, "i", $id_horario);
mysqli_stmt_execute($preparar);

$resultado = mysqli_stmt_get_result($preparar);
$horario = mysqli_fetch_assoc($resultado);

if (!$horario) {
    exit("No se encontró el horario.");
}
$consulta_actividades = "SELECT id_actividad, nombre
                         FROM actividades
                         ORDER BY id_actividad";

$resultado_actividades = mysqli_query($conexion, $consulta_actividades);

$actividadesBD = mysqli_fetch_all($resultado_actividades, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar horario | AA Fitness</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <h1 class="mb-4">Editar horario</h1>

        <form action="guardar-horario.php" method="POST">

            <input type="hidden" name="id_horario"
                   value="<?php echo (int)$horario['id_horario']; ?>">

            <div class="mb-3">
                <label class="form-label">Actividad</label>

                <select name="id_actividad" class="form-select" required>

                    <?php foreach ($actividadesBD as $actividad) { ?>

    <option
        value="<?php echo (int)$actividad['id_actividad']; ?>"
        <?php echo $horario['id_actividad'] == $actividad['id_actividad'] ? 'selected' : ''; ?>>

        <?php echo htmlspecialchars($actividad['nombre']); ?>

    </option>

<?php } ?>

                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Día de la semana</label>

                <select name="dia_semana" class="form-select" required>

                    <?php
                    $dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sabado", "Domingo"];

                    foreach ($dias as $dia) {
                        $seleccionado = $horario['dia_semana'] === $dia ? 'selected' : '';

                        echo "<option value='" . htmlspecialchars($dia) . "' $seleccionado>"
                             . htmlspecialchars($dia) . "</option>";
                    }
                    ?>

                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Hora</label>

                <input type="time" name="hora" class="form-control"
                       value="<?php echo htmlspecialchars(substr($horario['hora'], 0, 5)); ?>"
                       required>
            </div>

            <button type="submit" class="btn btn-success">
                Guardar cambios
            </button>

            <a href="admin-horarios.php" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>

</body>
</html>