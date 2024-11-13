<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModuloTematicoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[LoginController::class, 'index']); //login

//LOGIN
Route::post('/login',[LoginController::class, 'login']);
//fin login

Route::get('/home', function () {
    return view('home_teuler');
});

//Store para registro usuario
Route::post('/registro', [LoginController::class, 'create']);

//Ruta para logout
Route::post('/logout', [LoginController::class, 'logout']);

//RUTAS PARA EDITAR INFORMACIÓN DE USUARIO
/* Route::get('/usuarios/{id}', [LoginController::class, 'show'])->name('usuarios.perfil');
Route::put('/usuarios/{id}', [LoginController::class, 'update'])->name('usuarios.update'); */



//RUTAS CON AUTENTICACIÓN DE MIDDLEWARE
//ESTE MIDDLEWARE SIRVE PARA ENCRIPTAR LAS SESIONES ACTIVAS, ASÍ COMO ENCRIPTAR LAS COOKIES
Route::group(['middleware' => 'auth'], function () {
    //PERFIL PERSONAL
    //Muestra la información del perfil en sesion
    Route::get('/perfil', [LoginController::class, 'show']);

    Route::put('/perfil/{id}', [LoginController::class, 'update'])->name('usuarios.update');

    Route::match(['put', 'post'], '/perfil/cambiar-password', [LoginController::class, 'updatePassword'])->name('usuario.updatePassword');

    Route::post('/perfil/upload-avatar', [LoginController::class, 'uploadAvatar'])->name('usuarios.upload-avatar');

    Route::post('/perfil/delete-avatar', [LoginController::class, 'deleteAvatar'])->name('usuarios.delete-avatar');

    Route::post('/perfil/eliminar', [LoginController::class, 'destroy'])->name('usuario.eliminar.cuenta');

    //Cierra la sesion, invalida y renueva token 
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});



//RUTAS TEMPORALES

Route::get('/cursos', function () {
    return view('cursos.index_cursos');
});

Route::get('/algebra', function () {
    return view('cursos.algebra.index_algebra');
});

Route::get('/expresiones', function () {
    return view('cursos.algebra.expresiones.index_expresiones');
});

Route::get('/despejes', function () {
    return view('cursos.algebra.despejes.index_despejes');
});

Route::get('/despeje_incognitas', function () {
    return view('cursos.algebra.despejes.tema2_despeje_incognitas');
});

Route::get('/despeje_incognitas_ejercicios', function () {
    return view('cursos.algebra.despejes.ejercicios_despejes_incognitas');
});

/* Route::get('/perfil', function () {
    return view('perfil_usuario');
}); */
//Ruta para obtener 10 preguntas aleatorias desde mongo
Route::get('/modulo/{id}/preguntas', [ModuloTematicoController::class, 'obtenerPreguntasAleatorias']);

//ruta para guardar respuestas del usuario
Route::post('/guardar_respuesta', [ModuloTematicoController::class, 'guardarRespuesta'])->name('guardar_respuesta');


//FIN RUTAS TEMPORALES


// RUTAS BREEZE
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', ''])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// FIN RUTAS BREEZE
require __DIR__.'/auth.php';
