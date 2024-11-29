<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresoModulo extends Model
{

    use HasFactory;

    protected $table = 'progreso_modulo';
    protected $fillable = [
        'id_alumno',
        'id_modulo',
        'intentos',
        'progreso',
       
    ];
}
