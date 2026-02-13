<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Taller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
    public function index()
{
    $user = Auth::user();

    $data = [];

    if ($user->user_type === 'alumno') {
        $data['student'] = $user->student;

        // Obtener todos los talleres disponibles
        $data['talleresDisponibles'] = Taller::with('students')->get();

    } elseif ($user->user_type === 'instructor') {
        $data['instructor'] = $user->instructor;
    } elseif ($user->user_type === 'admin') {
        $data['admin'] = $user->admin;

        $students = Student::with('user')->get(); // Carga la relación con User
        $allTalleres = Taller::all(); // Todos los talleres
        //dd($students, $allTalleres);
        //dd($students->toArray());

        return view('dashboard', compact('students', 'allTalleres'));
    }

    return view('dashboard', $data);
}

}

