<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Directivo;

class DirectivoController extends Controller
{
    public function index()
    {
        // Obtener todos los directivos
        $directivos = Directivo::all();
        return view('directivos', compact('directivos'));
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:11',
        ]);

        // Crear un nuevo directivo
        Directivo::create($request->all());

        return redirect()->route('directivos')->with('success', 'Directivo agregado correctamente.');
    }

    public function update(Request $request, $id)
    {
        // Validar datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:15',
        ]);
    
        // Buscar el directivo y actualizar
        $directivo = Directivo::findOrFail($id);
        $directivo->update($request->all());
    
        // Redirigir con mensaje de éxito
        return redirect()->route('directivos')->with('success', 'Directivo actualizado correctamente.');
    }
    

    public function edit($id)
{
    $directivo = Directivo::findOrFail($id);
    return view('directivos.edit', compact('directivo'));
}

public function destroy($id)
{
    $directivo = Directivo::findOrFail($id);
    $directivo->delete();

    return redirect()->route('directivos')->with('success', 'Directivo eliminado correctamente.');
}

}
