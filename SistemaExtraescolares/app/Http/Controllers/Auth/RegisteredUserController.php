<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\Instructor;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;


class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Procesa el registro del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar los datos enviados por el formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nombreReal' => 'required|string|max:255',
            'apellidoP' => 'required|string|max:255',
            'apellidoM' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'user_type' => 'required|in:alumno,instructor,admin',
            'genero' => 'required|string|in:femenino,masculino,otro',
        ]);
        
        if ($request->user_type === 'alumno') {
            $request->validate([
                'no_control' => 'nullable|string|unique:students,no_control',
                'carrera' => 'nullable|required_if:user_type,alumno|string|in:informatica,sistemas,civil,ige,contador',
                'semestre' => 'nullable|required_if:user_type,alumno|string',
                'periodo' => 'nullable|required_if:user_type,alumno|string'
            ]);
        }
        if ($request->user_type === 'instructor') {
            $request->validate([
                'actividad' => 'nullable|string|in:deportiva,civica,cultural',
                'deportiva' => 'nullable|string|required_if:actividad,deportiva',
                'cultural' => 'nullable|string|required_if:actividad,cultural',
                'civica' => 'nullable|string|required_if:actividad,civica',
            ]);
        }
        
        // Crear el usuario principal
        $user = User::create([
            'name' => $validatedData['name'],
            'nombreReal' => $validatedData['nombreReal'],
            'apellidoP' => $validatedData['apellidoP'],
            'apellidoM' => $validatedData['apellidoM'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'genero' => $validatedData['genero'],
            'user_type' => $validatedData['user_type'],
        
        ]);
        if ($request->user_type === 'alumno') {
            Student::create([
                'user_id' => $user->id,
                'no_control' => $request->no_control,
                'carrera' => $request->carrera,
                'semestre' => $request->semestre,
                'periodo' => $request->periodo,
            ]);
        } 
        if ($request->user_type === 'instructor') {
            // Determina el taller seleccionado basado en la actividad
            $tallerSeleccionado = null;
            if ($request->actividad === 'deportiva') {
                $tallerSeleccionado = $request->deportiva;
            } elseif ($request->actividad === 'cultural') {
                $tallerSeleccionado = $request->cultural;
            } elseif ($request->actividad === 'civica') {
                $tallerSeleccionado = $request->civica;
            }
            Instructor::create([
                'user_id' => $user->id,
                'actividad' => $request->actividad,
                'taller' => $tallerSeleccionado,
            ]);            
        }
        if ($request->user_type === 'admin') {
            Admin::create([
                'user_id' => $user->id,
                //'matricula' => $request->matricula,
            ]);
        }
        //dd($request->all());

        //dd('Usuario creado con ID:', $user->id, 'Tipo:', $request->user_type);

        // Iniciar sesión y redirigir
        Auth::login($user);

        event(new Registered($user));

        return redirect()->route('dashboard');
    }
}
