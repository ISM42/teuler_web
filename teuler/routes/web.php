<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModuloTematicoController;
use App\Http\Controllers\cursoProfeController;
use App\Http\Controllers\InscripcionesController;
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

Route::get('/login',[LoginController::class, 'index'])->name('login'); //login

//LOGIN
Route::post('/login',[LoginController::class, 'login']);
//fin login

Route::get('/', function () {
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
})->name('preguntas_despejes');


Route::get('/despeje_incognitas_ejercicios', function () {
    return view('cursos.algebra.despejes.ejercicios_despejes_incognitas');
});

Route::get('/simplificacion_expresiones', function () {
    return view('cursos.algebra.expresiones.tema2_simplificacion');
})->name('preguntas_simplificacion');


//RUTAS PROFESOR
Route::get('/mis_cursos', [cursoProfeController::class, 'index'])->name('cursos');
Route::post('/guardar_curso_profesor', [cursoProfeController::class, 'store']);
Route::delete('/eliminar_curso_prof/{id}', [cursoProfeController::class, 'destroy'])->name('eliminar_cursoP');

Route::get('/progreso_alumnos', [cursoProfeController::class, 'progresoAlumnos'])->name('progreso_alumnos');
//FIN RUTAS PROFESOR

//RUTAS ESTUDIANTE
Route::get('/mi_aprendizaje', [InscripcionesController::class, 'index'])->name('ins_curso');
Route::post('/guardar_inscripcion', [InscripcionesController::class, 'store']);
Route::delete('/eliminar_inscripcion/{id}', [InscripcionesController::class, 'destroy'])->name('eliminar_inscripcion');

Route::get('/mi_progreso', [InscripcionesController::class, 'progresoEstudiante'])->name('progreso_estudiante');


//FIN RUTAS ESTUDIANTE


//rutas 2da version bloque de preguntas
Route::post('/guardar-respuesta', [ModuloTematicoController::class, 'guardarRespuesta'])->name('guardar_respuesta');
Route::get('/modulo/{id}/preguntas', [ModuloTematicoController::class, 'obtenerPreguntasAleatorias'])->name('preguntas');

//fin 2da version bloque de preguntas




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





//ruta para prueba directa de conexión con mongo
Route::get('/test-mongodb', function () {
    try {
        $pregunta = DB::connection('mongodb')
            ->getMongoDB()
            ->selectCollection('ejercicios_expresiones_algebraicas')
            ->findOne(['_id' => new \MongoDB\BSON\ObjectId('67368b3c7d78e82483c73bf9')]);
        return response()->json($pregunta);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});

//fin ruta test-mongo


require __DIR__.'/auth.php';
