@extends('layouts.template_teuler')
@section('titulo','Progreso Alumnos')
@section('contenido')

<!-- Inicio tabla -->
<div class="container mx-auto mt-8 flex justify-center">
  <div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Cursos</h2>
@php
        // Agrupar resultados por estudiante
        $estudiantes = $resultados->groupBy(function ($item) {
            return $item->nombre . ' ' . $item->apellido_p . ' ' . $item->apellido_m;
        });
@endphp

@foreach($estudiantes as $estudiante => $modulos)
        <div class="card mb-4">
            <div class="card-header bg-primary text-black">
                <h3 class="mb-0">{{ $estudiante }}</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>Módulo Temático</th>
                            <th>Curso</th>
                            <th>Preguntas Resueltas</th>
                            <th>Preguntas Correctas</th>
                            <th>Preguntas Mínimas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($modulos as $modulo)
                            <tr>
                                <td>{{ $modulo->nombre_modulo }}</td>
                                <td>{{ $modulo->curso }}</td>
                                <td>{{ $modulo->num_respuestas }}</td>
                                <td>{{ $modulo->num_respuestas_correctas }}</td>
                                <td>{{ $modulo->num_min_preguntas }}</td>
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