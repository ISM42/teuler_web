@extends('layouts.template_teuler')
@section('titulo','Preguntas Despejes')
@section('contenido')

<h1>Preguntas Aleatorias</h1>

@foreach ($preguntas as $pregunta)
    <div class="pregunta">
        <!-- Mostrar la pregunta -->
        <p><strong>{!! $pregunta->Pregunta !!}</strong></p>

        <!-- Formulario para enviar la respuesta -->
        <form action="{{ route('guardar_respuesta') }}" method="POST">
            @csrf
            <input type="hidden" name="pregunta_id" value="{{ $pregunta->_id }}">

            <!-- Tipo de pregunta: opción múltiple -->
            @if (isset($pregunta->opciones) && is_array($pregunta->opciones))
                <div class="opciones-multiples">
                    @foreach ($pregunta->opciones as $key => $opcion)
                        <button type="submit" name="respuesta" value="{{ $key }}" class="opcion-boton">
                            {{ strtoupper($key) }}. {!! $opcion !!}
                        </button>
                    @endforeach
                </div>

            <!-- Tipo de pregunta: verdadero/falso -->
            @elseif (isset($pregunta->correcta) && ($pregunta->correcta === 'verdadero' || $pregunta->correcta === 'falso'))
                <div class="verdadero-falso">
                    <button type="submit" name="respuesta" value="verdadero" class="opcion-boton">
                        Verdadero
                    </button>
                    <button type="submit" name="respuesta" value="falso" class="opcion-boton">
                        Falso
                    </button>
                </div>

            <!-- Tipo de pregunta: entrada por teclado -->
            @else
                <div class="entrada-respuesta">
                    <input type="text" name="respuesta" placeholder="Escribe tu respuesta" class="campo-entrada">
                    <button type="submit" class="boton-enviar">Enviar</button>
                </div>
            @endif
        </form>
    </div>
@endforeach

<script>
    document.addEventListener("DOMContentLoaded", function() {
        MathJax.typeset();  // Renderiza las ecuaciones de matemáticas
    });
</script>

@endsection

<style>
    /* Asegurarse de que los botones se muestren correctamente */
    .opciones-multiples, .verdadero-falso {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* Dos columnas para cuadrícula */
        gap: 10px;
        margin-top: 10px;
    }

    /* Botones de opción múltiple y verdadero/falso */
    .opcion-boton {
        display: block;
        width: 100%;
        padding: 15px;
        font-size: 16px;
        text-align: center;
        background-color: #4CAF50; /* Color de fondo de los botones */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        visibility: visible;
        opacity: 1;
    }

    .opcion-boton:hover {
        background-color: #45a049;
    }

    /* Botón de envío */
    .boton-enviar {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        text-align: center;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        visibility: visible;
        opacity: 1;
    }

    .boton-enviar:hover {
        background-color: #45a049;
    }

    /* Estilo para el campo de entrada */
    .campo-entrada {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
    }
</style>
