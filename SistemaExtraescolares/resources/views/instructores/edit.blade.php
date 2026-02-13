<div class="py-2"></div>
<x-app-layout>
<style>
    input[type="text"] {
        text-transform: uppercase;
    }
</style>
<div class="py-4 bg-white"></div>
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Editar información del instructor') }}</h1>
    <div class="py-4"></div>
<form action="{{ route('instructores.update', $instructor->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Campos personales -->
    <div class="mb-4">
        <label for="name" class="block font-bold">Nombre de Usuario:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $instructor->user->name) }}" class="w-full border rounded-md">
    </div>

    <div class="mb-4">
        <label for="nombreReal" class="block font-bold">Nombre Real:</label>
        <input type="text" id="nombreReal" name="nombreReal" value="{{ old('nombreReal', $instructor->user->nombreReal) }}" class="w-full border rounded-md">
    </div>

    <!-- Actividad y Taller -->
    <div class="mb-4">
        <label for="actividad" class="block font-bold">Actividad:</label>
        <select id="actividad" name="actividad" class="w-full border rounded-md">
            <option value="">Seleccione una actividad</option>
            <option value="deportiva" {{ old('actividad', $instructor->actividad) === 'deportiva' ? 'selected' : '' }}>Deportiva</option>
            <option value="cultural" {{ old('actividad', $instructor->actividad) === 'cultural' ? 'selected' : '' }}>Cultural</option>
            <option value="civica" {{ old('actividad', $instructor->actividad) === 'civica' ? 'selected' : '' }}>Cívica</option>
        </select>
    </div>

    <!-- Botón Guardar -->
    <div class="flex justify-end">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">
            Guardar Cambios
        </button>
    </div>
</form>
</div>
</x-app-layout>
<style>
    footer {
            background-color:rgb(6, 59, 112);
            color:rgb(255, 255, 255);
            text-align: center;
            padding: 1rem 0;
            font-size: 0.875rem;
            border-top: 1px solid #e2e8f0; /* Línea superior */
        }
</style>
<footer>
    <h4>#OrgulloJaguar #TodosSomosTecnm</h4>
        &copy; {{ date('Y') }} Sistema de Actividades Extraescolares. Todos los derechos reservados.
</footer>
