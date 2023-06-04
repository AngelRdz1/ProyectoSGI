<?php

use App\Http\Controllers\GradoController;
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
//    return view('welcome');
//});
Route::get('/home', function () {
    return view('home');
});

Route::get('grados/index', [GradoController::class, 'index'])->name('grado.index');
Route::get('grados/index/data', [GradoController::class, 'data'])->name('grados.index.data');
Route::post('grados/edit', [GradoController::class, 'edit'])->name('grado.edit');
Route::post('grados/store', [GradoController::class, 'store'])->name('grado.store');
Route::post('grados/update', [GradoController::class, 'update'])->name('grado.update');
