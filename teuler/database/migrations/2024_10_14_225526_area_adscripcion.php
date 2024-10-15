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
        Schema::create('area_adscripcion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->timestamps();
        });

        DB::table('area_adscripcion')->insert([
            [
                'nombre' => 'Bellas Artes',
                'nombre' => 'C. Administrativas',
                'nombre' => 'C. Biológicas y de la Salud',
                'nombre' => 'C. Sociales',
                'nombre' => 'Docencia',
                'nombre' => 'Físico-Matemáticas',
                'nombre' => 'Finanzas y Economía',
                                
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
