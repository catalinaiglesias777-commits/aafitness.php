
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once "conexion.php";

$mensaje = "";
$error = "";

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telefono = trim($_POST["telefono"] ?? "");
    $id_horario = filter_input(INPUT_POST, "id_horario", FILTER_VALIDATE_INT);
    $fecha_clase = $_POST["fecha_clase"] ?? "";

    // Validar los datos recibidos
    if (
        $nombre === "" ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        $telefono === "" ||
        !$id_horario ||
        $fecha_clase === ""
    ) {
        $error = "Por favor, completá todos los campos correctamente.";
    } else {

        // Verificar que el horario exista y esté disponible
        $consulta = mysqli_prepare(
            $conexion,
            "SELECT id_horario FROM horarios
             WHERE id_horario = ? AND disponible = 1"
        );

        mysqli_stmt_bind_param($consulta, "i", $id_horario);
        mysqli_stmt_execute($consulta);

        $resultado = mysqli_stmt_get_result($consulta);

        if (mysqli_num_rows($resultado) === 0) {

            $error = "El horario seleccionado no está disponible.";

        } else {

            // Guardar la reserva en MySQL
            $sql = "INSERT INTO reservas
                    (nombre, email, telefono, id_horario, fecha_clase)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conexion, $sql);

            mysqli_stmt_bind_param(
                $stmt,
                "sssis",
                $nombre,
                $email,
                $telefono,
                $id_horario,
                $fecha_clase
            );

            if (mysqli_stmt_execute($stmt)) {
                $mensaje = "¡Tu reserva fue registrada correctamente!";
            } else {
                $error = "No se pudo registrar la reserva. Intentá nuevamente.";
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($consulta);
    }
}

// Obtener horarios disponibles para mostrar en el formulario
$sql_horarios = "SELECT
                    horarios.id_horario,
                    horarios.dia_semana,
                    horarios.hora,
                    actividades.nombre AS actividad

                 FROM horarios

                 INNER JOIN actividades
                 ON horarios.id_actividad = actividades.id_actividad

                 WHERE horarios.disponible = 1

                 ORDER BY horarios.dia_semana, horarios.hora";

$resultado_horarios = mysqli_query($conexion, $sql_horarios);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva tu clase</title>

    <!-- Bootstrap -->
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   
 <!-- CSS -->
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <!-- NAVBAR -->
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
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="sobrenosotros.php">Vení a entrenar</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="actividades.php">Actividades</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="clasesyhorarios.php">Clases y horarios</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="planesyprecios.php">Planes y precios</a>
                    </li>

                    <li class="nav-item">
    <a class="nav-link active" href="reservar.php">
        Reservar Clase
    </a>
</li>

                </ul>

            </div>
        </div>
    </nav>

    <section class="py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h1 class="fw-bold">
                Reservá tu Clase Gratuita
            </h1>

            <p>
                Completá tus datos y elegí el día para conocernos.
            </p>

        </div>

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card shadow p-4">

                  
<form action="reservar.php" method="POST">

    <!-- MENSAJES DE CONFIRMACION O ERROR -->

    <?php if ($mensaje !== "") { ?>

        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>

    <?php } ?>

    <?php if ($error !== "") { ?>

        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($error); ?>
        </div>

    <?php } ?>


    <!-- NOMBRE -->

    <div class="mb-3">

        <label class="form-label">
            Nombre y Apellido
        </label>

        <input
            type="text"
            name="nombre"
            class="form-control"
            placeholder="Ingresá tu nombre completo"
            required>

    </div>


    <!-- EMAIL -->

    <div class="mb-3">

        <label class="form-label">
            Email
        </label>

        <input
            type="email"
            name="email"
            class="form-control"
            placeholder="ejemplo@email.com"
            required>

    </div>


    <!-- TELEFONO -->

    <div class="mb-3">

        <label class="form-label">
            Teléfono
        </label>

        <input
            type="tel"
            name="telefono"
            class="form-control"
            placeholder="11 1234 5678"
            required>

    </div>


    <!-- FECHA -->

    <div class="mb-3">

        <label class="form-label">
            Fecha de prueba
        </label>

        <input
            type="date"
            name="fecha_clase"
            class="form-control"
            min="<?php echo date('Y-m-d'); ?>"
            required>

    </div>


    <!-- ACTIVIDAD Y HORARIO -->

    <div class="mb-4">

        <label class="form-label">
            Actividad, día y horario
        </label>

        <select
            name="id_horario"
            class="form-select"
            required>

            <option value="" selected disabled>
                Seleccioná una clase y horario
            </option>

            <?php while ($horario = mysqli_fetch_assoc($resultado_horarios)) { ?>

                <option value="<?php echo $horario['id_horario']; ?>">

                    <?php
                    echo htmlspecialchars(
                        $horario['actividad'] . " - " .
                        $horario['dia_semana'] . " - " .
                        substr($horario['hora'], 0, 5) . " hs"
                    );
                    ?>

                </option>

            <?php } ?>

        </select>

    </div>


    <!-- BOTON -->

    <div class="text-center">

        <button
            type="submit"
            class="btn btn-dark btn-lg">

            RESERVAR CLASE

        </button>

    </div>

</form>

                </div>

            </div>

        </div>

    </div>

</section>
    
</body>
</html>