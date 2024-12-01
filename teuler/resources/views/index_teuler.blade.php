@extends('layouts.template_teuler')
@section('titulo','Inicio')
@section('contenido')


<link rel="stylesheet" href="{{ asset('css/index_teuler.css') }}">

<main>
    <div class="left-panel">
        <div class="card">
        <h1 class="text-4xl font-bold text-gray-800 mb-6">Inicio Sesión</h1>
            <div class="container mb-10 pb-10">
                <form class="max-w-sm mx-auto" action="/login" method= "POST">
                    @csrf
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" class="rounded-lg w-full p-2.5" required />
                        <p class="text-red-600 font-sans font-bold mt-1">{{ $errors->first('email') }}</p>  
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                        <input type="password" id="password" name="contraseña" class="rounded-lg w-full p-2.5" required />
                        <p class="text-red-600 font-sans font-bold mt-1">{{ $errors->first('password') }}</p>  
                    </div>
                    <div class="flex items-start mb-5">
                    <!--  <a href="/home" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">¿Eres nuevo? Regístrate</a> -->
                    <!-- Modal toggle -->
                    <button data-modal-target="registro_usuario" data-modal-toggle="registro_usuario" class="buttonRegistro ms-2 text-sm underline font-medium text-gray-900 dark:text-gray-300" type="button">
                    ¿Eres nuevo? Regístrate
                    </button>

                    <button type="submit" class="buttonI text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ingresar</button>
                    </div>                
                </form>
            <div>
        </div>
    </div>
</main>

<div class="right-panel">
    <div class="container flex flex-col justify-center items-center min-h-screen mb-10 mt-10 pb-36">
    <h1 class="text-gray-900 font-bold font-sans text-3xl mt-5 mb-5 flex justify-center"> TEULER </h1>
        <img src="{{ asset('images/logo_teuler.png') }}" alt="" width="350" height="350">
    
    </div>
</div>

<!-- Main modal REGISTRO-->
<div id="registro_usuario" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Crea una cuenta
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="registro_usuario">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="/registro" method="POST">
                    @csrf
                <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                        <input type="text" name="name" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido paterno</label>
                        <input type="text" name="ap" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido materno</label>
                        <input type="text" name="am" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>

                    <div>
    <label for="aa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Área de adscripción</label>
    <select name="aa" id="aa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        <option value="" disabled selected>Seleccione un área de adscripción</option>
        @foreach($areas as $area)
        <option value="{{$area -> id}}">{{$area->nombre}}</option>
       @endforeach
    </select>
</div>

                    <div>
    <label for="rol" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rol</label>
    <select name="rol" id="rol" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        <option value="" disabled selected>Seleccione un rol</option>
        @foreach($roles as $rol)
        <option value="{{$rol -> id}}">{{$rol->nombre}}</option>
       @endforeach
    </select>
</div>


                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                   
<div>
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
    <div class="relative">
        <input type="password" name="password" id="password1" class="password-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePassword('password1')">
        <ion-icon name="eye-off-outline"></ion-icon>
        </span>
    </div>
</div>

<div>
    <label for="password_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar contraseña</label>
    <div class="relative">
        <input type="password" name="password_2" id="password_2" class="password-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePassword('password_2')">
        <ion-icon name="eye-off-outline"></ion-icon>
        </span>
    </div>
</div>

@if ($errors->has('password'))
    <div class="text-red-500 text-sm">
        {{ $errors->first('password') }}
    </div>
@endif

                    <div class="flex justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" type="" value="" class=""/>
                            </div>
                            <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"></label>
                        </div>
                        <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500"></a>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Iniciar sesión</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        ¿No te has registrado? <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">Crea cuenta</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

<!-- SCRIPT PARA QUE EL ÍCONO DE OJITO SE MODIFIQUE AL HACER CLIC SOBRE ÉL Y QUE SE MUESTRE O NO LA CONTRASEÑA -->
<script>
  function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const icon = passwordInput.nextElementSibling.querySelector('ion-icon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.name = 'eye-outline'; // Cambia el ícono a 'ojo abierto'
    } else {
        passwordInput.type = 'password';
        icon.name = 'eye-off-outline'; // Cambia el ícono a 'ojo cerrado'
    }
}
</script>
<!-- FIN SCRIPT OJITO -->


@endsection