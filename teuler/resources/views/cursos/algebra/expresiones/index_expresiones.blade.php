@extends('layouts.template_teuler')
@section('titulo','Expresiones Algebraicas')
@section('contenido')

<link rel="stylesheet" href="{{ asset('css/index_expresiones.css') }}">
<main class="flex-grow mb-10 pb-10 pt-10">
    <section class="intro bg-white py-20 pb-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">¡Bienvenido a Expresiones Algebraicas!</h1>
            <p class="text-lg text-gray-600 mb-8">
                En este módulo, aprenderás a dominar los conceptos básicos del lenguaje matemático, que te permitirán resolver problemas de manera más rápida y eficiente. Desde entender cómo simplificar ecuaciones hasta manipular términos algebraicos, este curso te guiará paso a paso.
            </p>
        </div>
    </section>

    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-gray-800 text-center mb-10">Temario</h1> 

        <div class="space-y-8">
            <!-- Sección 1 -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-semibold text-blue-700 mb-4">1. Introducción a las Expresiones Algebraicas</h2>
                <p class="text-gray-600">Explorarás los elementos básicos de una expresión algebraica, incluyendo variables, constantes y términos. Comprenderás cómo identificar y organizar las partes fundamentales de una expresión.</p>
                <br>
                <a href="#" class="leccion-boton bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Empezar lección</a>
            </div>

            <!-- Sección 2 -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-semibold text-blue-700 mb-4">2. Simplificación de Expresiones Algebraicas</h2>
                <p class="text-gray-600">Aprenderás a combinar términos semejantes y a aplicar propiedades básicas como la conmutativa y asociativa para simplificar expresiones algebraicas de manera eficiente.</p>
                <br>
                <a href="/simplificacion_expresiones" class="leccion-boton bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Empezar lección</a>
            </div>

            <!-- Sección 3 -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-semibold text-blue-700 mb-4">3. Propiedad Distributiva</h2>
                <p class="text-gray-600">Descubrirás cómo expandir y simplificar expresiones usando la propiedad distributiva. Practicarás cómo manejar paréntesis en expresiones algebraicas de diferentes niveles de complejidad.</p>
                <br>
                <a href="#" class="leccion-boton bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Empezar lección</a>
            </div>

            <!-- Sección 4 -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-semibold text-blue-700 mb-4">4. Factores y Factorización</h2>
                <p class="text-gray-600">Dominarás técnicas de factorización, como el factor común y el agrupamiento. Esto te permitirá transformar expresiones complejas en formas más manejables.</p>
                <br>
                <a href="#" class="leccion-boton bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Empezar lección</a>
            </div>

            <!-- Sección 5 -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-semibold text-blue-700 mb-4">5. Operaciones con Polinomios</h2>
                <p class="text-gray-600">Aprenderás a sumar, restar, multiplicar y dividir polinomios, desarrollando habilidades para trabajar con expresiones algebraicas más complejas.</p>
                <br>
                <a href="#" class="leccion-boton bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Empezar lección</a>
            </div>

            <!-- Sección 6 -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-semibold text-blue-700 mb-4">6. Expresiones Racionales</h2>
                <p class="text-gray-600">Explorarás cómo trabajar con expresiones que involucran fracciones algebraicas, aprendiendo a simplificarlas y realizar operaciones con ellas.</p>
                <br>
                <a href="#" class="leccion-boton bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Empezar lección</a>
            </div>

            <!-- Sección 7 -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-semibold text-blue-700 mb-4">7. Aplicaciones de Expresiones Algebraicas</h2>
                <p class="text-gray-600">Aplicarás los conceptos aprendidos para resolver problemas reales, modelando situaciones prácticas mediante el uso de expresiones algebraicas.</p>
                <br>
                <a href="#" class="leccion-boton bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Empezar lección</a>
            </div>
        </div>
    </div>
</main>

@endsection
