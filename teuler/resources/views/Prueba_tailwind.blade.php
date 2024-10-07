<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluye tanto app.css como app.js -->
    @vite(['resources/js/app.js'])
    <title>Document</title>
</head>
<body>
    <h1 class="text-green-900 font-sans font-black text-4xl pt-4 pb-4 flex justify-center">Mis Servicios</h1>

    <br><br>
    <div class="container mt-4 d-flex justify-content-end">
        <button type="button" class="bg-gradient-to-r from-green-500 to-green-800 hover:bg-green-600 text-white px-4 py-2 rounded-md" data-bs-toggle="modal" data-bs-target="#registrar_servicio">
            Registrar servicio
        </button>
    </div>
</body>
</html>
