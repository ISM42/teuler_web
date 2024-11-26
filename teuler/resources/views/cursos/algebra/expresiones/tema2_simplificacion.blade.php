@extends('layouts.template_teuler')
@section('titulo','Simplificación de expresiones algebraicas')
@section('contenido')

<div class="container mx-auto mt-10 pb-10 px-4 flex justify-center">
    <h1 class="mt 10 flex items-center text-gray-900 font-sans font-bold text-2xl">Simplificación de expresiones algebraicas</h1>
</div>

<!-- DIV EXPLICACIÓN -->
<div class="container mx-auto mb-10 pb-10 pl-10 pr-10">
  <p class="text-lg leading-relaxed text-gray-800">
    <span class="font-semibold">La simplificación de expresiones algebraicas</span> es el proceso de reducir una expresión matemática a su forma más sencilla, combinando términos semejantes, eliminando paréntesis y realizando operaciones básicas. Esto permite resolver problemas de manera más rápida y eficiente, manteniendo la claridad en los cálculos.
  </p>

  <h2 class="mt-6 text-xl font-semibold text-gray-900 flex justify-center">Ejemplo básico:</h2>
  <p class="leading-relaxed text-gray-800 flex justify-center">
    Simplifiquemos la expresión:
    <pre class="bg-gray-100 p-3 rounded-md mt-2 flex justify-center">2x + 3x - 5</pre>
  </p>
  
  <p class="mt-4 leading-relaxed text-gray-800 flex justify-center">
    Para simplificar, sigue estos pasos:
  </p>

  <ol class="list-decimal list-inside mt-4 text-gray-800 space-y-2 flex justify-center">
    <li>
      <span class="font-semibold">Identifica términos semejantes:</span>
      <p class="mt-2">
        En este caso, los términos semejantes son <span class="font-semibold">2x</span> y <span class="font-semibold">3x</span>, ya que ambos contienen la misma variable <span class="font-semibold">x</span>.
      </p>
    </li>

    <li>
      <span class="font-semibold">Suma o resta los coeficientes:</span>
      <p class="mt-2">
        Sumamos los coeficientes de <span class="font-semibold">2x</span> y <span class="font-semibold">3x</span>:
      </p>
      <pre class="bg-gray-100 p-3 rounded-md mt-2 flex justify-center">(2 + 3)x = 5x</pre>
    </li>

    <li>
      <span class="font-semibold">Incluye los términos restantes:</span>
      <p class="mt-2">
        El resultado final es:
      </p>
      <pre class="bg-gray-100 p-3 rounded-md mt-2 flex justify-center">5x - 5</pre>
    </li>
  </ol>

  <h2 class="mt-6 text-xl font-semibold text-gray-900 flex justify-center">Ejemplo con paréntesis:</h2>
  <p class="leading-relaxed text-gray-800 flex justify-center">
    Simplifiquemos:
    <pre class="bg-gray-100 p-3 rounded-md mt-2 flex justify-center">3(2x + 4) - 5x</pre>
  </p>

  <ol class="list-decimal list-inside mt-4 text-gray-800 space-y-2 flex justify-center">
    <li>
      <span class="font-semibold">Aplica la propiedad distributiva:</span>
      <p class="mt-2">
        Multiplica <span class="font-semibold">3</span> por cada término dentro del paréntesis:
      </p>
      <pre class="bg-gray-100 p-3 rounded-md mt-2 flex justify-center">6x + 12 - 5x</pre>
    </li>

    <li>
      <span class="font-semibold">Combina términos semejantes:</span>
      <p class="mt-2">
        Simplifica <span class="font-semibold">6x - 5x</span>:
      </p>
      <pre class="bg-gray-100 p-3 rounded-md mt-2 flex justify-center">x + 12</pre>
    </li>
  </ol>

  <p class="mt-6 text-gray-800 flex justify-center">
    Simplificar expresiones te ayuda a trabajar de manera más ordenada y a resolver problemas matemáticos con mayor claridad.
  </p>
</div>
<!-- FIN DIV EXPLICACIÓN -->

<div class="container flex justify-end pr-5 pb-5">

<a href="/modulo/1/preguntas" class="bg-blue-700 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-900 transition duration-300">Empezar bloque de ejercicios</a>

</div>
@endsection
