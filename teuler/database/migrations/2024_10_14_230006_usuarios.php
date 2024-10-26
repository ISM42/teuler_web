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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rol')->constrained('roles');
            $table->foreignId('id_area')->constrained('area_adscripcion');
            $table->string('nombre', 60);
            $table->string('apellido_p', 60);
            $table->string('apellido_m', 60);
            $table->string('email', 80);
            $table->binary('password');
            $table->boolean('estatus')->default(1);
            $table->timestamps();
        });

DB::table('usuarios')->insert([
    
   [ 'id_rol' => 1,
     'id_area' =>6,
      'nombre' => 'Joaquín',
       'apellido_p' => 'Rodríguez',
        'apellido_m' => 'Camacho',
         'email' =>'joaco.mc@example.com',
          'password' => bcrypt('12345678'),
],

[ 'id_rol' => 2,
'id_area' =>6,
 'nombre' => 'Lorena',
  'apellido_p' => 'Jiménez',
   'apellido_m' => 'Saucedo',
    'email' =>'saucedo.jl@example.com',
     'password' => bcrypt('12345678'),
]

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
