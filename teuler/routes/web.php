<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
//RUTAS TEMPORALES
Route::get('/', function () {
    return view('index_teuler');
});

Route::get('/home', function () {
    return view('home_teuler');
});

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
    return view('cursos.algebra.despejes.ejercicios_despejes_incognitas');
});


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
