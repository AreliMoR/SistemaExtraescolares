<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function exportAlumnosToCSV()
{
    // Definir el nombre del archivo y su cabecera
    $fileName = 'alumnos.csv';
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$fileName\"",
    ];

    // Obtener los datos de los estudiantes con la información necesaria
    $students = Student::with('user')->get(); // Asegúrate de tener una relación `user` definida en el modelo Student.

    // Crear el contenido del archivo CSV
    $callback = function () use ($students) {
        $file = fopen('php://output', 'w');

        // Encabezados de las columnas
        fputcsv($file, ['ID', 'Numero de Control', 'Nombre', 'Apellido Paterno', 'Apellido Materno', 'Genero', 'Correo']);

        // Escribir los datos de los estudiantes
        foreach ($students as $student) {
            fputcsv($file, [
                $student->id,
                $student->no_control ?? 'N/A',
                $student->user->nombreReal ?? 'N/A',
                $student->user->apellidoP ?? 'N/A',
                $student->user->apellidoM ?? 'N/A',
                $student->user->genero ?? 'N/A',
                $student->user->email ?? 'N/A'
            ]);
        }

        fclose($file);
    };

    // Devolver el archivo CSV como una descarga
    return response()->stream($callback, 200, $headers);
}

}
