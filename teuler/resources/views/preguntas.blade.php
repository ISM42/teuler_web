@extends('layouts.template_teuler')
@section('titulo','Preguntas Despejes')
@section('contenido')

<div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Preguntas Aleatorias</h1>

    @foreach ($preguntas as $pregunta)
        <div class="pregunta mb-6 p-4 bg-white rounded-md shadow-md max-w-xl mx-auto">
            <!-- Mostrar la pregunta -->
            <p class="font-semibold text-lg text-gray-800 mb-4 whitespace-pre-line">
                {!! nl2br(e($pregunta->Pregunta)) !!}
            </p>

            <!-- Formulario para enviar la respuesta -->
            <form action="{{ route('guardar_respuesta') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="pregunta_id" value="{{ $pregunta->_id }}">

                <!-- Tipo de pregunta: opción múltiple -->
                @if (isset($pregunta->opciones) && is_object($pregunta->opciones))
                    <div class="opciones-multiples grid gap-4 grid-cols-2 justify-items-center">
                        @foreach ($pregunta->opciones as $key => $opcion)
                            <button type="submit" name="respuesta" value="{{ $key }}" 
                                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 w-full max-w-xs">
                                {{ strtoupper($key) }}. {!! $opcion !!}
                            </button>
                        @endforeach
                    </div>

                <!-- Tipo de pregunta: verdadero/falso -->
                @elseif (isset($pregunta->correcta) && ($pregunta->correcta === 'verdadero' || $pregunta->correcta === 'falso'))
                    <div class="verdadero-falso flex justify-center mt-4 gap-3">
                        <button type="submit" name="respuesta" value="verdadero" 
                                class="w-32 py-2 px-4 bg-green-500 text-white font-semibold rounded-lg shadow hover:bg-green-600 transition">
                            Verdadero
                        </button>
                        <button type="submit" name="respuesta" value="falso" 
                                class="w-32 py-2 px-4 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition">
                            Falso
                        </button>
                    </div>

                <!-- Tipo de pregunta: entrada por teclado -->
                @else
                    <div class="entrada-respuesta mt-4">
                        <input type="text" name="respuesta" placeholder="Escribe tu respuesta" 
                               class="campo-entrada w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
                        <button type="submit" 
                                class="boton-enviar w-full py-2 px-4 mt-3 bg-blue-500 text-white font-semibold rounded-lg shadow hover:bg-blue-600 transition">
                            Enviar
                        </button>
                    </div>
                @endif
            </form>
        </div>
    @endforeach
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        MathJax.typeset();  // Renderiza las ecuaciones de matemáticas
    });
</script>

@endsection
