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
        Schema::create('modulos_tematicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_curso')->constrained('cursos');
            $table->string('nombre', 100);
            $table->text('ruta_preguntas')->nullable();
            $table->integer('num_min_preguntas');
            $table->timestamps();
        });

        DB::table('modulos_tematicos')->insert([
            [
                'nombre' => 'Expresiones Algebraicas',
                'id_curso' => 1,
                'ruta_preguntas' => 'ejercicios_expresiones_algebraicas', //establecer la ruta en cuanto se tenga la colección de MongoDB
                'num_min_preguntas'=>20,
            ],
            [
                'nombre' => 'Productos Notables',
                'id_curso' => 1,
                'ruta_preguntas' => '',
                'num_min_preguntas'=>20,
            ],
            [
                'nombre' => 'Factorización',
                'id_curso' => 1,
                'ruta_preguntas' => '',
                'num_min_preguntas'=>20,
            ],
            [
                'nombre' => 'Despejes y Ecuaciones Lineales',
                'id_curso' => 1,
                'ruta_preguntas' => 'ejercicios_despejes',
                'num_min_preguntas'=>20,
            ],
            [
                'nombre' => 'Desigualdades',
                'id_curso' => 1,
                'ruta_preguntas' => '',
                'num_min_preguntas'=>20,
            ],
            [
                'nombre' => 'Ecuaciones Cuadráticas y Sistemas de Ecuaciones',
                'id_curso' => 1,
                'ruta_preguntas' => '',
                'num_min_preguntas'=>20,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
