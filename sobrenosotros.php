<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros</title>

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
        <a class="navbar-brand" href="index.html">
            <img src="img/logo.png" alt="logo" class="logo">
        </a>

        <!-- BOTÓN MOBILE -->
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
                    <a class="nav-link active" href="sobrenosotros.php">
                        Vení a entrenar
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="actividades.php">
                        Actividades
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="clasesyhorarios.php">
                        Clases y horarios
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="planesyprecios.php">
                        Planes y precios
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>
 <!-- SOBRE NOSOTROS -->
<section class="about-section py-5">
    <div class="container text-center">

        <h2 class="fw-bold mb-4">Sobre AA FITNESS</h2>

        <p class="about-text mx-auto mb-5">
            En AA Fitness creemos que entrenar va mucho más allá de lo físico:
            es un espacio para superarte, desconectarte de la rutina y conectar
            con tu mejor versión. Somos un gimnasio pensado para acompañarte en
            cada etapa de tu entrenamiento, ya sea que estés dando tus primeros
            pasos o buscando llevar tu rendimiento al siguiente nivel.
        </p>

        <h3 class="fw-bold mb-5">Nuestros profes</h3>

        <div class="row justify-content-center g-4">

            <!-- PROFE 1 -->
            <div class="col-md-4">
                <div class="coach-card">
                    <h4 class="mb-3">Agustín García</h4>
                    <img src="img/profe1.jpg" alt="Agustín García" class="img-fluid">
                </div>
            </div>

            <!-- PROFE 2 -->
            <div class="col-md-4">
                <div class="coach-card">
                    <h4 class="mb-3">Camila Vega</h4>
                    <img src="img/profe2.jpg" alt="Camila Vega" class="img-fluid">
                </div>
            </div>

            <!-- PROFE 3 -->
            <div class="col-md-4">
                <div class="coach-card">
                    <h4 class="mb-3">Mateo Ferrer</h4>
                    <img src="img/profe3.jpg" alt="Mateo Ferrer" class="img-fluid">
                </div>
            </div>

        </div>

    </div>
</section>

<footer class="footer">

     <div class="container">

        <div class="row text-center text-md-start">

            <!-- LOGO -->
            <div class="col-md-4 mb-4">

                <h3 class="footer-logo">
                    AA FITNESS
                </h3>

                <p>
                    Entrená tu mejor versión.
                    Fuerza, disciplina y constancia.
                </p>

            </div>

            <!-- CONTACTO -->
            <div class="col-md-4 mb-4">

                <h4>Contacto</h4>

                <p>
                    <i class="bi bi-geo-alt-fill"></i>
                    Blanco Encalada 5210
                </p>

                <p>
                    <i class="bi bi-whatsapp"></i>
                    11 4040 9999
                </p>

                <p>
                    <i class="bi bi-envelope-fill"></i>
                    aafitness@gmail.com
                </p>

            </div>

            <!-- REDES -->
            <div class="col-md-4 mb-4">

                <h4>Seguinos</h4>

                <div class="redes">

                    <a href="#">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a href="#">
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a href="#">
                        <i class="bi bi-tiktok"></i>
                    </a>

                </div>

            </div>

        </div>

        <!-- COPYRIGHT -->

        <div class="footer-bottom text-center">

            <p>
                © 2026 AA FITNESS - Todos los derechos reservados
            </p>

        </div>

    </div>

</footer>
</body>
</html>