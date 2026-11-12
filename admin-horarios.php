<?php
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administrar horarios | AA Fitness</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <h1 class="mb-4">Administrar horarios</h1>

        <a href="admin-reservas.php" class="btn btn-secondary mb-4">
            Volver al panel
        </a>

<?php
$conexion = mysqli_connect("localhost", "root", "", "aa_fitness")
or exit("No se pudo conectar con la base de datos");

$consulta_actividades = "SELECT id_actividad, nombre
                         FROM actividades
                         ORDER BY id_actividad";

$resultado_actividades = mysqli_query($conexion, $consulta_actividades);

$actividadesBD = mysqli_fetch_all($resultado_actividades, MYSQLI_ASSOC);
?>

<h2 class="h4 mt-4 mb-3">Agregar nuevo horario</h2>

<form action="agregar-horario.php" method="POST" class="mb-5">

    <div class="mb-3">
        <label class="form-label">Actividad</label>

        <select name="id_actividad" class="form-select" required>

    <?php foreach ($actividadesBD as $actividad) { ?>

        <option value="<?php echo (int)$actividad['id_actividad']; ?>">
            <?php echo htmlspecialchars($actividad['nombre']); ?>
        </option>

    <?php } ?>

</select>
    </div>

    <div class="mb-3">
        <label class="form-label">Día de la semana</label>

        <select name="dia_semana" class="form-select" required>
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miércoles">Miércoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sabado">Sábado</option>
            <option value="Domingo">Domingo</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Hora</label>
        <input type="time" name="hora" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">
        Agregar horario
    </button>

</form>
        <?php
        $conexion = mysqli_connect("localhost", "root", "", "aa_fitness")
        or exit("No se pudo conectar con la base de datos");
        $consulta_actividades = "SELECT id_actividad, nombre
                         FROM actividades
                         ORDER BY id_actividad";

$resultado_actividades = mysqli_query($conexion, $consulta_actividades);

$actividadesBD = mysqli_fetch_all($resultado_actividades, MYSQLI_ASSOC);

        $consulta = "SELECT
                        horarios.id_horario,
                        actividades.nombre AS actividad,
                        horarios.dia_semana,
                        horarios.hora,
                        horarios.disponible
                    FROM horarios
                    INNER JOIN actividades
                        ON horarios.id_actividad = actividades.id_actividad
                    ORDER BY horarios.id_horario";

        $resultado = mysqli_query($conexion, $consulta);
        ?>

        <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover">

                <tr>
                    <th>Actividad</th>
                    <th>Día</th>
                    <th>Horario</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>

                <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>

                    <tr>
                        <td><?php echo htmlspecialchars($fila['actividad']); ?></td>

                        <td><?php echo htmlspecialchars($fila['dia_semana']); ?></td>

                        <td><?php echo htmlspecialchars($fila['hora']); ?></td>

                        <td>
                            <?php
                            if ($fila['disponible'] == 1) {
                                echo "Disponible";
                            } else {
                                echo "No disponible";
                            }
                            ?>
                        </td>
                        <td>
    <div class="d-flex gap-2">

        <a href="editar-horario.php?id=<?php echo (int)$fila['id_horario']; ?>"
           class="btn btn-primary btn-sm">
            Editar
        </a>

        <form action="cambiar-disponibilidad.php" method="POST">

            <input type="hidden" name="id_horario"
                   value="<?php echo (int)$fila['id_horario']; ?>">

            <button type="submit" class="btn btn-sm <?php echo $fila['disponible'] == 1 ? 'btn-danger' : 'btn-success'; ?>">
                <?php echo $fila['disponible'] == 1 ? 'Desactivar' : 'Activar'; ?>
            </button>

        </form>

    </div>
</td>
                    </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</body>
</html>