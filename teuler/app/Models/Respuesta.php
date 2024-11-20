<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_reactivo',
        'id_modulo',
        'respuesta_alumno',
        'es_correcto',
        
    ];
}
