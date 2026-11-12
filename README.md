# AA Fitness 💜💜

**Sitio web para un gimnasio con sistema de reservas de clases y panel de administración.**

AA Fitness es un proyecto desarrollado para la materia **Contenidos y Creatividad II** de la **Universidad de Palermo**.

El sitio combina páginas informativas con funcionalidades dinámicas desarrolladas mediante PHP, JavaScript y una base de datos MySQL. Permite a los usuarios reservar clases y a los administradores gestionar las reservas y los horarios disponibles.

> **Importante:** este repositorio contiene el código fuente del proyecto. Para utilizar las funcionalidades desarrolladas en PHP y MySQL es necesario ejecutarlo en un servidor compatible, como XAMPP. GitHub Pages no permite ejecutar directamente estas tecnologías.

---

## 1. Funcionalidades principales

### Sitio público

- Navegación entre las distintas secciones del gimnasio.
- Información sobre actividades, clases, horarios, planes y precios.
- Formulario para reservar una primera clase de CrossFit o Funcional.
- Carga dinámica de horarios disponibles desde MySQL.
- Filtrado de horarios según la actividad seleccionada.
- Validación de la fecha elegida según el día de la clase.
- Registro de reservas en la base de datos.
- Página de confirmación al completar una reserva.

### Panel de administración

- Inicio de sesión para administradores.
- Protección de las páginas administrativas mediante sesiones de PHP.
- Visualización de las reservas registradas.
- Eliminación de reservas.
- Incorporación de nuevos horarios.
- Edición de horarios existentes.
- Activación y desactivación de horarios.
- Cierre de sesión.

---

## 2. Navegación por las vistas

El sitio cuenta con una barra de navegación que permite acceder a las diferentes secciones públicas.

### Vistas disponibles

| Vista | Descripción |
| --- | --- |
| Inicio | Presentación general del gimnasio y acceso a las principales secciones. |
| Vení a entrenar | Información sobre AA Fitness y su propuesta. |
| Actividades | Presentación de las actividades disponibles. |
| Clases y horarios | Información sobre las clases y sus horarios. |
| Planes y precios | Presentación de los planes ofrecidos por el gimnasio. |
| Reservar clase | Formulario para solicitar una primera clase. |

### ¿Cómo navegar por el sitio?

1. Ingresar a la página principal `index.html`.
2. Utilizar la barra de navegación superior para seleccionar una sección.
3. Hacer clic en cualquiera de los enlaces para acceder a su contenido.
4. Para regresar al inicio, seleccionar **Inicio** o hacer clic en el logo de AA Fitness.

La navegación se mantiene entre las distintas páginas públicas del sitio.

El panel de administración también incluye la barra de navegación, lo que permite regresar a las secciones públicas sin necesidad de cerrar sesión.

---

## 3. Envío del formulario de reservas

AA Fitness permite solicitar una primera clase mediante un formulario conectado a MySQL.

### ¿Cómo realizar una reserva?

1. Ingresar a la sección **Reservar clase** desde la barra de navegación.
2. Completar los datos personales:
   - Nombre y apellido.
   - Correo electrónico.
   - Teléfono.
3. Seleccionar una actividad: **CrossFit** o **Funcional**.
4. Elegir uno de los horarios disponibles.
5. Seleccionar la fecha en la que se desea realizar la clase.
6. Enviar el formulario para confirmar la reserva.

### Funcionamiento del formulario

El formulario se encuentra en el archivo `reservar.php`.

Mediante PHP, el sistema consulta los horarios registrados en la base de datos y obtiene aquellos que se encuentran disponibles.

JavaScript permite filtrar los horarios según la actividad seleccionada.

Además, el sistema comprueba que la fecha elegida coincida con el día correspondiente al horario seleccionado.

Por ejemplo, si el usuario selecciona un horario correspondiente al lunes, deberá elegir una fecha que también sea lunes.

### Procesamiento de la reserva

Cuando el usuario envía el formulario:

1. Los datos son enviados a `procesar-reserva.php`.
2. PHP recibe y valida la información.
3. Se comprueba que el horario seleccionado corresponda a la actividad y fecha indicadas.
4. La reserva se registra en la tabla `reservas` de MySQL.
5. Si el registro se completa correctamente, el usuario es redirigido a `reserva-exitosa.php`.

