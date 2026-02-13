<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_taller',
        'tipo_actividad',
    ];

    // Relación con el modelo Instructor (muchos a muchos)
    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'instructor_workshop');
    }
}
