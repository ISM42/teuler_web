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
        Schema::create('progreso_modulo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_alumno')->constrained('usuarios');
            $table->foreignId('id_modulo')->constrained('modulos_tematicos');
            $table->integer('intentos');
            $table->decimal('progreso', 5, 2);
            $table->time('tiempo_empleado');
            $table->timestamps();

            //restricción para que el alumno sólo pueda registrarse una sola vez al mismo módulo.
            $table->unique(['id_alumno', 'id_modulo']);

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
