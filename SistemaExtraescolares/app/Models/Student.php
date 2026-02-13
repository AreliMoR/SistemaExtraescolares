<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_control',
        'carrera',
        'semestre',
        'periodo',
        'taller_actual'
    ];

    // Relación con el modelo User (un alumno pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // app/Models/Student.php

    // Relación muchos a muchos entre Student y Taller// App\Models\Student
    public function talleres()
    {
        return $this->belongsToMany(Taller::class, 'student_taller', 'student_id', 'taller_id');
    }

}
