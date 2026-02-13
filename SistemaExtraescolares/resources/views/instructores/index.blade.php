<div class="py-2"></div>
<x-app-layout>
    <x-slot name="header">
    <div class="py-4"></div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Instructores Disponibles') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Tabla de instructores -->
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">#</th>
                                <th class="border px-4 py-2">Nombre</th>
                                <th class="border px-4 py-2">Correo Electrónico</th>
                                <th class="border px-4 py-2">Especialidad</th>
                                <th class="border px-4 py-2">Talleres Asignados</th>
                                <!--th class="border px-4 py-2">Acciones</th-->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($instructores as $index => $instructor)
                                <tr>
                                    <td class="border px-4 uppercase py-2">{{ $index + 1 }}</td>
                                    <td class="border px-4 uppercase py-2">{{ $instructor->user->nombreReal ?? 'N/A' }} {{ $instructor->user->apellidoP ?? '' }} {{ $instructor->user->apellidoM ?? '' }}</td>
                                    <td class="border px-4 py-2">{{ $instructor->user->email ?? 'N/A' }}</td>
                                    <td class="border px-4 uppercase py-2">{{ $instructor->actividad ?? 'N/A' }}</td>
                                    <td class="border px-4 uppercase py-2">
                                        {{ $instructor->talleres->pluck('nombre')->join(', ') ?? 'Sin talleres asignados' }}
                                    </td>
                                    <!--td class="border px-4 py-2">
                                        <a href="{{ route('instructores.edit', $instructor->id) }}" class="btn btn-primary px-2 py-1 bg-gray-800 text-white rounded-md">Editar</a>
                                    </td-->
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center uppercase py-4">No hay instructores registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
