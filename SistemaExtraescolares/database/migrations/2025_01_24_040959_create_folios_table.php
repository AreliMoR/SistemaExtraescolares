<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('folios', function (Blueprint $table) {
        $table->id();  // Un identificador único para la fila
        $table->integer('numero')->unique();  // Número de folio
        $table->timestamps();  // Tiempos de creación y actualización
    });
}

public function down()
{
    Schema::dropIfExists('folios');
}

};
