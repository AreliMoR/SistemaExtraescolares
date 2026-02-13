<div class="py-1"></div>
<x-app-layout>
<div class="py-4 bg-white"></div>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            {{ __('Editar Taller') }}
        </h1>
        <form method="POST" action="{{ route('talleres.update', $taller->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre del Taller</label>
            <input type="text" id="nombre" name="nombre" value="{{ $taller->nombre }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   required>
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      required>{{ $taller->descripcion }}</textarea>
        </div>

        <!-- Categoría -->
        <div class="mb-4">
            <label for="categoria" class="block text-gray-700 font-bold mb-2">Categoría</label>
            <select id="categoria" name="categoria"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                <option value="" disabled>Seleccione una categoría</option>
                <option value="Deportivo" {{ $taller->categoria == 'Deportivo' ? 'selected' : '' }}>Deportivo</option>
                <option value="Cívica" {{ $taller->categoria == 'Cívica' ? 'selected' : '' }}>Cívica</option>
                <option value="Cultural" {{ $taller->categoria == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                <option value="Otro" {{ $taller->categoria == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="horario" class="block text-gray-700 font-bold mb-2">Horario</label>
            <input type="text" id="horario" name="horario" value="{{ $taller->horario }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   required>
        </div>

        <div class="mb-4">
            <label for="instructor" class="block text-gray-700 font-bold mb-2">Instructor</label>
            <select id="instructor" name="instructor"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                @foreach ($instructores as $instructor)
                    <option value="{{ $instructor->id }}" {{ $taller->user_id == $instructor->id ? 'selected' : '' }}>
                        {{ $instructor->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <x-primary-button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
            Guardar Cambios
        </x-primary-button>
    </form>
        
    </div>
</x-app-layout>