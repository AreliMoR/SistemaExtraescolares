<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Taller;
use App\Models\User;

class TallerController extends Controller
{
    public function inscribir(Request $request)
{
    $user = Auth::user();

    // Verifica que el usuario sea un alumno
    if ($user->user_type !== 'alumno') {
        return redirect()->back()->with('error', 'Solo los alumnos pueden inscribirse en talleres.');
    }

    // Obtén el modelo del estudiante asociado
    $student = $user->student;

    if (!$student) {
        return redirect()->back()->with('error', 'No se encontraron datos del estudiante.');
    }

    // Obtén el ID del taller desde el formulario
    $tallerId = $request->input('taller_id');

    // Verifica que el taller exista
    $taller = Taller::find($tallerId);
    if (!$taller) {
        return redirect()->back()->with('error', 'El taller seleccionado no existe.');
    }

    // Inscribe al estudiante en el taller usando la relación many-to-many
    if (!$student->talleres->contains($tallerId)) {
        $student->talleres()->attach($tallerId);
    } else {
        return redirect()->back()->with('error', 'Ya estás inscrito en este taller.');
    }
    //dd($student, $tallerId);

    return redirect()->route('dashboard')->with('success', '¡Te has inscrito en el taller: ' . $taller->nombre . '!');
}


    public function create()
    {
        // Obtén los usuarios con el tipo 'instructor'
        $instructores = User::where('user_type', 'instructor')->get();
    
        // Retorna la vista con los datos de los instructores
        return view('talleres.create', compact('instructores'));
    }

    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'horario' => 'required|string',
        'categoria' => 'required|string|max:255', // Validar la categoría
        'instructor' => 'nullable|exists:users,id',
    ]);

    // Crear el taller
    Taller::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'horario' => $request->horario,
        'categoria' => $request->categoria, // Guardar la categoría
        'user_id' => $request->instructor,
    ]);

    return redirect()->route('talleres.index')->with('success', 'Taller creado correctamente.');
}



    public function index()
    {
        $talleres = Taller::with('instructor')->get(); // Carga la relación con el instructor
        return view('talleres.index', compact('talleres')); // Cambia la vista a 'talleres.index'
    }

    // Editar taller
    public function edit($id)
    {
        $taller = Taller::findOrFail($id); // Encuentra el taller o lanza una excepción
        $instructores = User::where('user_type', 'instructor')->get(); // Obtén todos los instructores

        return view('talleres.edit', compact('taller', 'instructores'));
    }

    // Actualizar taller
    public function update(Request $request, $id)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'horario' => 'required|string',
        'categoria' => 'required|string|max:255', // Validar categoría
        'instructor' => 'nullable|exists:users,id',
    ]);

    // Buscar el taller y actualizarlo
    $taller = Taller::findOrFail($id);
    $taller->update([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'horario' => $request->horario,
        'categoria' => $request->categoria, // Actualizar categoría
        'user_id' => $request->instructor,
    ]);

    return redirect()->route('talleres.index')->with('success', 'Taller actualizado correctamente.');
}


    // Eliminar taller
    public function destroy($id)
    {
        $taller = Taller::findOrFail($id);
        $taller->delete();

        return redirect()->route('talleres.index')->with('success', 'Taller eliminado correctamente.');
    }
}
