<div class="py-2"></div>
<x-app-layout>
<style>
    input[type="text"] {
        text-transform: uppercase;
    }
</style>
<div class="py-4 bg-white"></div>
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Editar directivo') }}</h1>
    <div class="py-4"></div>
    <!-- Formulario para editar directivo -->
    <form method="POST" action="{{ route('directivos.update', $directivo->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $directivo->nombre) }}" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="cargo" class="block text-gray-700 font-bold mb-2">Cargo</label>
                <input type="text" id="cargo" name="cargo" value="{{ old('cargo', $directivo->cargo) }}" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="correo" class="block text-gray-700 font-bold mb-2">Correo</label>
                <input type="email" id="correo" name="correo" value="{{ old('correo', $directivo->correo) }}" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="telefono" class="block text-gray-700 font-bold mb-2">Número de contacto</label>
                <input type="number" id="telefono" name="telefono" value="{{ old('telefono', $directivo->telefono) }}" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="flex items-center justify-between">
                <x-primary-button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Guardar Cambios
                </x-primary-button>

                <a href="{{ route('directivos') }}" class="text-gray-500 hover:underline">
                    Cancelar
                </a>
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