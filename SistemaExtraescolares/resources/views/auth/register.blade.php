<div class="container" class="py-2">  
    <h2>Registro</h2>
</div>
<style>
.container {
            font-size: 2rem;
            color:rgb(255, 255, 255);
            font-weight: 500;
            margin-bottom: 0 rem;
            text-align: center;
            background-color:rgb(4, 83, 161);
            font-family:Arial, Helvetica, sans-serif;
        }
</style>
<x-guest-layout>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <!-- Columna: Datos Generales -->
        <div>
            <h2 class="text-lg font-semibold mb-4">Datos Generales</h2>

            <!-- User -->
            <div>
                <x-input-label for="name" :value="__('Nombre de usuario')" />
                <x-text-input id="name" class="block mt-1 w-full uppercase" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Nombre -->
            <div class="mt-4">
                <x-input-label for="nombreReal" :value="__('Nombre')" />
                <x-text-input id="nombreReal" class="block mt-1 w-full uppercase" type="text" name="nombreReal" />
                <x-input-error :messages="$errors->get('nombreReal')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="apellidoP" :value="__('Apellido Paterno')" />
                <x-text-input id="apellidoP" class="block mt-1 w-full uppercase" type="text" name="apellidoP" />
                <x-input-error :messages="$errors->get('apellidoP')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="apellidoM" :value="__('Apellido Materno')" />
                <x-text-input id="apellidoM" class="block mt-1 w-full uppercase" type="text" name="apellidoM" />
                <x-input-error :messages="$errors->get('apellidoM')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Genero -->
            <div class="mt-4">
                <x-input-label for="genero" :value="__('Género')" />
                <select id="genero" name="genero" class="block mt-1 w-full uppercase" required>
                    <option value="">-- SELECCIONAR --</option>
                    <option value="femenino">FEMENINO</option>
                    <option value="masculino">MASCULINO</option>
                    <option value="otro">OTRO</option>
                </select>
                <x-input-error :messages="$errors->get('genero')" class="mt-2" />
            </div>
        </div>

        <!-- Columna: Especificaciones por Tipo de Usuario -->
        <div>
            <h2 class="text-lg font-semibold mb-4">Especificaciones</h2>

            <!-- User Type -->
        <div class="mt-4">
            <x-input-label for="user_type" :value="__('Tipo de usuario')" />
            <select id="user_type" name="user_type" class="block mt-1 w-full" required>
                <option value="">-- SELECCIONAR --</option>
                <option value="alumno">ALUMNO</option>
                <option value="instructor">INSTRUCTOR</option>
                <option value="admin">ADMINISTRADOR</option>
            </select>
            <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
        </div>

        <!-- Datos Alumno -->
        <div id="id_alumno_field" class="mt-4 hidden">
            <div class="mt-4">
                <x-input-label for="no_control" :value="__('Número de control')" />
                <x-text-input id="no_control" 
                            class="block mt-1 w-full" 
                            type="text" 
                            name="no_control" 
                            maxlength="8" 
                            minlength="8" 
                            pattern=".{8}" />
                <x-input-error :messages="$errors->get('no_control')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="carrera" :value="__('Carrera')" />
                    <select id="carrera" name="carrera" class="block mt-1 w-full uppercase">
                        <option value="">-- Seleccionar --</option>
                        <option value="informatica">Ingeniería Informática</option>
                        <option value="sistemas">Ingeniería en Sistemas Computacionales</option>
                        <option value="civil">Ingeniería Civil</option>
                        <option value="ige">Ingeniería en Gestión Empresarial</option>
                        <option value="contador">Contador Público</option>
                    </select>
                <x-input-error :messages="$errors->get('carrera')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="semestre" :value="__('Semestre')" />
                    <select id="semestre" name="semestre" class="block mt-1 w-full uppercase">
                        <option value="">-- Seleccionar --</option>
                        <option value="primer">1</option>
                        <option value="segundo">2</option>
                        <option value="tercer">3</option>
                        <option value="cuarto">4</option>
                        <option value="quinto">5</option>
                        <option value="sexto">6</option>
                        <option value="septimo">7</option>
                        <option value="octavo">8</option>
                        <option value="noveno">9</option>
                        <option value="decimo">10</option>
                        <option value="onceavo">11</option>
                        <option value="doceavo">12</option>
                        <option value="treceavo">13</option>
                        <option value="catorceavo">14</option>
                    </select>
                <x-input-error :messages="$errors->get('semestre')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="periodo" :value="__('Periodo de ingreso')" />
                <x-text-input 
                    id="periodo" 
                    class="block mt-1 w-full uppercase" 
                    type="text" 
                    name="periodo" 
                    pattern="^\d{4}-[12]$" 
                    maxlength="6" 
                    title="El formato debe ser Año-1 o Año-2, con el año de 4 dígitos." />
                <small class="text-gray-500">Ejemplo: 2023-1 o 2023-2. Ingrese un año de 4 dígitos seguido de un guion y un número 1 o 2.</small>
                <x-input-error :messages="$errors->get('periodo')" class="mt-2" />
            </div>


        </div>

            <!-- Datos Específicos Instructor -->
            <div id="id_instructor_field" class="mt-4 hidden">
            <!-- Tipo de Actividad-->
            <div class="mt-4">
                <x-input-label for="actividad" :value="__('Tipo de actividad que imparte')" />
                    <select id="actividad" name="actividad" class="block mt-1 w-full uppercase">
                        <option value="">-- Seleccionar --</option>
                        <option value="deportiva">Deportiva</option>
                        <option value="civica">Cívica</option>
                        <option value="cultural">Cultural</option>
                    </select>
                <x-input-error :messages="$errors->get('actividad')" class="mt-2" />
            </div>

            <!-- Talleres Dinámicos -->
            
            <div id="talleres_deportivos" class="mt-4 hidden">
                <div class="mt-4">
                    <x-input-label for="deportiva" :value="__('Taller')" />
                        <select id="deportiva" name="deportiva" class="block mt-1 w-full uppercase">
                            <option value="">-- Seleccionar taller --</option>
                            <option value="basquet">Básquetbol</option>
                            <option value="artesMarciales">Tae Kwon Do "Artes Marciales Mixtas"</option>
                            <option value="voleibol">Voleibol de Sala</option>
                            <option value="ajedrez">Ajedrez</option>
                            <option value="futbol">Futbol soccer</option>
                        </select>
                    <x-input-error :messages="$errors->get('deportiva')" class="mt-2" />
                </div> 
            </div>

            <div id="talleres_culturales" class="mt-4 hidden">
                <div class="mt-4">
                    <x-input-label for="cultural" :value="__('Taller')" />
                        <select id="cultural" name="cultural" class="block mt-1 w-full uppercase">
                            <option value="">-- Seleccionar taller --</option>
                            <option value="danza">Danza Folklórica</option>
                            <option value="musica">Música</option>
                            <option value="baile">Baile de Salón</option>
                            <option value="musicaFolk">Música Folklórica</option>
                        </select>
                    <x-input-error :messages="$errors->get('cultural')" class="mt-2" />
                </div> 
            </div>

            <div id="talleres_civicos" class="mt-4 hidden">
                <div class="mt-4">
                    <x-input-label for="civica" :value="__('Taller')" />
                        <select id="civica" name="civica" class="block mt-1 w-full uppercase">
                            <option value="">-- Seleccionar --</option>
                            <option value="escolta">Escolta</option>
                            <option value="banda">Banda de Guerra</option>
                        </select>
                    <x-input-error :messages="$errors->get('civica')" class="mt-2" />
                </div> 
            </div>
        </div>
        </div>
    </div>

    <!-- Botón para realizar el registro -->
    <div class="flex items-center justify-end mt-6">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
            {{ __('¿Ya tienes tu cuenta?') }}
        </a>

        <x-primary-button class="ms-4">
            {{ __('Registrar') }}
        </x-primary-button>
    </div>
