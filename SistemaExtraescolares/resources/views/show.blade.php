<x-app-layout>
    <div class="py-4 bg-white"></div>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Bienvenido al taller de {{ $taller->nombre }}
        </h1>

        <div class="bg-white p-6 shadow rounded-lg">
            <h3 class="text-lg font-semibold text-gray-700">Más información:</h3>
            <ul class="list-disc list-inside text-gray-600">
                <li><strong>Horario:</strong> {{ $taller->horario }}</li>
                <li><strong>Instructor:</strong> {{ $instructorNombreCompleto }}</li>
                <li><strong>Descripción:</strong> {{ $taller->descripcion }}</li>
            </ul>
        </div>

        <!-- Botón para volver atrás -->
        <div class="mt-6">
            <a href="{{ route('dashboard') }}" class="text-blue-500 hover:text-blue-700">
                ← Volver al dashboard
            </a>
        </div>
    </div>
</x-app-layout>

<footer>
    <h4>#OrgulloJaguar #TodosSomosTecnm</h4>
    &copy; {{ date('Y') }} Sistema de Actividades Extraescolares. Todos los derechos reservados.
</footer>
