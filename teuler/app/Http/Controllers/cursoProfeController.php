<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Usuarios;
use App\Models\Rol;
use App\Models\Area;
use App\Models\Curso;
use App\Models\cursoProfesor;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class cursoProfeController extends Controller
{
    public function index()
{
$usuarioId = Auth::id();
$usuario = Usuarios::where('id', $usuarioId)->first();
$registroCursos = cursoProfesor::with('cursos')->where('id_profesor', $usuarioId)->where('estatus', '!=', 0)->get();

$cursosRegistradosIds = $registroCursos->pluck('cursos.id')->toArray();

$cursos = Curso::whereNotIn('id', $cursosRegistradosIds)->get();

return view('profesor.mis_cursos', compact('usuario', 'cursos', 'registroCursos'));
}

public function store(Request $request)
{
    $usuarioId = Auth::id();
    

        //Agregar curso
        $nuevoCurso = new cursoProfesor();
        $nuevoCurso->id_profesor = $usuarioId;
        $nuevoCurso->id_curso = $request->agregarCursoP;
       
        $nuevoCurso->save(); // Guardar primero para obtener el ID

        return redirect()->back();
   

}


//borrado lógico del curso
public function destroy($id)
    {
        
            $borrarCurso = cursoProfesor::findOrFail($id);
            $borrarCurso->estatus = 0;
            $borrarCurso->updated_at = Carbon::now()->toDateString();
            $borrarCurso->save();

            return redirect()->back();
        
    }

}