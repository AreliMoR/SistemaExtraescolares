<x-app-layout>
    <style>
        input[type="text"] {
            text-transform: uppercase;
        }
    </style>

    <div class="py-4 bg-white"></div>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Detalles del Taller') }}</h1>
        <div class="py-2"></div>

        <!-- Información del Taller -->
        <div class="border rounded-lg p-6 shadow mb-6">
            <h2 class="text-xl font-semibold text-gray-900">{{ $taller->nombre }}</h2>
            <p class="text-md text-gray-500 mt-2">Descripcion: {{ $taller->descripcion }}</p>
            <p class="text-md text-gray-500 mt-2">Horario: {{ $taller->horario }}</p>
            <p class="text-md text-gray-500 mt-2">Categoría: {{ $taller->categoria }}</p>

            <h3 class="text-lg font-semibold text-gray-800 mt-4">Instructor:</h3>
            <p class="text-md text-gray-500">{{ $instructor->user->name }}</p>
        </div>

        <!-- Lista de Alumnos -->
<h3 class="text-lg font-semibold text-gray-800 mt-6">Alumnos Inscritos:</h3>
@if($alumnos->isEmpty())
    <p class="text-gray-500">No hay alumnos inscritos en este taller.</p>
@else
    <table class="w-full border-collapse border border-gray-300 mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">No. Control</th>
                <th class="border border-gray-300 px-4 py-2">Nombre Completo</th>
                <th class="border border-gray-300 px-4 py-2">Correo</th>
                <th class="border border-gray-300 px-4 py-2">Género</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alumnos as $alumno)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $alumno->no_control }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $alumno->user->nombreReal }} {{ $alumno->user->apellidoP }} {{ $alumno->user->apellidoM }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $alumno->user->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $alumno->user->genero }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
<div class="py-2"></div>

<a href="{{ route('export.alumnos.csv') }}" class="items-center px-1 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
    DESCARGAR LISTA DE ALUMNOS
</a>




        <!-- Enlace para regresar -->
        <div class="mt-6">
            <a href="{{ route('dashboard', ['id' => $instructor->id]) }}" class="text-blue-500 hover:text-blue-700">
                Volver a los talleres del instructor
            </a>
        </div>
    </div>

    <style>
        footer {
            background-color: rgb(6, 59, 112);
            color: rgb(255, 255, 255);
            text-align: center;
            padding: 1rem 0;
            font-size: 0.875rem;
            border-top: 1px solid #e2e8f0;
        }
    </style>

    <footer>
        <h4>#OrgulloJaguar #TodosSomosTecnm</h4>
        &copy; {{ date('Y') }} Sistema de Actividades Extraescolares. Todos los derechos reservados.
    </footer>
</x-app-layout>
