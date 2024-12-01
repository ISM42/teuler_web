<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cursoProfesor extends Model
{
    use HasFactory;
    // Nombre de la tabla
    protected $table = 'curso_profesor';

    // Campos asignables
    protected $fillable = ['id_profesor', 'id_curso'];

    public function cursos(){
        return $this->belongsTo(Curso::class,'id_curso');
    }
}
