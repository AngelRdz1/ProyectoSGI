<?php

use App\Http\Controllers\GradoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\ReportePromedioFinalController;
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

Route::get('estudiante/index', [EstudianteController::class, 'index'])->name('estudiante.index');
Route::get('estudiante/index/data', [EstudianteController::class, 'data'])->name('estudiante.index.data');
Route::post('estudiante/upload-csv', [EstudianteController::class, 'uploadCSV'])->name('estudiante.upload.csv');

Route::get('materia/index', [MateriaController::class, 'index'])->name('materia.index');
Route::get('materia/index/data', [MateriaController::class, 'data'])->name('materia.index.data');
Route::post('materia/upload-csv', [MateriaController::class, 'uploadCSV'])->name('materia.upload.csv');

Route::get('seguimiento/index', [SeguimientoController::class, 'index'])->name('seguimiento.index');
Route::get('seguimiento/index/data', [SeguimientoController::class, 'data'])->name('seguimiento.index.data');

Route::get('reportes/reportepromediofinal/headersPromedioFinal', [ReportesController::class, 'headersPromedioFinal'])->name('reportes.reportepromediofinal.headersPromedioFinal');

Route::get('reportes/index', [ReportesController::class, 'index'])->name('reportes.index');
Route::get('reportes/reportepromediofinal/index', [ReportesController::class, 'indexPromedioFinal'])->name('reportes.reportepromediofinal.index');
