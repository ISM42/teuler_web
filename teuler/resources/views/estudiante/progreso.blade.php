@extends('layouts.template_teuler')
@section('titulo','Mi progreso')
@section('contenido')

<!-- Inicio tabla -->
<div class="container mx-auto mt-8 p-4" style="height: 65vh;">
  <div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Cursos</h2>
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-900 border-collapse border border-gray-900 rounded-lg overflow-hidden">
        <thead class="bg-gray-100 rounded-lg">
          <tr>
            <th class="border border-gray-200 px-4 py-2">Profesor</th>
            <th class="border border-gray-200 px-4 py-2">Curso</th>
            <th class="border border-gray-200 px-4 py-2">Módulo</th>
            <th class="border border-gray-200 px-4 py-2 text-center">Ejercicios Respondidos</th>
            <th class="border border-gray-200 px-4 py-2 text-center">Aciertos</th>
            <th class="border border-gray-200 px-4 py-2 text-center">Ejercicios Requeridos</th>
          </tr>
        </thead>
        <tbody>
          @foreach($resultados as $resultado)
          <tr class="hover:bg-gray-50">
            <td class="border border-gray-200 px-4 py-2">{{ $resultado->nombre }} {{ $resultado->apellido_p }} {{ $resultado->apellido_m }}</td>
            <td class="border border-gray-200 px-4 py-2">{{ $resultado->curso }}</td>
            <td class="border border-gray-200 px-4 py-2">{{ $resultado->nombre_modulo }}</td>
            <td class="border border-gray-200 px-4 py-2 text-center">{{ $resultado->num_respuestas }}</td>
            <td class="border border-gray-200 px-4 py-2 text-center">{{ $resultado->num_respuestas_correctas }}</td>
            <td class="border border-gray-200 px-4 py-2 text-center">{{ $resultado->num_min_preguntas }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Fin tabla -->


@endsection