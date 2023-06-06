<?php

use App\Http\Controllers\GradoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\ReportesController;
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
//Rutas para los cruds
Route::group(['middleware' => ['LogBitacora']], function () {
    Route::resource('grados', GradoController::class);
    Route::resource('docente', DocenteController::class);
    Route::resource('estudiante', EstudianteController::class);
    Route::resource('materia', MateriaController::class);
    Route::resource('seguimiento', SeguimientoController::class);
    Route::resource('reportes', ReportesController::class);
});
//Rutas para las tablas
Route::group(['middleware' => []], function () {
    Route::get('grados/index/data', [GradoController::class, 'data'])->name('grados.index.data');
    Route::get('docente/index/data', [DocenteController::class, 'data'])->name('docente.index.data');
    Route::get('estudiante/index/data', [EstudianteController::class, 'data'])->name('estudiante.index.data');
    Route::get('materia/index/data', [MateriaController::class, 'data'])->name('materia.index.data');
    Route::get('seguimiento/index/data', [SeguimientoController::class, 'data'])->name('seguimiento.index.data');
});
//Rutas para la carga de datos
Route::group(['middleware' => []], function () {
    Route::post('docente/upload-csv', [DocenteController::class, 'uploadCSV'])->name('docente.upload.csv');
    Route::post('estudiante/upload-csv', [EstudianteController::class, 'uploadCSV'])->name('estudiante.upload.csv');
    Route::post('materia/upload-csv', [MateriaController::class, 'uploadCSV'])->name('materia.upload.csv');
});
//Rutas para las tablas de los reportes
Route::group(['middleware' => []], function () {
    Route::get('reportes/reportepromediofinal/index', [ReportesController::class, 'indexPromedioFinal'])->name('reportes.reportepromediofinal.index');
});

