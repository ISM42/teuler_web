@extends('layouts.template_teuler')
@section('titulo','Ejercicios de despejes')
@section('contenido')

<main class="flex-grow mb-10 pb-10 pt-10">
        <section class="bg-white py-20">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-6">Despejes con incógnitas</h1>
                <p class="text-lg text-gray-600 mb-8">
                    prueba
                </p>
                <a href="/registro" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Comenzar ahora</a>
            </div>
        </section>

<div class="container">
    <h1>Prueba ecuaciones</h1>
    <p>Esta es una ecuación en línea: \( E = mc^2 \).</p>

<p>Y esta es una ecuación en bloque:</p>
<p>$$ f(x) = ax^2 + bx + c $$</p>

</div>

    </main>
    
@endsection