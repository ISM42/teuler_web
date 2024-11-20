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
        try {
            \Log::info('Datos recibidos en guardarRespuesta:', $request->all());
    
            if (!auth()->check()) {
                \Log::error("Usuario no autenticado.");
                return response()->json(['success' => false, 'message' => 'Usuario no autenticado.']);
            }
    
            $usuarioId = auth()->check() ? auth()->user()->id : 1; // ID de prueba (1)
    
            $modulo = ModuloTematico::find($request->input('modulo_id'));
            if (!$modulo) {
                \Log::error("Módulo no encontrado con ID: " . $request->input('modulo_id'));
                return response()->json(['success' => false, 'message' => 'Módulo no encontrado.']);
            }
    
            $nombreColeccion = $modulo->ruta_preguntas;
            \Log::info('Nombre de la colección en MongoDB:', [$nombreColeccion]);
    
            $pregunta = DB::connection('mongodb')
                ->getMongoDB()
                ->selectCollection($nombreColeccion)
                ->findOne(['_id' => new \MongoDB\BSON\ObjectId($request->input('pregunta_id'))]);
    
            if (!$pregunta) {
                \Log::error("Pregunta no encontrada en MongoDB.");
                return response()->json(['success' => false, 'message' => 'Pregunta no encontrada.']);
            }
    
            // Convertir respuesta del alumno y correcta a strings para comparación
            $respuestaAlumno = (string) $request->input('respuesta');
            $respuestaCorrecta = isset($pregunta['correcta']) ? (string) $pregunta['correcta'] : null;
    
            // Guardar la respuesta
            $respuesta = new Respuesta();
            $respuesta->id_usuario = $usuarioId;
            $respuesta->id_reactivo = $request->input('pregunta_id');
            $respuesta->id_modulo = $request->input('modulo_id');
            $respuesta->respuesta_alumno = $respuestaAlumno;
            $respuesta->es_correcto = $respuestaCorrecta === $respuestaAlumno; // Comparar como cadenas
    
            $respuesta->save();
    
            // Actualizar progreso
            $progresoModulo = ProgresoModulo::firstOrCreate(
                ['id_alumno' => $usuarioId, 'id_modulo' => $respuesta->id_modulo],
                ['intentos' => 1, 'progreso' => 0]
            );
            $progresoModulo->progreso += 10;
            $progresoModulo->save();
    
            \Log::info("Progreso actualizado: {$progresoModulo->progreso}% para usuario {$usuarioId}");
    
            return response()->json(['success' => true, 'progreso' => $progresoModulo->progreso]);
    
        } catch (\Exception $e) {
            \Log::error('Error en guardarRespuesta: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error al procesar la solicitud.']);
        }
    }
    
    
    

}