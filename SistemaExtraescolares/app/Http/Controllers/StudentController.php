<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Student;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Carbon\Carbon;
use setasign\Fpdi\Fpdi;

class StudentController extends Controller
{

    public function showTaller($studentId, $tallerId)
{
    // Obtener el estudiante con el ID proporcionado
    $student = Student::find($studentId);

    // Verificar si el estudiante tiene el taller asignado
    $taller = $student->talleres()->find($tallerId);

    if (!$taller) {
        // Si el estudiante no está inscrito en este taller
        return redirect()->route('dashboard')->with('error', 'No estás inscrito en este taller.');
    }

    // Obtener el instructor relacionado con el taller
    $instructor = $taller->instructor;

    // Verificar si el instructor existe
    if ($instructor) {
        // Obtener el nombre completo del instructor
        $instructorNombreCompleto = mb_strtoupper('C. ' . $instructor->nombreReal . ' ' . $instructor->apellidoP . ' ' . $instructor->apellidoM);
    } else {
        // Si no hay instructor asignado
        $instructorNombreCompleto = 'SIN INSTRUCTOR ASIGNADO';
    }

    // Retornar la vista con los detalles del taller y el instructor
    return view('show', compact('taller', 'instructorNombreCompleto'));
}



    public function edit($id)
{
    $student = Student::with('user')->findOrFail($id); // Cargar el estudiante y su relación con el usuario
    return view('student.edit', compact('student'));
}


public function update(Request $request, $id)
{
    // Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'nombreReal' => 'required|string|max:255',
        'apellidoP' => 'required|string|max:255',
        'apellidoM' => 'required|string|max:255',
        'no_control' => 'required|string|max:255',
        'carrera' => 'required|string|max:255',
        'semestre' => 'required|string|max:255',
        'periodo' => 'required|string|max:255',
        'taller_actual' => 'required|string|max:255',
    ]);

    // Buscar al estudiante
    $student = Student::findOrFail($id);

    // Actualizar los atributos
    $student->user->name = $request->name; // Actualiza el nombre de usuario
    $student->user->nombreReal = $request->nombreReal;
    $student->user->apellidoP = $request->apellidoP;
    $student->user->apellidoM = $request->apellidoM;
    $student->no_control = $request->no_control;
    $student->carrera = $request->carrera;
    $student->semestre = $request->semestre;
    $student->periodo = $request->periodo;
    $student->taller_actual = $request->taller_actual;

    // Guardar los cambios
    $student->user->save();  // Guardar cambios en la tabla 'users'
    $student->save();  // Guardar cambios en la tabla 'students'

    return redirect()->route('dashboard')->with('success', 'Estudiante actualizado correctamente');
}


    /**
     * Delete the user's account.
     */
    public function destroy($id)
{
    // Cargar al estudiante junto con el usuario asociado
    $student = Student::with('user')->findOrFail($id);

    // Obtener el usuario relacionado
    $user = $student->user;

    // Verifica si el usuario existe
    if ($user) {
        // Eliminar primero el estudiante
        $student->delete();
        // Eliminar el usuario asociado
        $user->delete();
    } else {
        return redirect()->route('dashboard')->with('error', 'Usuario asociado no encontrado.');
    }

    return redirect()->route('dashboard')->with('success', 'Estudiante eliminado correctamente.');
}



