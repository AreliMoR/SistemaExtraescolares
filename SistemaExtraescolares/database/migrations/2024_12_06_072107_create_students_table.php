<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

     public function up(): void
     {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('user_id');
            $table->string('no_control')->unique();
            $table->string('carrera');
            $table->string('semestre');
            $table->string('periodo');
            $table->string('taller_actual')->nullable();
            $table->timestamps();
        
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        });
        
     }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
