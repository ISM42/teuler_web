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
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('usuarios');
            $table->foreignId('id_reactivo')->constrained('modulos_tematicos');  //revisar
            $table->foreignId('id_modulo')->constrained('modulos_tematicos');
            $table->string('respuesta_alumno', 1);
            $table->boolean('es_correcto');
            $table->time('tiempo_empleado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
