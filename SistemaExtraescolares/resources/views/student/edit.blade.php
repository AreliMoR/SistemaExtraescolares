<div class="py-2"></div>
<x-app-layout>
<style>
    input[type="text"] {
        text-transform: uppercase;
    }
</style>
<div class="py-4 bg-white"></div>
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Editar información del estudiante') }}</h1>
    <div class="py-4"></div>
    <!-- Formulario para editar los atributos del alumno -->
    <form action="{{ route('student.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo para el nombre de usuario (name) -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nombre de Usuario') }}</label>
            <input type="text" name="name" id="name" value="{{ old('name', $student->user->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Campo para el nombre real (nombreReal) -->
        <div class="mb-4">
            <label for="nombreReal" class="block text-sm font-medium text-gray-700">{{ __('Nombre Real') }}</label>
            <input type="text" name="nombreReal" id="nombreReal" value="{{ old('nombreReal', $student->user->nombreReal ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('nombreReal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Campo para el apellido paterno (apellidoP) -->
        <div class="mb-4">
            <label for="apellidoP" class="block text-sm font-medium text-gray-700">{{ __('Apellido Paterno') }}</label>
            <input type="text" name="apellidoP" id="apellidoP" value="{{ old('apellidoP', $student->user->apellidoP ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('apellidoP') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Campo para el apellido materno (apellidoM) -->
        <div class="mb-4">
            <label for="apellidoM" class="block text-sm font-medium text-gray-700">{{ __('Apellido Materno') }}</label>
            <input type="text" name="apellidoM" id="apellidoM" value="{{ old('apellidoM', $student->user->apellidoM ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('apellidoM') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Otros campos que ya habías añadido -->
        <div class="mb-4">
            <label for="no_control" class="block text-sm font-medium text-gray-700">{{ __('Número de Control') }}</label>
            <input type="text" name="no_control" id="no_control" value="{{ old('no_control', $student->no_control) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('no_control') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="carrera" class="block text-sm font-medium text-gray-700">{{ __('Carrera') }}</label>
            <input type="text" name="carrera" id="carrera" value="{{ old('carrera', $student->carrera) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('carrera') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="semestre" class="block text-sm font-medium text-gray-700">{{ __('Semestre') }}</label>
            <input type="text" name="semestre" id="semestre" value="{{ old('semestre', $student->semestre) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('semestre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="periodo" class="block text-sm font-medium text-gray-700">{{ __('Periodo') }}</label>
            <input type="text" name="periodo" id="periodo" value="{{ old('periodo', $student->periodo) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('periodo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!--div class="mb-4">
            <label for="taller_actual" class="block text-sm font-medium text-gray-700">{{ __('Taller Actual') }}</label>
    <select name="taller_actual" id="taller_actual" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        <option value="" disabled selected>{{ __('Selecciona un taller') }}</option>
        <option value="basquetbol" {{ old('taller_actual', $student->taller_actual) == 'basquetbol' ? 'selected' : '' }}>
            Taller de Básquetbol
        </option>
        <option value="futbol" {{ old('taller_actual', $student->taller_actual) == 'futbol' ? 'selected' : '' }}>
            Futbol Soccer
        </option>
        <option value="taekwondo" {{ old('taller_actual', $student->taller_actual) == 'taekwondo' ? 'selected' : '' }}>
            Tae Kwon Do "Artes Marciales Mixtas"
        </option>
        <option value="voleibol" {{ old('taller_actual', $student->taller_actual) == 'voleibol' ? 'selected' : '' }}>
            Voleibol de Sala
        </option>
        <option value="ajedrez" {{ old('taller_actual', $student->taller_actual) == 'ajedrez' ? 'selected' : '' }}>
            Ajedrez
        </option>
        <option value="escolta" {{ old('taller_actual', $student->taller_actual) == 'escolta' ? 'selected' : '' }}>
            Taller de Escolta
        </option>
        <option value="banda" {{ old('taller_actual', $student->taller_actual) == 'banda' ? 'selected' : '' }}>
            Taller de Banda de Guerra
        </option>
        <option value="danza" {{ old('taller_actual', $student->taller_actual) == 'danza' ? 'selected' : '' }}>
            Danza Folklórica
        </option>
        <option value="musica" {{ old('taller_actual', $student->taller_actual) == 'musica' ? 'selected' : '' }}>
            Música
        </option>
        <option value="baile" {{ old('taller_actual', $student->taller_actual) == 'baile' ? 'selected' : '' }}>
            Taller de Baile de Salón
        </option>
        <option value="musica_folklorica" {{ old('taller_actual', $student->taller_actual) == 'musica_folklorica' ? 'selected' : '' }}>
            Música Folklórica
        </option>
    </select>
    @error('taller_actual') 
        <span class="text-red-500 text-sm">{{ $message }}</span> 
    @enderror
</div-->

        <div class="flex justify-end">
            <x-primary-button type="submit" class="bg-blue-500 text-white font-bold px-6 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                {{ __('Guardar Cambios') }}
            </x-primary-button>
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