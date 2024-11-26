<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuarios extends Authenticatable
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
        'estatus',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rol()
{
    return $this->belongsTo(Rol::class, 'id_rol');
}

public function area()
{
    return $this->belongsTo(Area::class, 'id_area');
}

}
