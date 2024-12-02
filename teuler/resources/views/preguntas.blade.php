@extends('layouts.template_teuler')
@section('titulo', $titulo)

@section('contenido')


<link rel="stylesheet" href="{{ asset('css/preguntas.css') }}">
<div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Preguntas Aleatorias</h1>
    
    <!-- Barra de progreso -->
    <div class="w-full bg-gray-200 rounded-full h-4 mb-4">
        <div id="progress-bar" class="h-5 rounded-full flex items-center justify-center text-white" style=" width: 0%; background: linear-gradient(90deg, #D491FE, #A5B9FE);"></div>
    </div>

    <!-- Contenedor de preguntas -->
    <div id="preguntas-container">
        @foreach ($preguntas as $index => $pregunta)
            <div class="pregunta mb-6 p-4 bg-white rounded-md shadow-md max-w-xl mx-auto"
                 id="pregunta-{{ $index }}" style="display: {{ $index === 0 ? 'block' : 'none' }};">
                <p class="font-semibold text-lg text-gray-800 mb-4 whitespace-pre-line" style="text-align: center;">
                    {!! nl2br(e($pregunta->Pregunta)) !!}
                </p>

                <form id="respuesta-form-{{ $pregunta->_id }}" data-pregunta-id="{{ $pregunta->_id }}" data-modulo-id="{{ $modulo_id }}">
                    @csrf
                    <input type="hidden" name="pregunta_id" value="{{ $pregunta->_id }}">
                    <input type="hidden" name="modulo_id" value="{{ $modulo_id }}">

                    <!-- Tipo de pregunta: opción múltiple -->
                    @if (isset($pregunta->opciones) && is_object($pregunta->opciones))
                        <div class="opciones-multiples grid gap-4 grid-cols-2 justify-items-center">
                            @foreach ($pregunta->opciones as $key => $opcion)
                                <button type="button" onclick="submitRespuesta('{{ $pregunta->_id }}', '{{ $key }}', {{ $index }})" class="buttonO text-white py-2 px-4 rounded w-full max-w-xs">
                                    {{ strtoupper($key) }}. {!! $opcion !!}
                                </button>
                            @endforeach
                        </div>

                    <!-- Tipo de pregunta: verdadero/falso -->
                    @elseif (isset($pregunta->correcta) && ($pregunta->correcta === 'verdadero' || $pregunta->correcta === 'falso'))
                        <div class="verdadero-falso flex justify-center mt-4 gap-3">
                            <button type="button" onclick="submitRespuesta('{{ $pregunta->_id }}', 'verdadero', {{ $index }})" class="buttonV w-32 py-2 px-4 text-white font-semibold rounded-lg shadow transition">
                                Verdadero
                            </button>
                            <button type="button" onclick="submitRespuesta('{{ $pregunta->_id }}', 'falso', {{ $index }})" class="buttonF w-32 py-2 px-4 text-white font-semibold rounded-lg shadow transition">
                                Falso
                            </button>
                        </div>

                    <!-- Tipo de pregunta: entrada por teclado -->
                    @else
                        <div class="entrada-respuesta mt-4">
                            <input type="text" id="input-respuesta-{{ $pregunta->_id }}" placeholder="Escribe tu respuesta" class="campo-entrada w-full py-2 px-4 rounded-lg">
                            <button type="button" onclick="submitRespuesta('{{ $pregunta->_id }}', document.getElementById('input-respuesta-{{ $pregunta->_id }}').value, {{ $index }})"
                                    class="boton-enviar w-full py-2 px-4 mt-3 bg-blue-500 text-white font-semibold rounded-lg shadow hover:bg-blue-600 transition">
                                Enviar
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        @endforeach
    </div>
</div>

<script>
    let progreso = 0;
    const totalPreguntas = {{ count($preguntas) }};

    function submitRespuesta(preguntaId, respuesta, index) {
    console.log(`Enviando respuesta para la pregunta ${preguntaId}:`, respuesta);

    fetch("{{ route('guardar_respuesta') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            pregunta_id: preguntaId,
            modulo_id: {{ $modulo_id }},
            respuesta: respuesta
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log("Respuesta del servidor:", data);

        if (data.success) {
            const currentPregunta = document.getElementById(`pregunta-${index}`);
            if (data.es_correcto) {
                currentPregunta.style.border = "2px solid green";
            } else {
                currentPregunta.style.border = "2px solid red";
            }

            
            progreso += 1;
            const progressBar = document.getElementById("progress-bar");
            const progressBarContainer = document.querySelector('.w-full');
            progressBarContainer.style.height = "16px"; 
            progressBar.style.height = "100%";
            if (progressBar) {
                const porcentaje = (progreso / totalPreguntas) * 100;
                progressBar.style.width = `${porcentaje}%`;
                progressBar.textContent = `${Math.round(porcentaje)}%`;
            }

            if (progreso >= totalPreguntas) {
                if (data.redirect) {
                    window.location.href = data.redirect; // Redirigir a la URL especificada
                } else {
                    alert('¡Bloque completado!');
                }
            } else {
                mostrarSiguientePregunta(index + 1);
            }
        } else {
            alert(data.message || 'Hubo un error al guardar la respuesta.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la conexión. Inténtalo de nuevo.');
    });
}



function mostrarSiguientePregunta(index) {
    const currentPregunta = document.getElementById(`pregunta-${index - 1}`);
    const nextPregunta = document.getElementById(`pregunta-${index}`);

    if (currentPregunta) currentPregunta.style.display = 'none';
    if (nextPregunta) nextPregunta.style.display = 'block';
}

</script>
@endsection
