@extends('layouts.template_teuler')
@section('titulo','Perfil de Usuario')
@section('contenido')

<h1 class="text-gray-900 font-bold font-sans text-3xl mt-5 mb-5 flex justify-center">{{$usuario->nombre}} {{$usuario -> apellido_p}}  {{$usuario -> apellido_m}}</h1>



<!-- Disparador del modal para cambiar contraseña -->
<div class="container mb-5 pb-10 flex justify-end pr-5">
<button data-modal-target="cambio_password" data-modal-toggle="cambio_password" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Cambiar contraseña
</button>
</div>
<!-- Fin disparador para cambiar contraseña -->


<!-- Disparador del modal para eliminar cuenta de usuario -->
<div class="container mb-5 pb-10 flex justify-end pr-5">
<button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
Eliminar mi cuenta
</button>
</div>
<!-- Fin del disparador para eliminar cuenta de usuario -->

<!-- Inicio mostrar avatar -->
<div class="container flex justify-center items-center min-h-screen mb-10 mt-10 pb-36">
<!-- Mostrar el avatar del usuario, si existe; de lo contrario, usar el avatar predeterminado -->
   <img src="{{ $usuario->avatar ? asset('storage/' . $usuario->avatar) : asset('images/Avatar_predeterminado.png') }}" alt="" width="250" height="250" >       
</div>
<!-- Fin avatar -->



<!-- INICIO BOTONES PARA AVATAR -->

<div class="flex justify-center space-x-4 mb-6">
    <!-- Botón para subir un nuevo avatar -->
    <form action="{{ route('usuarios.upload-avatar') }}" method="POST" enctype="multipart/form-data" class="inline">
        @csrf
        <label for="avatar-upload" class="block text-sm font-medium text-gray-700">Seleccionar nuevo avatar:</label>
        <input type="file" name="avatar" id="avatar-upload" class="hidden" onchange="this.form.submit()">
        <button type="button" onclick="document.getElementById('avatar-upload').click()" class="px-4 py-2 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-600 focus:outline-none">
            Examinar
        </button>
    </form>

    <!-- Botón para eliminar el avatar actual -->
    <form action="{{ route('usuarios.delete-avatar') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="px-4 py-2 bg-red-500 text-white font-bold rounded-lg hover:bg-red-600 focus:outline-none">
            Eliminar Avatar
        </button>
    </form>
</div>
<!-- FIN BOTONES AVATAR -->

<!-- FORMULARIO PARA ACTUALIZAR DATOS DEL USUARIO -->
<div class="container mb-10 pb-10">
    <form class="space-y-4" action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div>
            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="text" name="nombre" value="{{ $usuario->nombre }}" id="nombre" required 
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
        </div>

        <div>
            <label for="apellido_p" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido Paterno</label>
            <input type="text" name="apellido_p" value="{{ $usuario->apellido_p }}" id="apellido_p" required 
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
        </div>

        <div>
            <label for="apellido_m" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido Materno</label>
            <input type="text" name="apellido_m" value="{{ $usuario->apellido_m }}" id="apellido_m" required 
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
        </div>

        <div>
            <label for="id_area" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Área de Adscripción</label>
            <select name="id_area" id="id_area" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" disabled>Seleccione un área de adscripción</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ $usuario->id_area == $area->id ? 'selected' : '' }}>{{ $area->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- <div>
            <label for="id_rol" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rol</label>
            <select name="id_rol" id="id_rol" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" disabled>Seleccione un rol</option>
                @foreach($roles as $rol)
                    <option value="{{ $rol->id }}" {{ $usuario->id_rol == $rol->id ? 'selected' : '' }}>{{ $rol->nombre }}</option>
                @endforeach
            </select>
        </div> -->

        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" name="email" value="{{ $usuario->email }}" id="email" required 
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-600 focus:outline-none">Actualizar Perfil</button>
        </div>
    </form>
</div>
<!-- FIN DE FORMULARIO PARA ACTUALIZAR DATOS DEL USUARIO -->


<!-- MODAL PARA CAMBIO DE CONTRASEÑA -->


<!-- Main modal -->
<div id="cambio_password" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Cambiar contraseña
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="cambio_password">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
    <form class="space-y-4" action="{{ route('usuario.updatePassword') }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="password_actual" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña actual</label>
            <div class="relative">
            <input type="password" name="password_actual" id="password_actual" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            @if ($errors->has('password_actual'))
                <div class="text-red-500 text-sm">{{ $errors->first('password_actual') }}</div>
            @endif
            <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePassword('password_actual')">
        <ion-icon name="eye-off-outline"></ion-icon>
        </span>
        </div>
</div>

        <div>
            <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nueva contraseña</label>
        <div class="relative">
            <input type="password" name="new_password" id="new_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePassword('new_password')">
        <ion-icon name="eye-off-outline"></ion-icon>
        </span>
        </div>
</div>

        <div>
            <label for="new_password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar nueva contraseña</label>
            <div class="relative">
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            @if ($errors->has('new_password'))
                <div class="text-red-500 text-sm">{{ $errors->first('new_password') }}</div>
            @endif
            <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePassword('new_password_confirmation')">
        <ion-icon name="eye-off-outline"></ion-icon>
        </span>
</div>
        </div>

        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aceptar</button>
        <button type="button" data-modal-hide="cambio_password" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cancelar</button>
    </form>
</div>

        </div>
    </div>
</div> 

<!-- FIN DEL MODAL PARA CAMBIO DE CONTRASEÑA -->


<!-- Modal para eliminar cuenta de usuario (borrado lógico) -->

<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Cerrar modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Estás seguro que deseas eliminar tu cuenta? Esta acción no se podrá deshacer</h3>

                <form action="{{ route('usuario.eliminar.cuenta') }}" method="POST">
                    @csrf
                    <button type="submit" data-modal-hide="popup-modal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Sí, continuar
                    </button>
                    <button type="button" data-modal-hide="popup-modal" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        No, cancelar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Fin modal eliminar cuenta de usuario -->



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
