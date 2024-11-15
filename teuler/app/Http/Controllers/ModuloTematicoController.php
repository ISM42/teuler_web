<?php

namespace App\Http\Controllers;

use App\Models\ModuloTematico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuloTematicoController extends Controller
{
    /**
     * Obtiene 10 preguntas aleatorias de la colección de MongoDB correspondiente a un módulo temático específico.
     *
     * @param int $id El ID del módulo temático en la base de datos relacional.
     * @return \Illuminate\Contracts\View\View Una vista que contiene las preguntas aleatorias.
     */
    public function obtenerPreguntasAleatorias($id)
    {
        // Encuentra el módulo temático por su ID en MySQL
        $modulo = ModuloTematico::find($id);
//dd($modulo);
        if (!$modulo || !$modulo->ruta_preguntas) {
            // Retorna un error si el módulo no se encuentra o no tiene una ruta definida
            return response()->json(['error' => 'Módulo temático no encontrado o sin ruta de preguntas'], 404);
        }

        // Obtiene el nombre de la colección de MongoDB desde el campo ruta_pregunta
        $nombreColeccion = $modulo->ruta_preguntas;
       // dd($nombreColeccion);

        // Accede a MongoDB y selecciona la colección específica
        $preguntas = DB::connection('mongodb')
            ->getMongoDB()
            ->selectCollection($nombreColeccion)
            ->aggregate([
                ['$sample' => ['size' => 20]] // Selecciona 10 documentos al azar
            ])
            ->toArray(); // Convierte el cursor a un array
//dd($preguntas);
        return view('preguntas', ['preguntas' => $preguntas]);
    }


//función para guardar la respuesta del usuario
public function guardarRespuesta(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'pregunta_id' => 'required',
            'respuesta' => 'required',
        ]);

        // Obtener la pregunta de MongoDB utilizando su ID
        $preguntaId = new ObjectId($request->input('pregunta_id'));
        $pregunta = \DB::connection('mongodb')
                        ->getMongoDB()
                        ->selectCollection('ejercicios_despejes')
                        ->findOne(['_id' => $preguntaId]);

        // Guardar la respuesta del usuario en la base de datos relacional o MongoDB según tus necesidades
        // Aquí puedes almacenar la respuesta en una colección de respuestas o en una tabla SQL

        $respuestaUsuario = [
            'pregunta_id' => $preguntaId,
            'respuesta' => $request->input('respuesta'),
            'correcta' => $pregunta['correcta'] === $request->input('respuesta'), // Verificar si es correcta
            'fecha' => now(),
        ];

        // Ejemplo de guardar en una colección de MongoDB llamada "respuestas_usuarios"
        \DB::connection('mongodb')
            ->getMongoDB()
            ->selectCollection('respuestas_usuarios')
            ->insertOne($respuestaUsuario);

        // Redireccionar a la misma página o mostrar mensaje de éxito
        return redirect()->back()->with('success', 'Respuesta guardada correctamente');
    }


}
