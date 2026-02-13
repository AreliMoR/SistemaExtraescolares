<div class="py-1"></div>
<x-app-layout>
<div class="py-4 bg-white"></div>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            {{ __('Crear Nuevo Taller') }}
        </h1>

        <!-- Formulario para crear un taller -->
        <form method="POST" action="{{ route('talleres.store') }}">
            @csrf

            <!-- Nombre del Taller -->
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre del Taller</label>
                <input type="text" id="nombre" name="nombre" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                       required>
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" 
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                          required></textarea>
            </div>

            <!-- Categoría -->
            <div class="mb-4">
                <label for="categoria" class="block text-gray-700 font-bold mb-2">Categoría</label>
                <select id="categoria" name="categoria" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        required>
                    <option value="" disabled selected>Seleccione una categoría</option>
                    <option value="Deportivo">Deportivo</option>
                    <option value="Civica">Cívica</option>
                    <option value="Cultural">Cultural</option>
                    <!--option value="Otro">Otro</option> <!-- Puede permitir categorías personalizadas -->
                </select>
            </div>

            <!-- Horario -->
            <div class="mb-4">
                <label for="horario" class="block text-gray-700 font-bold mb-2">Horario</label>
                <input type="text" id="horario" name="horario" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                       placeholder="Ejemplo: Lunes y Miércoles 10:00 - 12:00" required>
            </div>

            <!-- Docente -->
            <div class="mb-4">
                <label for="instructor" class="block text-gray-700 font-bold mb-2">Instructor</label>
                <select id="instructor" name="instructor" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        >
                    <option value="" disabled selected>Seleccione un instructor</option>
                    @foreach ($instructores as $instructor)
                        <option value="{{ $instructor->id }}">
                            {{ $instructor->nombreReal }} {{ $instructor->apellidoP }} {{ $instructor->apellidoM }}
                        </option>
                    @endforeach
                </select>
            </div>



            <!-- Botón de Guardar -->
            <div class="flex items-center justify-between">
                <x-primary-button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    {{ __('Guardar Taller') }}
                </x-primary-button>
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:underline">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
