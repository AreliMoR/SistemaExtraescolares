<div class="py-1"></div>
<x-app-layout>
<div class="py-4 bg-white"></div>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            {{ __('Lista de talleres') }}
        </h1>

        <!-- Botón para redirigir a la vista de creación -->
        <div class="mb-4 flex justify-end">
            <a href="{{ route('talleres.create') }}"
               class="btn btn-primary px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Crear Nuevo Taller
            </a>
        </div>

        <!-- Tabla de talleres -->
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th> 
                    <th>Horario</th>
                    <th>Instructor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($talleres as $index => $taller)
                    <tr>
                        <td class="px-1 py-1 border text-center"d>{{ $index + 1 }}</td>
                        <td class="px-1 py-1 border text-center">{{ strtoupper($taller->nombre) }}</td>
                        <td class="px-1 py-1 border text-center">{{ strtoupper($taller->descripcion) }}</td>
                        <td class="px-1 py-1 border text-center">{{ strtoupper($taller->categoria ?? 'Sin definir') }}</td> <!-- Mostrar categoría -->
                        <td class="px-1 py-1 border text-center">{{ strtoupper($taller->horario) }}</td>
                        <td class="px-1 py-1 border uppercase text-center">{{ strtoupper($taller->instructor->user->nombreReal ?? 'No asignado') }}
                                        {{ $taller->instructor->user->apellidoP ?? '' }}
                                        {{ $taller->instructor->user->apellidoM ?? '' }}
                        </td>
                        <td class="px-1 py-1 border text-center">
                            <a href="{{ route('talleres.edit', $taller->id) }}" class="btn btn-primary px-1 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Editar</a>
                            <div class="py-1"></div>
                            <form action="{{ route('talleres.destroy', $taller->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <x-delete-button type="submit" class="text-red-500">Eliminar</x-delete-button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No hay talleres registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>