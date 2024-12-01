<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Usuarios;
use App\Models\Rol;
use App\Models\Area;
use App\Models\Curso;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class cursoProfeController extends Controller
{
    public function index()
{
    
        $usuarioId = Auth::id();
        $usuario = Usuarios::where('id', $usuarioId);
        $cursos = Curso::all();
      

        return view('profesor.mis_cursos', compact('usuario', 'cursos'));
  
}
}