Esta última página muestra un mensaje de confirmación y permite regresar al inicio del sitio.

---

## 4. Acceso a la zona segura mediante sesiones

AA Fitness cuenta con una zona de administración protegida mediante sesiones de PHP.

Esta sección permite gestionar información del gimnasio y está destinada exclusivamente a usuarios administradores.

### ¿Cómo ingresar a la zona segura?

1. Acceder a `login.php` desde el enlace de administración del sitio.
2. Ingresar el nombre de usuario y la contraseña correspondientes a un administrador registrado.
3. Enviar el formulario de inicio de sesión.
4. El archivo `procesar-login.php` recibe y verifica las credenciales.
5. Si los datos son correctos, se inicia una sesión de PHP.
6. El administrador puede acceder al panel de administración.

### Funcionamiento de las sesiones

Las sesiones permiten identificar al administrador durante su navegación por las páginas protegidas.

Cuando un administrador inicia sesión correctamente, PHP almacena su identificación en una variable de sesión:

```php
$_SESSION['id_admin']
```

Las páginas administrativas comprueban que esta variable exista antes de permitir el acceso.

Por ejemplo:

```php
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}
```

De esta manera, si un usuario intenta ingresar directamente a una página administrativa sin haber iniciado sesión, será redirigido a `login.php`.

### Funcionalidades de la zona segura

Una vez dentro del panel, el administrador puede:

- Consultar las reservas registradas.
- Visualizar los datos de los usuarios que reservaron clases.
- Eliminar reservas existentes.
- Acceder a la administración de horarios.
- Agregar nuevos horarios.
- Editar horarios.
- Activar o desactivar horarios disponibles.

Los horarios desactivados dejan de aparecer como opciones en el formulario público de reservas.

### Cierre de sesión

Para salir de la zona segura, el administrador debe seleccionar **Cerrar sesión**.

Esta acción ejecuta `cerrar-sesion.php`, que finaliza la sesión activa.

Una vez cerrada, el usuario deberá volver a iniciar sesión para acceder a las páginas protegidas.

---

## 5. Tecnologías utilizadas

| Tecnología | Uso en el proyecto |
| --- | --- |
| HTML5 | Estructura de las páginas públicas. |
| CSS3 | Diseño e identidad visual. |
| Bootstrap 5 | Componentes visuales y adaptación a diferentes pantallas. |
| JavaScript | Interacción y filtrado dinámico del formulario. |
| PHP | Procesamiento de formularios, sesiones y conexión con MySQL. |
| MySQL | Almacenamiento de actividades, horarios, reservas y administradores. |
| XAMPP | Entorno de desarrollo local con Apache y MySQL. |
| Git y GitHub | Control de versiones y almacenamiento del código fuente. |

---

## 6. Base de datos

El proyecto utiliza una base de datos MySQL llamada:

```sql
aa_fitness
```

Está organizada en cuatro tablas principales.

| Tabla | Función |
| --- | --- |
| `actividades` | Almacena las actividades ofrecidas por el gimnasio. |
| `horarios` | Registra los días, horas, actividades y disponibilidad de las clases. |
| `reservas` | Guarda los datos de las personas que reservan clases. |
| `administradores` | Almacena la información necesaria para acceder al panel administrativo. |

### Relaciones entre tablas

La tabla `horarios` se relaciona con `actividades` mediante el identificador de la actividad.

La tabla `reservas` se relaciona con `horarios` mediante el identificador del horario seleccionado.

Esto permite consultar qué actividad y horario corresponden a cada reserva.

### Operaciones realizadas

El sitio utiliza consultas SQL para:

- Consultar actividades y horarios disponibles.
- Registrar nuevas reservas.
- Consultar las reservas realizadas.
- Eliminar reservas.
- Agregar nuevos horarios.
- Actualizar horarios existentes.
- Modificar su disponibilidad.
- Verificar los datos de acceso de los administradores.

---

## 7. Instalación y ejecución local

Para ejecutar AA Fitness es necesario contar con un entorno compatible con PHP y MySQL.

### Requisitos

- XAMPP o un servidor equivalente.
- Apache.
- PHP.
- MySQL.
- Navegador web.

### Pasos de instalación

**1. Descargar el proyecto**

Clonar o descargar este repositorio desde GitHub.

**2. Ubicar los archivos**

Copiar la carpeta del proyecto dentro del directorio `htdocs` de XAMPP.

