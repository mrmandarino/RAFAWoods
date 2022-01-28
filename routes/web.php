<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EjecutivoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/ventas', function () {
    return view('ventas.portal_ventas');
});


Route::get('/productos', [EjecutivoController::class,'index'])->name('ver_inventario');
Route::post('/familias',[EjecutivoController::class, 'familias'])->name('test2');
Route::get('/detalle',[EjecutivoController::class, 'detalle_producto'])->name('ver_detalle');


Route::middleware(['auth'])->group(function(){
    Route::get('/admin/crear_usuario',[AdminController::class, 'create'])->name('admin_crear_usuario');
    Route::post('/admin/store',[AdminController::class, 'store_usuario'])->name('admin_store_usuario');

});

require __DIR__.'/auth.php';
