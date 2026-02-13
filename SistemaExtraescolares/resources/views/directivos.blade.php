<div class="py-2"> 
<x-app-layout>
<div class="py-4 bg-white"></div>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Directorio') }}</h1>
        <div class="py-2"></div>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de directivos -->
<table class="w-full border-collapse border border-gray-300 mb-6">
    <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2">Nombre</th>
            <th class="border border-gray-300 px-4 py-2">Cargo</th>
            <th class="border border-gray-300 px-4 py-2">Correo</th>
            <th class="border border-gray-300 px-4 py-2">Número de contacto</th>
            @if(auth()->user() && auth()->user()->user_type === 'admin')
                <th class="border border-gray-300 px-4 py-2">Acciones</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse ($directivos as $directivo)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ strtoupper($directivo->nombre) }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ strtoupper($directivo->cargo) }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $directivo->correo }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $directivo->telefono }}</td>
                @if(auth()->user() && auth()->user()->user_type === 'admin')
                    <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                        <!-- Botón Editar -->
                        <div class="text-center">
                            <a href="{{ route('directivos.edit', $directivo->id) }}" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Editar') }}
                            </a>
                        </div>  
                        <div class="py-2"></div>
                        <!-- Botón Eliminar -->
                        <form method="POST" action="{{ route('directivos.destroy', $directivo->id) }}">
                            @csrf
                            @method('DELETE')
                            <x-delete-button type="submit" 
                            class="inline-flex items-center px-2 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xxs text-white uppercase tracking-wide hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este directivo?')">
                                Borrar
                            </x-delete-button>
                        </form>
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-gray-500 py-4">No hay directivos registrados.</td>
            </tr>
        @endforelse
    </tbody>
</table>


        @if(auth()->user() && auth()->user()->user_type === 'admin')
    <!-- Formulario para agregar directivo -->
    <form method="POST" action="{{ route('directivos.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <h2 class="text-lg font-bold mb-4">Agregar Nuevo Directivo</h2>

        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="cargo" class="block text-gray-700 font-bold mb-2">Cargo</label>
            <input type="text" id="cargo" name="cargo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="correo" class="block text-gray-700 font-bold mb-2">Correo</label>
            <input type="email" id="correo" name="correo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="correo" class="block text-gray-700 font-bold mb-2">Número de contacto</label>
            <input type="number" id="telefono" name="telefono" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <x-primary-button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
            Agregar
        </x-primary-button>
    </form>
@endif

</x-app-layout>
