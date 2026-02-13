<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InstructorWorkshop extends Pivot
{
    use HasFactory;

    protected $table = 'instructor_workshop';

    protected $fillable = [
        'instructor_id',
        'workshop_id',
    ];
}
