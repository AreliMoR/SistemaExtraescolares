# Sistema Extraescolares

Sistema web para gestionar actividades extraescolares (talleres) con roles de alumno, instructor y admin. Incluye inscripciones, control de talleres, exportacion de alumnos y generacion de constancias en PDF.

## Stack
- Laravel 11 (PHP 8.2)
- Vite + Tailwind + Alpine
- MySQL o SQLite
- FPDI/FPDF para constancias

## Requisitos
- PHP 8.2+
- Composer
- Node.js + npm
- Base de datos (MySQL o SQLite)

## Instalacion rapida
1) Entra al proyecto Laravel:

```bash
cd SistemaExtraescolares
```

2) Instala dependencias:

```bash
composer install
npm install
```

3) Configura el entorno:

```bash
cp .env.example .env
php artisan key:generate
```

4) Ajusta la conexion a la base de datos en `.env` y ejecuta migraciones:

```bash
php artisan migrate
```

5) Crea el enlace a `storage` y prepara la plantilla de constancia:

```bash
php artisan storage:link
```

- Coloca la plantilla en `storage/app/public/certificados/plantilla.pdf`.

6) Arranca el proyecto:

```bash
php artisan serve
npm run dev
```

## Como funciona
- Autenticacion con Laravel Breeze. El tipo de usuario esta en `users.user_type`.
- El dashboard cambia segun el rol:
  - `alumno`: ve talleres disponibles, se inscribe y consulta detalles del taller.
  - `instructor`: ve sus talleres y la lista de alumnos inscritos.
  - `admin`: gestiona estudiantes, talleres, instructores y directivos.
- Inscripcion de alumnos en talleres mediante relacion many-to-many (`student_taller`).
- Exportacion de alumnos a CSV desde `/export/alumnos/csv`.
- Generacion de constancias en PDF desde `/student/{studentId}/generate-certificate/{tallerId}`.

## Modelo de datos (resumen)
- `User` -> `Student` / `Instructor` / `Admin` (1:1 por rol)
- `Taller` pertenece a un `Instructor` (por `user_id`)
- `Student` <-> `Taller` (many-to-many) en `student_taller`
- `Directivo` es un catalogo independiente
- `folios` guarda el folio incremental de constancias

## Rutas principales
- `/dashboard` (segun rol)
- `/talleres` CRUD de talleres
- `/instructores` CRUD de instructores
- `/directivos` CRUD de directivos
- `/export/alumnos/csv` exportacion CSV

## Notas
- Si la constancia no se genera, revisa que exista `storage/app/public/certificados/plantilla.pdf` y permisos de escritura.
- La configuracion de correo y colas depende del entorno.
