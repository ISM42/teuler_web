<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Usuarios;
use App\Models\Rol;
use App\Models\Area;
use App\Models\Curso;
use App\Models\cursoProfesor;
use App\Models\inscripciones;
use DB;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class InscripcionesController extends Controller
{
    public function index()
    {
    $usuarioId = Auth::id();
    $usuario = Usuarios::where('id', $usuarioId)->first();
    $registroCursos = inscripciones::with('insCursos')->where('id_usuario', $usuarioId)->where('estatus', '!=', 0)->get();
    //dd($registroCursos);
    $cursosRegistradosIds = $registroCursos->pluck('id_curso_prof')->toArray();
    
    
    $cursos_inscritos = DB::table('inscripciones')
            ->join('curso_profesor', 'curso_profesor.id', '=', 'inscripciones.id_curso_prof')
            ->join('cursos', 'curso_profesor.id_curso', '=', 'cursos.id')
            ->join('usuarios as prof', 'prof.id', '=', 'curso_profesor.id_profesor')
            ->select(
                'inscripciones.id as id',
                'cursos.nombre as nombre_curso',
                'prof.nombre as nombre_prof',
                'prof.apellido_p',
                'prof.apellido_m'
            )
            ->where('inscripciones.estatus', 1)
            ->where('inscripciones.id_usuario',$usuarioId)
            ->get();
    
    $cursos = cursoProfesor::with('cursos')->with('profesor')->whereNotIn('id', $cursosRegistradosIds)->where('estatus', '!=', 0)->get();
    //dd($cursos);
    
    return view('estudiante.mi_aprendizaje', compact('usuario', 'cursos', 'cursos_inscritos'));
    }
    
    public function store(Request $request)
    {
        $usuarioId = Auth::id();
        
    
            //Agregar curso
            $nuevaInscripcion = new inscripciones();
            $nuevaInscripcion->id_usuario = $usuarioId;
            $nuevaInscripcion->id_curso_prof = $request->agregarCursoP;
           
            $nuevaInscripcion->save(); // Guardar primero para obtener el ID
    
            return redirect()->back();
       
    
    }
    
    
    //borrado lógico de la inscripción
    public function destroy($id)
        {
            
                $borrarIns = inscripciones::findOrFail($id);
                $borrarIns->estatus = 0;
                $borrarIns->updated_at = Carbon::now()->toDateString();
                $borrarIns->save();
    
                return redirect()->back();
            
        }


    public function progresoEstudiante()
{

    $usuarioId=Auth::id();
    $resultados = DB::table('inscripciones')
        ->join('curso_profesor', 'inscripciones.id_curso_prof', '=', 'curso_profesor.id')
        ->join('usuarios as profesor', 'curso_profesor.id_profesor', '=', 'profesor.id')
        ->join('cursos', 'curso_profesor.id_curso', '=', 'cursos.id')
        ->join('respuestas', 'inscripciones.id_usuario', '=', 'respuestas.id_usuario')
        ->join('modulos_tematicos', 'respuestas.id_modulo', '=', 'modulos_tematicos.id')
        ->select(
            'profesor.nombre',
            'profesor.apellido_p',
            'profesor.apellido_m',
            'profesor.email',
            'cursos.nombre as curso',
            'modulos_tematicos.nombre as nombre_modulo',
            DB::raw('COUNT(respuestas.id) as num_respuestas'),
            DB::raw('SUM(CASE WHEN respuestas.es_correcto = 1 THEN 1 ELSE 0 END) as num_respuestas_correctas'),
            'modulos_tematicos.num_min_preguntas'
        )
        ->where('inscripciones.estatus', 1)
        ->where('inscripciones.id_usuario', $usuarioId)
        ->groupBy(
            'profesor.nombre',
            'profesor.apellido_p',
            'profesor.apellido_m',
            'profesor.email',
            'cursos.nombre',
            'modulos_tematicos.nombre',
            'modulos_tematicos.num_min_preguntas'
        )
        ->get();
//dd($resultados);
    return view('estudiante.progreso', compact('resultados'));
}
}
