@extends('layouts.template_teuler')
@section('titulo','Mi aprendizaje')
@section('contenido')

<main class="flex-grow mb-10 pb-10 pt-10">
<section class="bg-white py-20">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-6">Mi aprendizaje</h1>
                <p class="text-lg text-gray-600 mb-8">
                   

                <!-- div para dropdown select cursos disponibles para el profesor -->
                <div>
        <form action="/guardar_inscripcion" method="POST">
            @csrf
    <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Cursos disponibles</label>
    <select name="agregarCursoP" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
        <option value="" disabled selected>Seleccione un curso</option>
        @foreach($cursos as $curso)
        <option value="{{$curso -> id}}">{{$curso->cursos->nombre}} - {{$curso->profesor->nombre}} {{$curso->profesor->apellido_p}} {{$curso->profesor->apellido_m}}</option>
       @endforeach
    </select>
</div>
<!-- fin select para cursos profesor -->

<!-- div botón agregar -->
<div class="flex justify-center pt-5">
<button type='submit' class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition-all">Agregar</button>
</div>
<!-- fin botón agregar -->
</form>


            </div>
        </section>

<!-- Inicio tabla -->
<div class="container mx-auto mt-8 flex justify-center">
  <div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Cursos</h2>
    <table class="min-w-full border-collapse border border-gray-300 rounded-lg overflow-hidden">
      <thead>
        <tr class="bg-gray-100">
          <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Nombre del Curso</th>
          <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Profesor</th>
          <th class="px-4 py-2 text-center text-gray-600 font-medium border-b">Acciones</th>
        </tr>
      </thead>
      <tbody>
      @foreach($cursos_inscritos as $curso_ins)
        <tr class="hover:bg-gray-50">
          <td class="px-4 py-2 border-b">{{$curso_ins->nombre_curso}}</td>
          <td class="px-4 py-2 border-b">{{$curso_ins->nombre_prof}} {{$curso_ins->apellido_p}} {{$curso_ins->apellido_m}}</td>
          <form action="{{route('eliminar_inscripcion', $curso_ins->id)}}" method="POST">
          <td class="px-4 py-2 border-b text-center">
            <button class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition-all">Ver</button>
                 @csrf
                @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition-all ml-2">Eliminar</button>
            </form>
          </td>
        </tr>
        @endforeach

        </tbody>
    </table>
  </div>
</div>

<!-- Fin tabla -->

             
            </div>
        </section>
</main>
@endsection