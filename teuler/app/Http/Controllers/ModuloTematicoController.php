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
                ['$sample' => ['size' => 10]] // Selecciona 10 documentos al azar
            ])
            ->toArray(); // Convierte el cursor a un array
//dd($preguntas);
        return view('preguntas', ['preguntas' => $preguntas]);
    }
}
