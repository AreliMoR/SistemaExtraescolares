<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;

    // Especifica el nombre correcto de la tabla
    protected $table = 'talleres';

    protected $fillable = ['nombre', 'descripcion','categoria',  'horario', 'user_id'];

    public function instructor()
{
    return $this->belongsTo(Instructor::class, 'user_id', 'user_id');
}

    public function students()
{
    return $this->belongsToMany(Student::class, 'student_taller', 'taller_id', 'student_id');
}


}

