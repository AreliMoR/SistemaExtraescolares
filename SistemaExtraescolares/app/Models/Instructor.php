<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'actividad',
        'taller',
        'dia',
        'horario'
    ];
    

    // Relación con el modelo User (un instructor pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function talleres()
    {
        return $this->hasMany(Taller::class, 'user_id', 'user_id');
    }
    

}
