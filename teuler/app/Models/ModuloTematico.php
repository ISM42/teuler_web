<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuloTematico extends Model
{
    protected $table = 'modulos_tematicos';
    use HasFactory;


    protected $fillable = [
        
       'id_curso',
        'nombre', 
        'ruta_preguntas', 
        'num_min_preguntas',
        
        
    ];


    
}
