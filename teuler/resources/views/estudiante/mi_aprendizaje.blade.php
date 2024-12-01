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
                <button data-modal-target="eliminar_ins" data-modal-toggle="eliminar_ins" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition-all ml-2" type="button">
Eliminar
</button>

<!-- modal eliminar -->
<div id="eliminar_ins" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="eliminar_ins">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Seguro que deseas continuar? Está acción no se podrá deshacer</h3>
                <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Sí, continuar
                </button>
                <button data-modal-hide="popup-modal" type="button" class="buttonC py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-white-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin modal eliminar -->
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