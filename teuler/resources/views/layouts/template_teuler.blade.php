<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- Script para ecuaciones -->
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<!-- fin script para ecuaciones -->

    @vite(['resources/js/app.js'])
    <title>@yield('titulo')</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Navbar -->
    <header class="">
        @include('partials.navbar')
    </header>

    <!-- Main content -->
    <main class="md:container md:mx-auto mb-20 overflow-x-auto flex-grow bg-slate-400">
        @yield('contenido')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 w-full shadow dark:bg-gray-900 mt-auto mb-auto">
        @include('partials.footer')
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