Por ejemplo:

```text
C:\xampp\htdocs\aafitness.php
```

**3. Iniciar los servicios**

Abrir XAMPP e iniciar:

- Apache.
- MySQL.

**4. Crear la base de datos**

Ingresar a phpMyAdmin:

```text
http://localhost/phpmyadmin/
```

Crear una base de datos llamada:

```text
aa_fitness
```

Importar el archivo SQL correspondiente desde la carpeta `basededatos` del repositorio.

**5. Verificar la conexión**

Comprobar que los datos de conexión utilizados por los archivos PHP coincidan con la configuración local de MySQL.

En el entorno utilizado durante el desarrollo:

```text
Servidor: localhost
Usuario: root
Contraseña: vacía
Base de datos: aa_fitness
```

Estos valores corresponden al entorno local de desarrollo y pueden variar según la configuración del servidor.

**6. Abrir el sitio**

Ingresar desde el navegador a:

```text
http://localhost/aafitness.php/index.html
```

Si la carpeta del proyecto tiene otro nombre, se deberá modificar la dirección correspondiente.

**7. Acceder al panel administrativo**

Ingresar a `login.php` desde el enlace de administración del sitio.

Para utilizar esta sección es necesario contar con un administrador registrado en la base de datos.

Las credenciales de acceso no se incluyen en este README.

---

## 8. Estructura de archivos

### Páginas públicas

| Archivo | Descripción |
| --- | --- |
| `index.html` | Página principal. |
| `sobrenosotros.html` | Sección Vení a entrenar. |
| `actividades.html` | Información sobre actividades. |
| `clasesyhorarios.html` | Información de clases y horarios. |
| `planesyprecios.html` | Planes y precios. |
| `reservar.php` | Formulario de reserva. |

### Sistema de reservas

| Archivo | Descripción |
| --- | --- |
| `procesar-reserva.php` | Recibe, valida y registra las reservas. |
| `reserva-exitosa.php` | Muestra la confirmación de la reserva. |

### Sistema de administración

| Archivo | Descripción |
| --- | --- |
| `login.php` | Formulario de acceso administrativo. |
| `procesar-login.php` | Verificación de credenciales e inicio de sesión. |
| `admin-reservas.php` | Panel principal y listado de reservas. |
| `eliminar-reserva.php` | Eliminación de reservas. |
| `admin-horarios.php` | Administración de horarios. |
| `agregar-horario.php` | Registro de nuevos horarios. |
| `editar-horario.php` | Formulario para editar horarios. |
| `guardar-horario.php` | Actualización de horarios en MySQL. |
| `cambiar-disponibilidad.php` | Activación y desactivación de horarios. |
| `cerrar-sesion.php` | Cierre de sesión del administrador. |

### Recursos adicionales

| Carpeta | Contenido |
| --- | --- |
| `css/` | Hojas de estilo del sitio. |
| `img/` | Imágenes y recursos visuales. |
| `basededatos/` | Archivos de la base de datos del proyecto. |

---

## 9. Funcionamiento general del sistema

### Flujo de reservas

```text
Usuario
   |
   v
Formulario de reserva
   |
   v
Selección de actividad, horario y fecha
   |
   v
Validación de datos
   |
   v
Procesamiento mediante PHP
   |
   v
Registro en MySQL
   |
   v
Confirmación de reserva
```

### Flujo de administración

```text
Administrador
   |
   v
Formulario de login
   |
   v
Verificación de credenciales
   |
   v
Inicio de sesión PHP
   |
   v
Panel de administración
   |
   +----> Consultar y eliminar reservas
   |
   +----> Agregar y editar horarios
   |
   +----> Activar y desactivar horarios
   |
   v
Cerrar sesión
```

---

## 10. Contexto académico

**Proyecto:** AA Fitness

**Materia:** Contenidos y Creatividad II

**Universidad:** Universidad de Palermo

**Docente:** Guido Varela Coletta

El proyecto fue desarrollado como parte de una actividad académica orientada a la creación de sitios web dinámicos.

El trabajo permitió integrar HTML, CSS, Bootstrap, JavaScript, PHP y MySQL para desarrollar un sistema que combina la navegación pública con formularios conectados a una base de datos y una zona de administración protegida mediante sesiones.

---

**AA Fitness — Proyecto académico de desarrollo web.**
