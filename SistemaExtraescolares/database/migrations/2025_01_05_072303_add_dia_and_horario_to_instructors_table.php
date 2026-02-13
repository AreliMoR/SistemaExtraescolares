<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiaAndHorarioToInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instructors', function (Blueprint $table) {
            // Añadir las columnas 'dia' y 'horario'
            $table->string('dia')->nullable();      // Día del taller
            $table->string('horario')->nullable();  // Horario del taller
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instructors', function (Blueprint $table) {
            // Eliminar las columnas 'dia' y 'horario'
            $table->dropColumn(['dia', 'horario']);
        });
    }
}
