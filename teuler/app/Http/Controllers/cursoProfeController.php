<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Usuarios;
use App\Models\Rol;
use App\Models\Area;
use App\Models\Curso;
use App\Models\cursoProfesor;
use DB;


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


    public function progresoAlumnos()
    {
        $profesorId = Auth::id();
    
        $resultados = DB::table('inscripciones')
            ->join('usuarios as estudiante', 'inscripciones.id_usuario', '=', 'estudiante.id')
            ->join('curso_profesor', 'inscripciones.id_curso_prof', '=', 'curso_profesor.id')
            ->join('cursos', 'curso_profesor.id_curso', '=', 'cursos.id')
            ->join('respuestas', 'estudiante.id', '=', 'respuestas.id_usuario')
            ->join('modulos_tematicos', 'respuestas.id_modulo', '=', 'modulos_tematicos.id')
            ->select(
                'estudiante.nombre',
                'estudiante.apellido_p',
                'estudiante.apellido_m',
                'estudiante.email',
                'cursos.nombre as curso',
                'modulos_tematicos.nombre as nombre_modulo',
                DB::raw('COUNT(respuestas.id) as num_respuestas'),
                DB::raw('SUM(CASE WHEN respuestas.es_correcto = 1 THEN 1 ELSE 0 END) as num_respuestas_correctas'),
                'modulos_tematicos.num_min_preguntas'
            )
            ->where('inscripciones.estatus', 1)
            ->where('curso_profesor.id_profesor', $profesorId)
            ->groupBy(
                'estudiante.nombre',
                'estudiante.apellido_p',
                'estudiante.apellido_m',
                'estudiante.email',
                'cursos.nombre',
                'modulos_tematicos.nombre',
                'modulos_tematicos.num_min_preguntas'
            )
            ->get();
    //dd($resultados);
        return view('profesor.progreso_alumnos', compact('resultados'));
    }

}