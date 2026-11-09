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

    <title>Panel de administración | AA Fitness</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark menu">
        <div class="container">

            <!-- LOGO -->
           <a class="navbar-brand" href="#">
    <img src="img/logo.png" alt="logo" class="logo">
</a>

            <!-- BOTON MOBILE -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- ITEMS -->
            <div class="collapse navbar-collapse" id="menu">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="sobrenosotros.html">Vení a entrenar</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="actividades.html">Actividades</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="clasesyhorarios.html">Clases y horarios</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="planesyprecios.html">Planes y precios</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <div class="container py-5">
        <h1 class="mb-4">Panel de administración</h1>

<a href="admin-horarios.php" class="btn btn-primary mb-4">
    Administrar horarios
</a>

<a href="cerrar-sesion.php" class="btn btn-danger mb-4">
    Cerrar sesión
</a>

<h2 class="h4 mb-3">Reservas de clases</h2>
<?php

$conexion = mysqli_connect("localhost", "root", "", "aa_fitness")
or exit("No se pudo conectar con la base de datos");

$consulta = "SELECT
    reservas.id_reserva,
    reservas.nombre,
    reservas.email,
    reservas.telefono,
    reservas.fecha_clase,
    actividades.nombre AS actividad,
    horarios.dia_semana,
    horarios.hora
FROM reservas
INNER JOIN horarios
    ON reservas.id_horario = horarios.id_horario
INNER JOIN actividades
    ON horarios.id_actividad = actividades.id_actividad";


$resultado = mysqli_query($conexion, $consulta);
echo "<div class='table-responsive'>";
echo "<table class='table table-striped table-bordered table-hover'>";

echo "<tr>
        <th>Nombre y apellido</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Fecha de clase</th>
        <th>Actividad</th>
        <th>Día</th>
        <th>Horario</th>
        <th>Acciones</th>
      </tr>";

while ($fila = mysqli_fetch_array($resultado)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['email']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['telefono']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['fecha_clase']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['actividad']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['dia_semana']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['hora']) . "</td>";
    echo "<td>
        <form action='eliminar-reserva.php' method='POST'
              onsubmit=\"return confirm('¿Estás seguro de eliminar esta reserva?');\">

            <input type='hidden' name='id_reserva'
                   value='" . (int)$fila['id_reserva'] . "'>

            <button type='submit' class='btn btn-danger btn-sm'>
                Eliminar
            </button>

        </form>
      </td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>