@extends('layouts.template_teuler')
@section('titulo','Home')
@section('contenido')

<main class="flex-grow mb-10 pb-10 pt-10">
        <section class="bg-white py-20">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-6">¡Bienvenido a Teuler!</h1>
                <p class="text-lg text-gray-600 mb-8">
                    La plataforma interactiva para aprender matemáticas de forma fácil, rápida y divertida.
                </p>
                <a href="/registro" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Comenzar ahora</a>
            </div>
        </section>

        <!-- Feature section -->
        <section class="bg-gray-50 py-12">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-semibold text-gray-800 text-center mb-10">Descubre nuestras funciones</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white p-6 rounded-lg shadow text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-16 w-16 text-blue-600 mx-auto mb-4">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3-9m4 0l3 9h4m-4 5H7l-4 4m20-4h-4l-4 4" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Ejercicios Interactivos</h3>
                        <p class="text-gray-600">
                            Resuelve cientos de problemas y recibe retroalimentación inmediata en cada ejercicio.
                        </p>
                    </div>
                    <!-- Feature 2 -->
                    <div class="bg-white p-6 rounded-lg shadow text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-16 w-16 text-blue-600 mx-auto mb-4">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-6.219-8.468" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Revisa tu progreso</h3>
                        <p class="text-gray-600">
                            Monitorea tu avance y mejora cada día con estadísticas detalladas.
                        </p>
                    </div>
                    <!-- Feature 3 -->
                    <div class="bg-white p-6 rounded-lg shadow text-center pb-10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-16 w-16 text-blue-600 mx-auto mb-4">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Soluciones Paso a Paso</h3>
                        <p class="text-gray-600">
                            Obtén explicaciones detalladas para aprender de tus errores y mejorar tu comprensión.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
@endsection