public function generateCertificate($studentId, $tallerId)
{
    // Obtener los datos del estudiante
    $student = Student::findOrFail($studentId);
    
    // Obtener el taller en el que el estudiante está inscrito
    $taller = $student->talleres()->findOrFail($tallerId);  // Esto garantiza que el alumno está inscrito en el taller

    // Obtener el nombre del instructor
    $instructor = $taller->instructor ?? null;
    $instructorNombreCompleto = $instructor
        ? mb_strtoupper('C. ' . $instructor->user->nombreReal . ' ' . $instructor->user->apellidoP . ' ' . $instructor->user->apellidoM)
        : 'SIN INSTRUCTOR ASIGNADO';

    // Obtener el nombre del taller
    $tallerNombre = strtoupper($taller->nombre);

    // Obtener los datos adicionales (como carrera)
    $carrera = $student->carrera;
    $carrerasMap = [
        'informatica' => 'INGENIERIA INFORMATICA',
        'sistemas' => 'INGENIERIA EN SISTEMAS COMPUTACIONALES',
        'civil' => 'INGENIERIA CIVIL',
        'ige' => 'INGENIERIA EN GESTION EMPRESARIAL',
        'contador' => 'CONTADOR PUBLICO',
    ];

    $carreraNombre = $carrerasMap[$carrera] ?? 'CARRERA NO ESPECIFICADA';

    // Obtener los datos del admin
    $admin = Admin::findOrFail($studentId);

    // Obtener el nombre del administrador
    $adminNombreCompleto = $instructor
    ? mb_strtoupper('LIC. '.$admin->user->nombreReal . ' ' . $admin->user->apellidoP . ' ' . $admin->user->apellidoM)
    : ' ';

    //TEXTO
    $texto = mb_convert_encoding(
        " con un BUEN nivel de desempeño",
        'ISO-8859-1',
        'UTF-8'
    );

    $leyenda = mb_convert_encoding(
        "\"Excelencia en Educación Tecnológica\"",
        'ISO-8859-1',
        'UTF-8'
    );

    // Ruta del archivo PDF de la plantilla
    $pdfTemplatePath = storage_path('app/public/certificados/plantilla.pdf');

    // Crear una nueva instancia de FPDI
    $pdf = new Fpdi();

    //Obtener la fecha actual
    Carbon::setLocale('es'); // Configurar Carbon en español
    $fechaActual = now()->format('d') . '/' . ucfirst(now()->locale('es')->isoFormat('MMMM')) . '/' . now()->format('Y');
    $diaActual = now()->format('d');
    $mesAActual =ucfirst(now()->locale('es')->isoFormat('MMMM'). ' del ' . now()->format('Y'));
    $añoActual =now()->format('Y');

    // Obtener el último folio registrado
    $ultimoFolio = DB::table('folios')->latest()->first();
    $folio = $ultimoFolio ? $ultimoFolio->numero + 1 : 1; // Si no hay folios, empezar con 1

    // Después de generar el número de folio, lo guardamos en la base de datos
    DB::transaction(function () {
        // Bloquear la tabla para lectura y escritura (lockForUpdate)
        $ultimoFolio = DB::table('folios')->lockForUpdate()->latest('numero')->first();
    
        // Determinar el nuevo número de folio
        $folio = $ultimoFolio ? $ultimoFolio->numero + 1 : 1;
    
        // Insertar el nuevo folio en la base de datos
        DB::table('folios')->insert([
            'numero' => $folio,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    });
    

    // Cargar el archivo de la fuente personalizada
    //$pdf->AddFont('NotoSans', '', public_path('fonts/noto_sans.php'));  // Cambia la ruta si es necesario

    // Cargar el archivo PDF de la plantilla
    $pdf->setSourceFile($pdfTemplatePath);

    // Importar la primera página
    $templatePage = $pdf->importPage(1);
    $pdf->addPage();
    $pdf->useTemplate($templatePage);

    $pdf->SetFont('Arial', 'B', 10); // Fuente en negrita
    $pdf->SetXY(125, 55);
    $pdf->Cell(0, 0, 'Chilpancingo de los Bravo, Gro, '.$fechaActual, 0, 1, 'C'); 
    $pdf->Text(170, 60,'Oficio No. '. $folio.'/'.$añoActual); // Título principal

    $pdf->SetFont('Arial', 'B', 10); // Fuente normal
    $pdf->Text(25, 70, 'M.C. MARGARITA ALCOCER SOLACHE'); // Texto normal
    $pdf->Text(25, 75, 'JEFA DEL DEPARTAMENTO DE SERVICIOS ESCOLARES'); // Texto normal
    $pdf->Text(25, 80, 'DEL INSTITUTO TECNOLOGICO DE CHILPANCINGO'); // Texto normal
    $pdf->Text(25, 85, 'P R E S E N T E'); // Texto normal

    // Texto del párrafo
    $pdf->SetFont('Arial', '', 9); 
    $pdf->Text(25, 100,  "El que suscribe ".strtoupper($instructorNombreCompleto).", por este medio se permite hacer de su conocimiento que el");
    $pdf->Text(25, 105, "estudiante ".strtoupper($student->user->apellidoP)." ".strtoupper($student->user->apellidoM)." ".strtoupper($student->user->nombreReal)." con numero de control ".$student->no_control." de la carrera de ".$carreraNombre);
    $pdf->Text(25, 110," \"SI\" ha ACREDITADO la actividad complementaria ".$tallerNombre.$texto. " durante el");
    $pdf->Text(25, 115, "periodo escolar ". $student->periodo." satisfactoriamente.");
    //$pdf->Text(25, 120, ", con un valor curricular de"." X" ." credito"."s".".");
    
    $pdf->Text(25, 135,"Se extiende la presente en la Ciudad de Chilpancingo de los Bravo, Guerrero, a los ".$diaActual." dias del ");
    $pdf->Text(25, 140, "mes de ".$mesAActual.".");

    $pdf->SetFont('Arial', 'B', 10); 
    $pdf->Text(25, 190, "A T E N T A M E N T E");
    $pdf->SetFont('Arial', 'BI', 8); 
    $pdf->Text(25, 195, $leyenda);
/*
    $pdf->Text(25, 190, "_____________________________________________");
    $pdf->SetFont('Arial', 'B', 10); 
    $pdf->Text(40, 195, $instructorNombreCompleto);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Text(40, 200, "INSTRUCTOR RESPONSABLE");
*/
    //$pdf->Text(60, 190, "_____________________________________________");
    $pdf->SetFont('Arial', 'B', 10); 
    $pdf->Text(25, 215, $adminNombreCompleto);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Text(25, 220, "JEFE DEL DEPTO. DE ACTIVIDADES EXTRAESCOLARES");

    $pdf->SetFont('Arial', '',8);
    $pdf->Text(25, 240, "ccp. Archivo");

    // Generar el PDF y ofrecerlo para su descarga
    $pdfOutputPath = storage_path('app/public/certificados/' . 'constancia_' . $student->id . '.pdf');
    $pdf->Output('F', $pdfOutputPath); // Guardar el PDF generado

    return response()->download($pdfOutputPath); // Descargar el PDF generado
}


}
