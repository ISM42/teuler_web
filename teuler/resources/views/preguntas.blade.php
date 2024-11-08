@extends('layouts.template_teuler')
@section('titulo','Mis_Talleres')
@section('contenido')

<h1>Preguntas Aleatorias</h1>

@foreach ($preguntas as $pregunta)
    <div class="pregunta">
        <!-- Mostrar la pregunta -->
        <p><strong>{!!$pregunta->Pregunta!!}</strong></p>

        <!-- Mostrar las opciones de respuesta -->
        <ul class="opciones">
            <li>A. {!! $pregunta->opciones['a'] !!}</li>
            <li>B. {{ $pregunta->opciones['b'] }}</li>
            <li>C. {{ $pregunta->opciones['c'] }}</li>
            <li>D. {{ $pregunta->opciones['d'] }}</li>
        </ul>
    </div>
@endforeach

<script>
        // MathJax 3 usa un proceso diferente al de la versión 2 para la renderización automática.
        // Al usar MathJax 3, se usa MathJax.typeset() en lugar de MathJax.Hub.Queue(...)
        document.addEventListener("DOMContentLoaded", function() {
            MathJax.typeset();  // Renderiza las ecuaciones
        });
    </script>

@endsection