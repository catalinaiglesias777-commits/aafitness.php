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

<?php
$conexion = mysqli_connect("localhost", "root", "", "aa_fitness")
or exit("No se pudo conectar con la base de datos");

$consulta = "SELECT id_horario, dia_semana, hora, id_actividad
             FROM horarios
             WHERE disponible = 1
             ORDER BY id_horario";

$resultado = mysqli_query($conexion, $consulta);

$horariosBD = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
$consulta_actividades = "SELECT id_actividad, nombre
                        FROM actividades
                        ORDER BY id_actividad";

$resultado_actividades = mysqli_query($conexion, $consulta_actividades);

$actividadesBD = mysqli_fetch_all($resultado_actividades, MYSQLI_ASSOC);
?>

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

    <form action="procesar-reserva.php" method="POST">

        <!-- MENSAJE DE RESERVA EXITOSA -->

        <?php if (isset($_GET['reserva']) && $_GET['reserva'] === 'exitosa') { ?>

            <div class="alert alert-success" role="alert">
                ¡Tu reserva fue registrada correctamente!
            </div>

        <?php } ?>

        <!-- NOMBRE -->

                        <div class="mb-3">

                            <label class="form-label">
                                Nombre y Apellido
                            </label>

                            <input
                                type="text"
                                name="nombre_apellido"
                                class="form-control"
                                placeholder="Ingresá tu nombre completo"
                                required>

                        </div>

                        <!-- MAIL -->

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

                        <!-- ACTIVIDAD -->

                        <div class="mb-3">

                            <label class="form-label">
                                Actividad de interés
                            </label>

                            <select class="form-select" name="id_actividad" id="actividad" required>

                                <option value="" selected disabled>
                                    Seleccioná una actividad
                                </option>

                                <?php foreach ($actividadesBD as $actividad) { ?>

    <option value="<?php echo (int)$actividad['id_actividad']; ?>">
        <?php echo htmlspecialchars($actividad['nombre']); ?>
    </option>

<?php } ?>
                            </select>

                        </div>

                        <!-- FECHA -->

                        <div class="mb-3">

                            <label class="form-label">
                                Fecha de prueba
                            </label>

                           <input
                                type="date"
                                name="fecha_prueba"
                                id="fecha"
                                class="form-control"
                                required>

                        </div>

                        <select class="form-select" name="id_horario" id="horario" required>

                            <option value="" selected disabled>
                            Primero seleccioná una actividad
                            </option>

                         </select>

                        <!-- BOTON -->

                        <div class="text-center">

                         <button type="submit" class="btn btn-dark btn-lg">
                            RESERVAR CLASE
                        </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>
     <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const actividad = document.getElementById("actividad");
    const horario = document.getElementById("horario");
    const fecha = document.getElementById("fecha");

    const hoy = new Date();

    const anio = hoy.getFullYear();
    const mes = String(hoy.getMonth() + 1).padStart(2, "0");
    const dia = String(hoy.getDate()).padStart(2, "0");

    const fechaHoy = `${anio}-${mes}-${dia}`;

    fecha.min = fechaHoy;

  const horariosBD = <?php echo json_encode($horariosBD); ?>;

const horarios = {};

horariosBD.forEach(function(item) {
    const idActividad = item.id_actividad;

    if (!horarios[idActividad]) {
        horarios[idActividad] = [];
    }

    horarios[idActividad].push({
        id: item.id_horario,
        texto: item.dia_semana + " - " + item.hora.substring(0, 5) + " hs"
    });
});

    actividad.addEventListener("change", function() {
        horario.innerHTML = '<option value="" selected disabled>Seleccioná un horario</option>';

        const horariosDisponibles = horarios[actividad.value] || [];

        horariosDisponibles.forEach(function(item) {
            const opcion = document.createElement("option");
            opcion.value = item.id;
            opcion.textContent = item.texto;
            horario.appendChild(opcion);
        });
    });

    horario.innerHTML = '<option value="" selected disabled>Primero seleccioná una actividad</option>';
const diasSemana = {
    "Domingo": 0,
    "Lunes": 1,
    "Martes": 2,
    "Miércoles": 3,
    "Miercoles": 3,
    "Jueves": 4,
    "Viernes": 5,
    "Sábado": 6,
    "Sabado": 6
};

const diasHorarios = {};

horariosBD.forEach(function(item) {
    diasHorarios[item.id_horario] = diasSemana[item.dia_semana];
});
function validarFecha() {
    fecha.setCustomValidity("");

    if (fecha.value === "" || horario.value === "") {
        return;
    }

    const partes = fecha.value.split("-").map(Number);
    const fechaSeleccionada = new Date(
        partes[0],
        partes[1] - 1,
        partes[2]
    );

    const diaSeleccionado = fechaSeleccionada.getDay();
    const diaPermitido = diasHorarios[horario.value];

    if (diaSeleccionado !== diaPermitido) {
        fecha.setCustomValidity(
            "La fecha seleccionada no coincide con el día de la clase."
        );
        fecha.reportValidity();
    }
}

fecha.addEventListener("change", validarFecha);
horario.addEventListener("change", validarFecha);
</script>
</body>
</html>