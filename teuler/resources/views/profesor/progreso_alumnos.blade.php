@extends('layouts.template_teuler')
@section('titulo','Progreso Alumnos')
@section('contenido')

<!-- Inicio tabla -->
<div class="container mx-auto mt-8 p-4" style="height: 65vh;">
  <div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Cursos</h2>
    @php
        // Agrupar resultados por estudiante
        $estudiantes = $resultados->groupBy(function ($item) {
            return $item->nombre . ' ' . $item->apellido_p . ' ' . $item->apellido_m;
        });
    @endphp

    @foreach($estudiantes as $estudiante => $modulos)
        <div class="mb-6 border rounded-lg shadow-md">
            <div class="bg-gray-900 text-white px-4 py-2 rounded-t-lg">
                <h3 class="text-lg font-semibold">{{ $estudiante }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700 border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-200 px-4 py-2">Módulo Temático</th>
                            <th class="border border-gray-200 px-4 py-2">Curso</th>
                            <th class="border border-gray-200 px-4 py-2">Preguntas Resueltas</th>
                            <th class="border border-gray-200 px-4 py-2">Preguntas Correctas</th>
                            <th class="border border-gray-200 px-4 py-2">Preguntas Mínimas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($modulos as $modulo)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-200 px-4 py-2">{{ $modulo->nombre_modulo }}</td>
                                <td class="border border-gray-200 px-4 py-2">{{ $modulo->curso }}</td>
                                <td class="border border-gray-200 px-4 py-2 text-center">{{ $modulo->num_respuestas }}</td>
                                <td class="border border-gray-200 px-4 py-2 text-center">{{ $modulo->num_respuestas_correctas }}</td>
                                <td class="border border-gray-200 px-4 py-2 text-center">{{ $modulo->num_min_preguntas }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
  </div>
</div>
<!-- Fin tabla -->


@endsection