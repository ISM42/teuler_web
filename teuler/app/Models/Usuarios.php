<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'usuarios';  // Especificar la tabla

    protected $fillable = [
        'id_rol',
        'id_area', 
        'nombre', 
        'apellido_p', 
        'apellido_m',
        'email', 
        'password',
    ];

    protected $hiddens = [
        'password',
        'remember_token',
    ];
}
