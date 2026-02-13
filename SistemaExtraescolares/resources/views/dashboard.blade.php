<style>
                .header {
            display: flex;
            justify-content: space-between; /* Espacia los logos horizontalmente */
            align-items:center; /* Alinea los logos verticalmente */
            background-color:rgb(4, 83, 161);
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra para diseño */
            position: relative;
        }
        </style>
<x-app-layout>


            <!-- Sección para Alumno -->
            @if(auth()->user()->user_type === 'alumno')
            <div class="py-4 bg-white"></div>
                <!-- Talleres Inscritos -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-xl font-semibold mb-4">{{ __('Mis talleres') }}</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @if(isset($student) && $student->talleres->isNotEmpty())
                            @foreach($student->talleres as $taller)
                                <div class="border rounded-lg p-4 shadow">
                                    <h4 class="text-xl font-semibold text-gray-900">
                                        {{ $taller->nombre }} <!-- Mostramos el nombre del taller -->
                                    </h4>
                                    <a href="{{ route('student.show', ['studentId' => $student->id, 'tallerId' => $taller->id]) }}" class="text-blue-500 hover:text-blue-700">
                                        Ver detalles del taller
                                    </a>
                                    <p class="text-md text-gray-500">{{ __('Taller inscrito actualmente') }}</p>
                                </div>
                            @endforeach
                            @else
                                <div class="border rounded-lg p-4 shadow">
                                    <h4 class="text-lg font-bold text-gray-900">{{ __('Aún no estás inscrito en ningún taller.') }}</h4>
                                        <p class="text-md text-gray-500">{{ __('Selecciona un taller a continuación para inscribirte.') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Mostrar talleres disponibles -->
                @if(isset($student) && !$student->taller_actual)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 text-gray-900">
                            <h2 class="text-xl font-semibold mb-4 text-center">{{ __('Talleres disponibles') }}</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($talleresDisponibles as $taller)
                                    <div class="border rounded-lg p-4 shadow">
                                        <h2 class="text-xl font-semibold text-gray-900 text-center">{{ $taller->nombre }}</h2>
                                        <p class="text-gray-700 text-center">{{ $taller->descripcion }}</p>
                                        <p class="text-gray-500 text-center">{{ $taller->horario }}</p>
                                        <form method="POST" action="{{ route('taller.inscribir') }}" class="text-center mt-2">
                                            @csrf
                                            <input type="hidden" name="taller_id" value="{{ $taller->id }}">
                                            <x-button3 type="submit" class="text-blue-500 hover:underline">
                                                {{ __('Inscribirme') }}
                                            </x-button3>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            <!-- Sección para Instructor -->
            @if(auth()->user()->user_type === 'instructor')
                <div class="py-4 bg-white"></div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-xl font-semibold mb-4">{{ __('Talleres Impartidos') }}</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Verificamos si el instructor tiene talleres -->
                @if($instructor->talleres->isEmpty())
                    <p>Este instructor no tiene talleres asignados.</p>
                @else
                    @foreach($instructor->talleres as $taller)
                        <div class="border rounded-lg p-4 shadow mb-4">
                            <h4 class="text-xl font-semibold text-gray-900">
                                {{ $taller->nombre }} <!-- Mostramos el nombre del taller -->
                            </h4>
                            <a href="{{ route('instructor.detalles', ['id' => $instructor->id, 'tallerId' => $taller->id]) }}" class="text-blue-500 hover:text-blue-700">
                                Ver detalles del taller
                            </a>
                            <p class="text-md text-gray-500">{{ $taller->descripcion }}</p> <!-- Descripción del taller -->
                            <p class="text-md text-gray-500">Horario: {{ $taller->horario }}</p> <!-- Horario del taller -->
                        </div>
                    @endforeach
                @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Sección para Administrador -->
            @if(auth()->user()->user_type === 'admin')
            <div class="py-4 bg-white"></div>
                <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('Lista de alumnos registrados') }}
                    </h1>
                    
                <!-- Gestión de Alumnos -->
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border">{{ __('ID') }}</th>
                                <th class="px-4 py-2 border">{{ __('Nombre') }}</th>
                                <th class="px-4 py-2 border">{{ __('Email') }}</th>
                                <th class="px-4 py-2 border">{{ __('No. de Control') }}</th>
                                <th class="px-4 py-2 border">{{ __('Carrera') }}</th>
                                <th class="px-4 py-2 border">{{ __('Semestre') }}</th>
                                <th class="px-4 py-2 border">{{ __('Talleres Inscritos') }}</th>
                                <th class="px-4 py-2 border">{{ __('Constancias') }}</th>
                                <th class="px-4 py-2 border">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $student->id }}</td>
                                <td class="px-4 py-2 border uppercase">
                                        {{ $student->user->nombreReal ?? __('Sin nombre') }}
                                        {{ $student->user->apellidoP ?? '' }}
                                        {{ $student->user->apellidoM ?? '' }}
                                    </td>
                                    <td class="px-4 py-2 border">{{ $student->user->email ?? __('Sin correo') }}</td>
                                    <td class="px-4 py-2 border">{{ $student->no_control }}</td>
                                    <td class="px-4 py-2 border uppercase border">
                                        @switch($student->carrera)
                                            @case('informatica')
                                                Ingeniería Informática
                                                @break
                                            @case('sistemas')
                                                Ingeniería en Sistemas Computacionales
                                                @break
                                            @case('civil')
                                                Ingeniería Civil
                                                @break
                                            @case('ige')
                                                Ingeniería en Gestión Empresarial
                                                @break
                                            @case('contador')
                                                Contador Público
                                                @break
                                            @default
                                                Carrera no especificada
                                        @endswitch
                                    </td>
                                    <td class="px-4 py-2 border uppercase">{{ $student->semestre }}</td>
                                    <td class="px-4 py-2 border">
                                        @foreach($student->talleres as $taller)
                                            {{ strtoupper($taller->nombre) }}<br> <!-- Muestra el nombre del taller -->
                                        @endforeach
                                    </td>

                                    <td class="px-4 py-2 border text-center">
                                    <!-- Enlace para generar constancia -->  
                                               
                                    @foreach ($student->talleres as $taller)
                                        <a href="{{ route('student.generateCertificate', ['studentId' => $student->id, 'tallerId' => $taller->id]) }}" class="btn btn-primary px-1 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 text-center">
                                            Constancia {{ strtoupper($taller->nombre) }}
                                        </a>
                                        <div class="py-2"></div>
                                    @endforeach
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                    <div class="py-1"></div>

                                    <div class="text-center">
                                    <a href="{{ route('student.edit', $student->id) }}" class="items-center px-1 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        {{ __('Editar') }}
                                    </a>
                                    </div>    
                                    <form method="POST" action="{{ route('student.eliminar', $student->id) }}" class="inline-block mt-2 text-center">
                                        @csrf
                                        @method('DELETE')
                                        <x-delete-button type="submit" class="bg-red-500 text-white text-xs px-1 py-1 hover:bg-red-600">
                                            {{ __('Eliminar') }}
                                        </x-delete-button>
                                    </form>


                                </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-2 border text-center text-gray-500">
                                        {{ __('No hay estudiantes registrados.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
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