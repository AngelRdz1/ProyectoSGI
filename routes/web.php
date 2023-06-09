<?php

use App\Http\Controllers\ComportamientoController;
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


Route::get('/', function () {
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

//Rutas para cada reporte
Route::group(['middleware' => []], function () {
    Route::get('reportes/reporteboletanotas/index', [ReportesController::class, 'indexBoletaNotas'])->name('reportes.reporteboletanotas.index');
    Route::get('reportes/reporteconsolidado/index', [ReportesController::class, 'indexConsolidado'])->name('reportes.reporteconsolidado.index');
    Route::get('reportes/reportepromedios/index', [ReportesController::class, 'indexPromedios'])->name('reportes.reportepromedios.index');
    Route::get('reportes/reportepromediotrimestral/index', [ReportesController::class, 'indexPromedioTrimestral'])->name('reportes.reportepromediotrimestral.index');
    Route::get('reportes/reportepromediofinal/index', [ReportesController::class, 'indexPromedioFinal'])->name('reportes.reportepromediofinal.index');
});

//Rutas para la carga de datos
Route::group(['middleware' => ['LogBitacora']], function () {
    Route::post('docente/upload-csv', [DocenteController::class, 'uploadCSV'])->name('docente.upload.csv');
    Route::post('estudiante/upload-csv', [EstudianteController::class, 'uploadCSV'])->name('estudiante.upload.csv');
    Route::post('materia/upload-csv', [MateriaController::class, 'uploadCSV'])->name('materia.upload.csv');
});

//Rutas para la descarga de reportes
Route::group(['middleware' => ['LogBitacora']], function () {
    Route::get('reportes/reporteboletanotas/reportePDF/', [ReportesController::class, 'reportePDF'])->name('reportes.reporteboletanotas.pdf');
    Route::get('reportes/reporteboletanotas/reporteExcel/', [ReportesController::class, 'reportePDF'])->name('reportes.reporteboletanotas.excel');
    Route::get('reportes/reporteconsolidado/reportePDF/', [ReportesController::class, 'reportePDF'])->name('reportes.reporteconsolidado.pdf');
    Route::get('reportes/reporteconsolidado/reporteExcel/', [ReportesController::class, 'reportePDF'])->name('reportes.reporteconsolidado.excel');
    Route::get('reportes/reportepromedios/reportePDF/', [ReportesController::class, 'reportePDF'])->name('reportes.reportepromedios.pdf');
    Route::get('reportes/reportepromedios/reporteExcel/', [ReportesController::class, 'reportePDF'])->name('reportes.reportepromedios.excel');
    Route::get('reportes/reportepromediotrimestral/reportePDF/', [ReportesController::class, 'reportePDF'])->name('reportes.reportepromediotrimestral.pdf');
    Route::get('reportes/reportepromediotrimestral/reporteExcel/', [ReportesController::class, 'reportePDF'])->name('reportes.reportepromediotrimestral.excel');
    Route::get('reportes/reportepromediofinal/reportePDF/', [ReportesController::class, 'reportePDF'])->name('reportes.reportepromediofinal.pdf');
    Route::get('reportes/reportepromediofinal/reporteExcel/', [ReportesController::class, 'reportePDF'])->name('reportes.reportepromediofinal.excel');
});

//Rutas para las tablas
Route::group(['middleware' => []], function () {
    Route::get('grados/index/data', [GradoController::class, 'data'])->name('grados.index.data');
    Route::get('docente/index/data', [DocenteController::class, 'data'])->name('docente.index.data');
    Route::get('estudiante/index/data', [EstudianteController::class, 'data'])->name('estudiante.index.data');
    Route::get('materia/index/data', [MateriaController::class, 'data'])->name('materia.index.data');
    Route::get('seguimiento/index/data', [SeguimientoController::class, 'data'])->name('seguimiento.index.data');
});


/*Route::view('login', 'login');
Route::view('dashboard','dashboard'); */

/*Route::get('grados/index', [GradoController::class, 'index'])->name('grado.index');
Route::get('grados/index/data', [GradoController::class, 'data'])->name('grados.index.data');
Route::post('grados/edit', [GradoController::class, 'edit'])->name('grado.edit');
Route::post('grados/store', [GradoController::class, 'store'])->name('grado.store');
Route::post('grados/update', [GradoController::class, 'update'])->name('grado.update');*/

/*Route::get('docente/index', [DocenteController::class, 'index'])->name('docente.index');
Route::get('docente/index/data', [DocenteController::class, 'data'])->name('docente.index.data');
Route::post('docente/upload-csv', [DocenteController::class, 'uploadCSV'])->name('docente.upload.csv');*/

/*Route::get('estudiante/index', [EstudianteController::class, 'index'])->name('estudiante.index');
Route::get('estudiante/index/data', [EstudianteController::class, 'data'])->name('estudiante.index.data');
Route::post('estudiante/upload-csv', [EstudianteController::class, 'uploadCSV'])->name('estudiante.upload.csv');*/

/*Route::get('materia/index', [MateriaController::class, 'index'])->name('materia.index');
Route::get('materia/index/data', [MateriaController::class, 'data'])->name('materia.index.data');
Route::post('materia/upload-csv', [MateriaController::class, 'uploadCSV'])->name('materia.upload.csv');

Route::get('seguimiento/index', [SeguimientoController::class, 'index'])->name('seguimiento.index');
Route::get('seguimiento/index/data', [SeguimientoController::class, 'data'])->name('seguimiento.index.data');*/

//Route::get('reportes/reportepromediofinal/index', [ReportesController::class, 'indexPromedioFinal'])->name('reportes.reportepromediofinal.index');
Route::get('reportes/reporteBoletaNotas/index', [ReportesController::class, 'indexBoletaNotas'])->name('reportes.reporteBoletaNotas.index');
Route::get('reportes/reporteBoletaNotas/data', [ReportesController::class, 'dataBoletaNotas'])->name('reportes.reporteBoletaNotas.data');
Route::get('reportes/reporteBoletaNotas/tabla', [ReportesController::class, 'tablaBoletaNotas'])->name('reportes.reporteBoletaNotas.tabla');

