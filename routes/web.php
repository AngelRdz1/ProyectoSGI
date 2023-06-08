<?php

use App\Http\Controllers\ComportamientoController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\DocenteController;
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

//Route::get('/', function () {
//    return view('welcome'); uploadCSV
//});
Route::get('/home', function () {
    return view('home');
});

Route::get('grados/index', [GradoController::class, 'index'])->name('grado.index');
Route::get('grados/index/data', [GradoController::class, 'data'])->name('grados.index.data');
Route::post('grados/edit', [GradoController::class, 'edit'])->name('grado.edit');
Route::post('grados/store', [GradoController::class, 'store'])->name('grado.store');
Route::post('grados/update', [GradoController::class, 'update'])->name('grado.update');

Route::get('docente/index', [DocenteController::class, 'index'])->name('docente.index');
Route::get('docente/index/data', [DocenteController::class, 'data'])->name('docente.index.data');
Route::post('docente/upload-csv', [DocenteController::class, 'uploadCSV'])->name('docente.upload.csv');

Route::get('comportamientos/index', [ComportamientoController::class, 'index'])->name('comportamientos.index');
Route::get('comportamientos/index/data', [ComportamientoController::class, 'data'])->name('comportamientos.data');
Route::post('comportamientos/upload-csv', [ComportamientoController::class, 'uploadCSV'])->name('comportamiento.upload.csv');
