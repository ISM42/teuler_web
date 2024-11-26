<nav class="bg-gray-800 border-gray-200 dark:bg-blue-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/logo_teuler.png') }}" alt="" width="45" height="45">
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Teuler</span>
        </a>
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            @if (Auth::check())
                <!-- Usuario autenticado -->
                <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" 
                         src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/avatar_predeterminado.png') }}" 
                         alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">
                            {{ Auth::user()->nombre }} {{ Auth::user()->apellido_p }} {{ Auth::user()->apellido_m }}
                        </span>
                        <span class="block text-sm text-gray-500 truncate dark:text-gray-400">
                            {{ Auth::user()->email }}
                        </span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        @if (Auth::user()->rol->nombre === 'Estudiante')
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Mi aprendizaje</a>
                            </li>
                        @elseif (Auth::user()->rol->nombre === 'Profesor')
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Mis cursos</a>
                            </li>
                        @endif
                        <li>
                            <a href="/perfil" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Ver perfil</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-start px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                    Cerrar sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <!-- Usuario no autenticado -->
                <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Iniciar sesión</a>
            @endif
        </div>

        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-800 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-gray-800 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
             <li class="ml-auto">
        <a href="/cursos" class="block py-2 px-3 text-white rounded hover:bg-gray-700 md:hover:bg-transparent md:hover:text-blue-500 md:p-0 dark:text-white">Cursos</a>
      </li>
    </ul>
  </div>
        
    </div>
</nav>