</form>

<script>
function validarPeriodo(input) {
    const regex = /^\d{4}-[12]$/;
    if (!regex.test(input.value)) {
        input.setCustomValidity("El formato debe ser Año-1 o Año-2, con el año de 4 dígitos.");
    } else {
        input.setCustomValidity("");
    }
}
</script>


    <script>
        document.getElementById('user_type').addEventListener('change', function () {
            const userType = this.value;

            // Mapeo de secciones por tipo de usuario
            const sections = {
                alumno: document.getElementById('id_alumno_field'),
                instructor: document.getElementById('id_instructor_field'), // Si tienes más secciones
                // admin: document.getElementById('id_admin_field'),
            };

            // Campos específicos de alumnos
            
            const no_controlInput = document.getElementById('no_control');
            //const carreraField = document.getElementById('id_carrera_field');
            const carreraSelect = document.getElementById('carrera');
            const semestreSelect = document.getElementById('semestre');
            const periodoInput = document.getElementById('periodo');

            //Campos específicos para instructores
            const actividadInput = document.getElementById('actividad');
            const workshopsInput = document.getElementById('workshops');

            // Ocultar todas las secciones
            Object.values(sections).forEach(section => section?.classList.add('hidden'));

            // Mostrar la sección correspondiente
            if (sections[userType]) {
                sections[userType].classList.remove('hidden');
            }

            // Manejo específico para campos de alumno
            if (userType === 'alumno') {
                no_controlInput.required = true; // Activar "required" para matrícula
                carreraSelect.required = true; // Activar "required" para carrera
                //carreraField.classList.remove('hidden'); // Mostrar campo de carrera
                semestreSelect.required = true; // Activar "required" para semestre
                periodoInput.required = true; // Activar "required" para periodo
                
            } else {
                no_controlInput.required = false; // Quitar "required" de matrícula
                matriculaInput.value = ''; // Limpiar el valor de matrícula
                no_controlInput.required = false; // Quitar "required" de carrera
                //carreraField.classList.add('hidden'); // Ocultar campo de carrera
                carreraSelect.value = ''; // Limpiar el valor de carrera
                semestreSelect.required = false; // Quitar "required" de semestre
                semestreSelect.value = ''; // Limpiar el valor de semestre
                periodoInput.required = false; // Quitar "required" de periodo
                periodoInput.value = ''; // Limpiar el valor de periodo
            }

            // Manejo específico para campos de alumno
            if (userType === 'instructor') {
                actividadInput.required = true; // Activar "required" para actividad 
                workshopsInput.required = true; // Activar "required" para talleres             
            } else {
                actividadInput.required = false; // Quitar "required" de actividad
                actividadInput.value = ''; // Limpiar el valor de actividad
                workshopsInput.required = false; // Quitar "required" de talleres
                workshopsInput.value = ''; // Limpiar el valor de talleres
            }
        });
    </script>

    <script>
        document.getElementById('actividad').addEventListener('change', function () {
            const talleresDeportivos = document.getElementById('talleres_deportivos');
            const talleresCulturales = document.getElementById('talleres_culturales');
            const talleresCivicos = document.getElementById('talleres_civicos');

            if (this.value === 'deportiva') {
                talleresDeportivos.classList.remove('hidden');
                talleresCulturales.classList.add('hidden');
                talleresCivicos.classList.add('hidden');
            } else if (this.value === 'cultural') {
                talleresDeportivos.classList.add('hidden');
                talleresCulturales.classList.remove('hidden');
                talleresCivicos.classList.add('hidden');
            } else if (this.value === 'civica') {
                talleresDeportivos.classList.add('hidden');
                talleresCulturales.classList.add('hidden');
                talleresCivicos.classList.remove('hidden');
            } else {
                talleresDeportivos.classList.add('hidden');
                talleresCulturales.classList.add('hidden');
                talleresCivicos.classList.add('hidden');
            }
        });
    </script>

</x-guest-layout>
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