@extends('layouts.template_teuler')
@section('titulo', 'Preguntas Despejes')

@section('contenido')

<div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Preguntas Aleatorias</h1>
    
    <!-- Barra de progreso -->
    <div class="w-full bg-gray-200 rounded-full h-4 mb-4">
        <div id="progress-bar" class="bg-blue-600 h-4 rounded-full" style="width: 0%"></div>
    </div>

    <!-- Contenedor de preguntas -->
    <div id="preguntas-container">
        @foreach ($preguntas as $index => $pregunta)
            <div class="pregunta mb-6 p-4 bg-white rounded-md shadow-md max-w-xl mx-auto"
                 id="pregunta-{{ $index }}" style="display: {{ $index === 0 ? 'block' : 'none' }};">
                <p class="font-semibold text-lg text-gray-800 mb-4 whitespace-pre-line">
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
                                <button type="button" onclick="submitRespuesta('{{ $pregunta->_id }}', '{{ $key }}', {{ $index }})" 
                                        class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 w-full max-w-xs">
                                    {{ strtoupper($key) }}. {!! $opcion !!}
                                </button>
                            @endforeach
                        </div>

                    <!-- Tipo de pregunta: verdadero/falso -->
                    @elseif (isset($pregunta->correcta) && ($pregunta->correcta === 'verdadero' || $pregunta->correcta === 'falso'))
                        <div class="verdadero-falso flex justify-center mt-4 gap-3">
                            <button type="button" onclick="submitRespuesta('{{ $pregunta->_id }}', 'verdadero', {{ $index }})" 
                                    class="w-32 py-2 px-4 bg-green-500 text-white font-semibold rounded-lg shadow hover:bg-green-600 transition">
                                Verdadero
                            </button>
                            <button type="button" onclick="submitRespuesta('{{ $pregunta->_id }}', 'falso', {{ $index }})" 
                                    class="w-32 py-2 px-4 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition">
                                Falso
                            </button>
                        </div>

                    <!-- Tipo de pregunta: entrada por teclado -->
                    @else
                        <div class="entrada-respuesta mt-4">
                            <input type="text" id="input-respuesta-{{ $pregunta->_id }}" placeholder="Escribe tu respuesta" 
                                   class="campo-entrada w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
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
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            pregunta_id: preguntaId,
            modulo_id: {{ $modulo_id }},
            respuesta: respuesta,
        }),
    })
        .then(response => response.json())
        .then(data => {
            console.log("Respuesta del servidor:", data);

            if (data.success) {
                // Retroalimentación visual
                const currentPregunta = document.getElementById(`pregunta-${index}`);
                if (data.es_correcto) {
                    currentPregunta.style.border = "2px solid green";
                } else {
                    currentPregunta.style.border = "2px solid red";
                }

                // Actualizar barra de progreso
                progreso += 1;
                const progressBar = document.getElementById("progress-bar");
                if (progressBar) {
                    const porcentaje = (progreso / totalPreguntas) * 100;
                    progressBar.style.width = `${porcentaje}%`;
                    progressBar.textContent = `${Math.round(porcentaje)}%`; // Opcional: mostrar porcentaje en la barra
                } else {
                    console.error("Elemento 'progress-bar' no encontrado.");
                }

                // Comprobar si se debe redirigir al usuario
                if (data.redirect) {
                    alert('¡Bloque completado! Redirigiendo a la página de finalización.');
                    window.location.href = data.redirect;
                } else if (progreso < totalPreguntas) {
                    // Avanzar a la siguiente pregunta
                    mostrarSiguientePregunta(index + 1);
                }
            } else {
                alert(data.message || "Hubo un error al guardar la respuesta.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Error en la conexión. Inténtalo de nuevo.");
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
