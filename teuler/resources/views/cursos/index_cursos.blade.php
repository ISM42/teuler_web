@extends('layouts.template_teuler')
@section('titulo','Cursos')
@section('contenido')

<main class="flex-grow mb-10 pb-10 pt-10">
<section class="bg-white py-20">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-6">Cursos</h1>
                <p class="text-lg text-gray-600 mb-8">
                   
                </p>
                <ul>

<li class="pb-8">
<a href="/algebra" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Álgebra</a>
</li>

<li class="pb-8">
<a href="#" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Geometría Euclidiana</a>
</li>

<li class="pb-8">
<a href="#" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Trigonometría</a>
</li>

 <li class="pb-8">
<a href="#" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Geometría Analítica</a>
</li>

 <li class="pb-8">
<a href="#" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Cálculo Diferencial</a>
</li>

<li class="pb-8">
<a href="#" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Cálculo integral</a>
</li>

</ul>
            </div>
        </section>
</main>
@endsection