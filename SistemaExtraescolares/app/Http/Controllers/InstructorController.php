<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Taller;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    public function show($id, $tallerId = null)
{
    // Obtener el instructor con el user_id relacionado
    $instructor = Instructor::where('id', $id)->firstOrFail();

    // Validar que el taller pertenece al instructor
    $taller = Taller::where('id', $tallerId)
                    ->where('user_id', $instructor->user_id)
                    ->firstOrFail();

    // Obtener los alumnos inscritos en el taller a través de la tabla pivote
    $alumnos = $taller->students()->with('user')->get(); // Relación cargada con información de usuario

    // Pasar los datos a la vista
    return view('detalles', compact('instructor', 'taller', 'alumnos'));
}

    


public function update(Request $request, $id)
{
    // Validar los datos de entrada
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'nombreReal' => 'required|string|max:255',
        'apellidoP' => 'required|string|max:255',
        'apellidoM' => 'required|string|max:255',
        'actividad' => 'nullable|string|in:deportiva,cultural,civica',
    ]);

    // Buscar el instructor y su usuario relacionado
    $instructor = Instructor::with('user')->findOrFail($id);

    // Actualizar los datos del usuario
    $userData = [
        'name' => $validatedData['name'],
        'nombreReal' => $validatedData['nombreReal'],
        'apellidoP' => $validatedData['apellidoP'],
        'apellidoM' => $validatedData['apellidoM'],
    ];

    // Actualización del usuario
    $instructor->user->update($userData);

    // Actualizar la actividad
    $instructor->actividad = $request->actividad;

    // Comprobar si se guarda correctamente
    if ($instructor->save()) {
        return redirect()->route('instructores.index')->with('success', 'Datos del instructor actualizados correctamente.');
    } else {
        return back()->with('error', 'Hubo un error al actualizar los datos del instructor.');
    }
}



public function edit($id)
{
    $instructor = Instructor::findOrFail($id);
    return view('instructores.edit', compact('instructor'));
}

public function index()
    {
        $instructores = Instructor::with('user')->get(); // Incluye la relación con el usuario
        return view('instructores.index', compact('instructores'));
    }

}
