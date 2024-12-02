@extends('layouts.template_teuler')
@section('titulo','Despeje de incógnitas')
@section('contenido')

<link rel="stylesheet" href="{{ asset('css/tema2_despeje_incognitas.css') }}">

<div class="container mx-auto mt-10 pb-10 px-4 flex justify-center">
    <h1 class="mt 10 flex items-center text-gray-900 font-sans font-bold text-2xl">Despeje de incógnitas</h1>
</div>


<!-- DIV EXPLICACIÓN -->
<div class="container mx-auto mb-10 pb-10 pl-10 pr-10">
  <p class="text-lg leading-relaxed text-gray-800">
    El <span class="font-semibold">"despeje de incógnitas"</span> es un proceso matemático para encontrar el valor de una variable en una ecuación. En este proceso, movemos los números y otras variables para dejar la incógnita sola en uno de los lados de la ecuación.
  </p>

  <h2 class="ejemplo mt-6 text-xl font-semibold text-gray-900 flex justify-center">Ejemplo básico:</h2>
  <p class="leading-relaxed text-gray-800 flex justify-center">
    Supongamos que tenemos la ecuación:
    <pre class="ec1 bg-gray-100 p-3 rounded-md mt-2 flex justify-center">3x + 5 = 11</pre>
  </p>
  
  <p class="mt-4 leading-relaxed text-gray-800 flex justify-center">
    Para despejar la incógnita <span class="font-semibold ml-1">x</span>, sigamos estos pasos:
  </p>

  <ol class="list-decimal list-inside mt-4 text-gray-800 space-y-2 flex justify-center">
    <li class="pasos">
      <span class="font-semibold flex justify-center">Quitar el número que no tiene la incógnita:</span>
      <p class="mt-2">
        En este caso, es el número <span class="font-semibold">5</span>. Restamos <span class="font-semibold">5</span> de ambos lados para eliminarlo.
      </p>
      <pre class="ec bg-gray-100 p-3 rounded-md mt-2 flex justify-center">3x + 5 - 5 = 11 - 5</pre>
      <p class="mt-2">Simplificando, nos queda:</p>
      <pre class="ec bg-gray-100 p-3 rounded-md mt-2 flex justify-center">3x = 6</pre>
    </li>

    <li class="pasos">
      <span class="font-semibold ml-2">Dejar la incógnita sola:</span>
      <p class="mt-2">
        Ahora tenemos <span class="font-semibold">3x = 6</span>. Dividimos ambos lados entre <span class="font-semibold">3</span> para que <span class="font-semibold">x</span> quede solo.
      </p>
      <pre class="ec bg-gray-100 p-3 rounded-md mt-2 flex justify-center">x = 2</pre>
    </li>
  </ol>

  <h2 class="ejemplo mt-6 text-xl font-semibold text-gray-900 flex justify-center">Ejemplo con fracciones:</h2>
  <p class="leading-relaxed text-gray-800 flex justify-center">
    Digamos que tenemos:
    <pre class="ec1 bg-gray-100 p-3 rounded-md mt-2 flex justify-center">y / 4 + 2 = 5</pre>
  </p>

  <ol class="list-decimal list-inside mt-4 text-gray-800 space-y-2 flex justify-center">
    <li class="pasos">
      Restamos <span class="font-semibold">2</span> en ambos lados para que el <span class="font-semibold">y/4</span> quede solo:
      <pre class="ec bg-gray-100 p-3 rounded-md mt-2 flex justify-center">y / 4 = 3</pre>
    </li>

    <li class="pasos">
      Ahora multiplicamos ambos lados por <span class="font-semibold">4</span> para quitar la fracción:
      <pre class="ec bg-gray-100 p-3 rounded-md mt-2 flex justify-center">y = 12</pre>
    </li>
  </ol>

  <p class="mt-6 text-gray-800 flex justify-center">
    Con estos pasos básicos, podemos despejar incógnitas en muchas ecuaciones diferentes.
  </p>
</div>
<!-- FIN DIV EXPLICACIÓN -->

<div class="container flex justify-end pr-5 pb-5">

<a href="/modulo/4/preguntas" class="ejercicio-boton bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Empezar bloque de ejercicios</a>

</div>
@endsection