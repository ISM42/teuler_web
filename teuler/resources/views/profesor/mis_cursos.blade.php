@extends('layouts.template_teuler')
@section('titulo','Mis cursos')
@section('contenido')

<main class="flex-grow mb-10 pb-10 pt-10">
<section class="bg-white py-20">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-6">Mis cursos</h1>
                <p class="text-lg text-gray-600 mb-8">
        
                <!-- div para dropdown select cursos disponibles para el profesor -->
    <div>
    <label for="rol" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Cursos disponibles</label>
    <select name="" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
        <option value="" disabled selected>Seleccione un curso</option>
        @foreach($cursos as $curso)
        <option value="{{$curso -> id}}">{{$curso->nombre}}</option>
       @endforeach
    </select>
</div>
<!-- fin select para cursos profesor -->

            </div>
        </section>
</main>
@endsection