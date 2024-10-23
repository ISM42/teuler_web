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
                'id' => 1,
            ],
            [
                'nombre' => 'C. Administrativas',
                'id' => 2,
            ],
            [
                'nombre' => 'C. Biológicas y de la Salud',
                'id' => 3,
            ],
            [
                'nombre' => 'C. Sociales',
                'id' => 4,
            ],
            [
                'nombre' => 'Docencia',
                'id' => 5,
            ],
            [
                'nombre' => 'Físico-Matemáticas',
                'id' => 6,
            ],
            [
                'nombre' => 'Finanzas y Economía',
                'id' => 7,
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
