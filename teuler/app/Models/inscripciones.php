<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inscripciones extends Model
{
    use HasFactory;
     // Nombre de la tabla
     protected $table = 'inscripciones';

     // Campos asignables
     protected $fillable = ['id_curso_prof', 'id_usuario'];
}
