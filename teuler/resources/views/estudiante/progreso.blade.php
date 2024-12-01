@extends('layouts.template_teuler')
@section('titulo','Mi progreso')
@section('contenido')

<!-- Inicio tabla -->
<div class="container mx-auto mt-8 flex justify-center">
  <div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Cursos</h2>
    <table class="min-w-full border-collapse border border-gray-300 rounded-lg overflow-hidden">
      <thead>
        <tr class="bg-gray-100">
          <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Profesor</th>
          <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Curso</th>
          <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Módulo</th>
          <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Ejercicios respondidos</th>
          <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Aciertos</th>
          <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Ejercicios requeridos</th>
        </tr>
      </thead>
      <tbody>
      @foreach($resultados as $resultado)
        <tr class="hover:bg-gray-50">
        <td class="px-4 py-2 border-b">{{$resultado->nombre}} {{$resultado->apellido_p}} {{$resultado->apellido_m}}</td>
        <td class="px-4 py-2 border-b">{{$resultado->curso}}</td>
        <td class="px-4 py-2 border-b">{{$resultado->nombre_modulo}}</td>
        <td class="px-4 py-2 border-b">{{$resultado->num_respuestas}}</td>
        <td class="px-4 py-2 border-b">{{$resultado->num_respuestas_correctas}}</td>
        <td class="px-4 py-2 border-b">{{$resultado->num_min_preguntas}}</td>
         
          </td>
        </tr>
        @endforeach

        </tbody>
    </table>
  </div>
</div>

<!-- Fin tabla -->

@endsection