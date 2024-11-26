<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{

    protected $table = 'roles';
    use HasFactory;


    protected $fillable = [
        
        'nombre'
        
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuarios::class, 'id_rol');
    }
}
