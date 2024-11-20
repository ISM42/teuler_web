<?php

namespace App\Http\Controllers;

use App\Models\ModuloTematico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Respuesta;
use App\Models\ProgresoModulo;

class ModuloTematicoController extends Controller
{
    public function obtenerPreguntasAleatorias($id)
    {
        $modulo = ModuloTematico::find($id);
        if (!$modulo || !$modulo->ruta_preguntas) {
            return response()->json(['error' => 'Módulo temático no encontrado o sin ruta de preguntas'], 404);
        }

        $nombreColeccion = $modulo->ruta_preguntas;
        //$usuario_id = auth()->user()->id;
        $usuario_id =1;

        // Obtener IDs de preguntas ya respondidas en este módulo por el usuario
        $preguntasRespondidas = Respuesta::where('id_usuario', $usuario_id)
            ->where('id_modulo', $id)
            ->pluck('id_reactivo')
            ->toArray();

        // Obtener 10 preguntas aleatorias excluyendo las respondidas
        $preguntas = DB::connection('mongodb')
            ->getMongoDB()
            ->selectCollection($nombreColeccion)
            ->aggregate([
                ['$match' => ['_id' => ['$nin' => $preguntasRespondidas]]],
                ['$sample' => ['size' => 10]]
            ])
            ->toArray();

        return view('preguntas', ['preguntas' => $preguntas, 'modulo_id' => $id]);
    }

    public function guardarRespuesta(Request $request)
    {
        
            \Log::info('Datos recibidos en guardarRespuesta:', $request->all());
    
            if (!auth()->check()) {
                return response()->json(['success' => false, 'message' => 'Usuario no autenticado.'], 401);
            }
    
            $usuarioId = auth()->user()->id;
    
            // Validar y cargar módulo temático
            $modulo = ModuloTematico::find($request->input('modulo_id'));
            if (!$modulo) {
                return response()->json(['success' => false, 'message' => 'Módulo no encontrado.'], 404);
            }
    
            $nombreColeccion = $modulo->ruta_preguntas;
    
            // Buscar pregunta en MongoDB
            $pregunta = DB::connection('mongodb')
                ->getMongoDB()
                ->selectCollection($nombreColeccion)
                ->findOne(['_id' => new \MongoDB\BSON\ObjectId($request->input('pregunta_id'))]);
    
            if (!$pregunta) {
                return response()->json(['success' => false, 'message' => 'Pregunta no encontrada.'], 404);
            }
    
            // Procesar respuesta del alumno
            $respuestaAlumno = trim((string) $request->input('respuesta')); // Convertir a string y limpiar espacios
            $esCorrecto = false;
    
            // Comparar según el tipo de pregunta
            if (isset($pregunta['correcta'])) {
                $esCorrecto = $pregunta['correcta'] == $respuestaAlumno;
            } elseif (isset($pregunta['opciones'])) {
                $esCorrecto = array_key_exists($respuestaAlumno, (array)$pregunta['opciones']);
            }
    
            // Guardar la respuesta
            $respuesta = new Respuesta();
            $respuesta->id_usuario = $usuarioId;
            $respuesta->id_reactivo = $request->input('pregunta_id');
            $respuesta->id_modulo = $request->input('modulo_id');
            $respuesta->respuesta_alumno = $respuestaAlumno;
            $respuesta->es_correcto = $esCorrecto;
            $respuesta->save();
    
            // Actualizar progreso
            $progresoModulo = ProgresoModulo::firstOrCreate(
                ['id_alumno' => $usuarioId, 'id_modulo' => $respuesta->id_modulo],
                ['intentos' => 1, 'progreso' => 0]
            );
            $progresoModulo->progreso += 10;
            $progresoModulo->save();
    
            return response()->json([
                'success' => true,
                'progreso' => $progresoModulo->progreso,
                'es_correcto' => $esCorrecto,
            ]);
        
    }
    
    
    

}