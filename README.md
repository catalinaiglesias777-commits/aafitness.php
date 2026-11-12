
# AA Fitness 💜💜

**Sitio web para un gimnasio con sistema de reservas de clases y panel de administración.**

AA Fitness es un proyecto desarrollado para la materia **Contenidos y Creatividad II** de la **Universidad de Palermo**. Combina páginas informativas con funcionalidades dinámicas desarrolladas en PHP y conectadas a una base de datos MySQL.

> **Importante:** este repositorio contiene el código fuente del proyecto. GitHub permite consultarlo y descargarlo, pero el sistema PHP/MySQL necesita un servidor compatible para funcionar; no se ejecuta directamente desde GitHub Pages.

## Funcionalidades

### Sitio público

- Páginas de **Inicio**, **Vení a entrenar**, **Actividades**, **Clases y horarios** y **Planes y precios**.
- Formulario para **reservar una clase** de CrossFit o Funcional.
- Carga de horarios disponibles desde MySQL y filtrado según la actividad seleccionada.
- Validación para que la fecha de la clase coincida con el día del horario elegido.
- Registro de las reservas en la base de datos y pantalla de confirmación.

### Panel de administración

- Inicio y cierre de sesión para administradores.
- Acceso protegido mediante sesiones de PHP.
- Visualización de las reservas registradas y posibilidad de eliminarlas.
- Gestión de horarios: **agregar, editar, activar y desactivar**.
- Los horarios desactivados dejan de mostrarse en el formulario de reservas.
- Barra de navegación hacia las secciones públicas del sitio.

## Tecnologías utilizadas

| Tecnología | Uso en el proyecto |
| --- | --- |
| HTML5 | Estructura de las páginas públicas |
| CSS3 | Estilos e identidad visual |
| Bootstrap 5 | Componentes y diseño adaptable |
| JavaScript | Interacción y filtrado de horarios en el formulario |
| PHP | Procesamiento de formularios, sesiones y operaciones con MySQL |
| MySQL | Almacenamiento de actividades, horarios, reservas y administradores |
| XAMPP | Entorno de desarrollo local (Apache y MySQL) |
| Git y GitHub | Control de versiones y repositorio del código |

## Base de datos

La base de datos utilizada se llama **`aa_fitness`** y se organiza en cuatro tablas principales:

| Tabla | Función |
| --- | --- |
| `actividades` | Actividades ofrecidas por el gimnasio |
| `horarios` | Días, horas, actividad asociada y disponibilidad |
| `reservas` | Datos de las reservas realizadas por los usuarios |
| `administradores` | Información de acceso al panel administrativo |

Las reservas se relacionan con los horarios y estos, a su vez, con las actividades.

## Instalación y ejecución local

**Requisitos:** XAMPP (o un entorno equivalente con Apache, PHP y MySQL) y un navegador web.

1. Clonar o descargar este repositorio.
2. Copiar la carpeta del proyecto dentro de `C:\xampp\htdocs\`.
3. Iniciar **Apache** y **MySQL** desde el panel de XAMPP.
4. Abrir **phpMyAdmin** en `http://localhost/phpmyadmin/`.
5. Crear una base de datos llamada **`aa_fitness`** e importar el archivo SQL correspondiente desde la carpeta `basededatos` del repositorio.
6. Verificar que la configuración de conexión MySQL de los archivos PHP coincida con el entorno local (servidor, usuario, contraseña y nombre de base de datos).
7. Acceder al sitio desde el navegador:

   ```text
   http://localhost/NOMBRE_DE_LA_CARPETA/index.html
   ```

   Reemplazar `NOMBRE_DE_LA_CARPETA` por el nombre real de la carpeta clonada en `htdocs`.

> Para utilizar el panel de administración se necesita un usuario administrador registrado en la base de datos. No se incluyen credenciales de acceso en este README.

## Archivos principales

| Archivo | Descripción |
| --- | --- |
| `index.html` | Página de inicio |
| `actividades.html` | Información de las actividades |
| `clasesyhorarios.html` | Información de clases y horarios |
| `planesyprecios.html` | Planes y precios |
| `sobrenosotros.html` | Presentación del gimnasio |
| `reservar.php` | Formulario de reserva de clases |
| `procesar-reserva.php` | Procesamiento y registro de reservas |
| `reserva-exitosa.php` | Confirmación de reserva |
| `login.php` y `procesar-login.php` | Acceso de administradores |
| `admin-reservas.php` | Panel y listado de reservas |
| `admin-horarios.php` | Administración de horarios |
| `agregar-horario.php` | Alta de horarios |
| `editar-horario.php` y `guardar-horario.php` | Edición de horarios |
| `cambiar-disponibilidad.php` | Activación y desactivación de horarios |
| `eliminar-reserva.php` | Eliminación de reservas |
| `cerrar-sesion.php` | Cierre de sesión |
| `css/` e `img/` | Estilos e imágenes del sitio |
| `basededatos/` | Archivos de la base de datos compartidos para el proyecto |

## Funcionamiento general

```text
Usuario → Formulario de reserva → PHP → MySQL → Confirmación
                                       ↑
Administrador → Inicio de sesión → Panel → Gestión de reservas y horarios
```

## Contexto académico

Proyecto realizado para **Contenidos y Creatividad II**, **Universidad de Palermo**, con el acompañamiento docente de **Guido Varela Coletta**.

**AA Fitness — Proyecto académico de desarrollo web.**

