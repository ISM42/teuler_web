@extends('layouts.template_teuler')
@section('titulo','Curso: Álgebra')
@section('contenido')

<main class="flex-grow mb-10 pb-10 pt-10">
    <section class="bg-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">Álgebra</h1>
            <p class="text-lg text-gray-600 mb-8">
                
            <ul>

            <li class="pb-8">
            <a href="/expresiones" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Expresiones algebraicas</a>
            </li>

            <li class="pb-8">
            <a href="#" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Productos notables</a>
            </li>


            <li class="pb-8">
            <a href="#" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Factorización</a>
            </li>

            <li class="pb-8">
            <a href="/despejes" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Despejes y ecuaciones lineales </a>
            </li>

            <li class="pb-8">
            <a href="#" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Desigualdades</a>
            </li>

            <li class="pb-8">
            <a href="#" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Ecuaciones cuadráticas y sistemas de ecuaciones</a>
            </li>

           

</ul>
        </div>
    </section>
</main>

@endsection
