<?php

namespace App\Models\MongoModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Mongodb\Eloquent\Model as Eloquent;

class Preguntas extends Model
{
    protected $connection = 'mongodb'; // Usa la conexión de MongoDB
    protected $collection = 'ejercicios_despejes'; // Nombre de la colección en MongoDB
    
}
