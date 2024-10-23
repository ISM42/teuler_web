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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->timestamps();
           
        });

        DB::table('cursos')->insert([
        
            [
                'nombre' => 'Álgebra',
                'id' => 1,
            ],
            [
                'nombre' => 'Geometría Euclidiana',
                'id' => 2,
            ],
            [
                'nombre' => 'Trigonometría',
                'id' => 3,
            ],
            [
                'nombre' => 'Geometría Analítica',
                'id' => 4,
            ],
            [
                'nombre' => 'Cálculo Diferencial',
                'id' => 5,
            ],
            [
                'nombre' => 'Cálculo Integral',
                'id' => 6,
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
