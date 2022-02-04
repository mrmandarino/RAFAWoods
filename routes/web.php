<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


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

Route::middleware(['auth'])->group(function(){
    Route::get('/admin/visualizar/{tabla}',[AdminController::class, 'index'])->name('admin_visualizar_especifico');
    Route::get('/admin/visualizar/{tabla}/crear_fila',[AdminController::class, 'crear'])->name('admin_crear_fila');
    Route::post('/admin/visualizar/{tabla}',[AdminController::class, 'guardar'])->name('admin_guardar_datos');
    Route::get('/admin/visualizar/{tabla}/editar_fila/{key}/{key2?}',[AdminController::class, 'edit'])->name('admin_editar_fila');
    Route::put('/admin/visualizar/{tabla}/editar_fila/{key}/{key2?}',[AdminController::class, 'update'])->name('admin_update_fila');
    Route::get('/admin/visualizar/{tabla}/borrar_fila/{key}/{key2?}',[AdminController::class, 'borrar'])->name('admin_borrar_datos');
    


    Route::get('/admin/crear_usuario',[AdminController::class, 'create'])->name('admin_crear_usuario');
    Route::get('/admin/visualizar_datos',[AdminController::class, 'select'])->name('admin_visualizar_datos');
    Route::get('/admin/visualizar/{tabla}',[AdminController::class, 'show'])->name('admin_visualizar_especifico');
    Route::post('/admin/store',[AdminController::class, 'store_usuario'])->name('admin_store_usuario');

    
 

});

require __DIR__.'/auth.php';
