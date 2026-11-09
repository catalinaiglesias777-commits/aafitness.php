<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | AA Fitness</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="text-center mb-4">
              <img src="img/logo.png" alt="Logo de AA Fitness" class="login-logo">
        </div>

        <h2 class="text-center h4 mb-4 login-titulo">Acceso de administradores</h2>

        <div class="row justify-content-center">
            <div class="col-md-5 login-card">

                <form action="procesar-login.php" method="POST">

                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control"
                               id="usuario" name="usuario" required>
                    </div>

                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" class="form-control"
                               id="contrasena" name="contrasena" required>
                    </div>

                    <button type="submit" class="btn login-btn w-100">
                              Iniciar sesión
                    </button>

                </form>

            </div>
        </div>

    </div>

</body>
</html>