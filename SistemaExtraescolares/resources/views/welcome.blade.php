<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<!-- Logos oficiales -->
<div class="logo-container">
    <div class="logo-left">
        <img src="{{ asset('images/tecnm.jpg') }}" alt="Logo Izquierdo" class="logo">
        <img src="{{ asset('images/LOGO-SEP.png') }}" alt="Logo Central" class="logo">
        <img src="{{ asset('images/itch.jpg') }}" alt="Logo Derecho" class="logo">
    </div>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Extraescolares</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8fafc; /* Fondo claro */
            color: #334155; /* Texto gris oscuro */
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between; /* Espacia los logos horizontalmente */
            align-items:center; /* Alinea los logos verticalmente */
            background-color:rgb(255, 255, 255); /* Fondo blanco */
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra para diseño */
            position: relative;
        }

        .logo-left {
            display: flex; /* Alinea las imágenes en una fila */
            justify-content: center; /* Centra los logos horizontalmente */
            align-items: center; /* Alinea los logos verticalmente */
            gap: 20%; /* Espacio entre las imágenes */
            background-color: #ffffff;
        }

        .logo {
            height: 70px; /* Tamaño del logo */
            width: auto; /* Mantén la proporción de la imagen */
        }

        header {
            background-color: #ffffff; /* Fondo blanco */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra suave */
            padding: 0 rem 0;
        }

        header .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1rem;
        }

        header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b; /* Título gris más oscuro */
        }

        .auth-links {
            display: flex;
            gap: 20px; /* Espaciado entre enlaces */
        }

        .auth-links a {
            color: #1d4ed8; /* Azul vibrante */
            background-color: #f1f5f9; /* Fondo claro */
            padding: 0.5rem 1rem;
            border-radius: 8px; /* Bordes redondeados */
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .auth-links a:hover {
            background-color: #1d4ed8; /* Fondo azul al hover */
            color: #ffffff; /* Texto blanco al hover */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra al hover */
        }

        main {
            text-align: center;
            margin: 1rem 1rem;
        }

        main h2 {
            font-size: 2.25rem;
            color: #1e293b;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        main p {
            font-size: 1rem;
            color: #64748b; /* Texto gris medio */
            margin-bottom: 2rem;
        }

        .carousel {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .carousel img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            display: none;
        }

        .carousel img.active {
            display: block;
        }

        footer {
            background-color:rgb(6, 59, 112);
            color:rgb(255, 255, 255);
            text-align: center;
            padding: 1rem 0;
            font-size: 0.875rem;
            border-top: 1px solid #e2e8f0; /* Línea superior */
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col justify-between">
        <!-- Encabezado -->
        <header>
    <div class="container">
        <h1>Sistema de Actividades Extraescolares</h1>
        @if (Route::has('login'))
            <nav class="auth-links">
                <a href="{{ route('login') }}">Iniciar sesión</a>
                <a href="{{ route('register') }}">Registrarse</a>
            </nav>
        @endif
    </div>
</header>

        <!-- Contenido principal -->
        <main>
            <h2>¡Bienvenido Jaguar!</h2>
            <p>Gestione actividades, cursos y más en un solo lugar!</p>
            <!-- Carrusel -->
            <div class="carousel">
                <img src="{{ asset('images/banda.jpg') }}" alt="Taller 1" class="active">
                <img src="{{ asset('images/danza.jpg') }}" alt="Taller 2">
                <img src="{{ asset('images/basquet.jpg') }}" alt="Taller 3">
            </div>

        </main>
        <!-- Pie de página -->
        <footer>
            <h4>#OrgulloJaguar #TodosSomosTecnm</h4>
            &copy; {{ date('Y') }} Sistema de Actividades Extraescolares. Todos los derechos reservados.
        </footer>
    </div>
    <script>
        // JavaScript para el carrusel
        const images = document.querySelectorAll('.carousel img');
        let currentIndex = 0;

        function showNextImage() {
            images[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % images.length;
            images[currentIndex].classList.add('active');
        }

        setInterval(showNextImage, 3000); // Cambia cada 3 segundos
    </script>
</body>
</html>
