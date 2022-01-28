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
    Route::get('/admin/crear_usuario',[AdminController::class, 'create'])->name('admin_crear_usuario');
    Route::get('/admin/visualizar_datos',[AdminController::class, 'show'])->name('admin_visualizar_datos');
    Route::get('/admin/visualizar/{tabla}',[AdminController::class, 'show2'])->name('admin_visualizar_especifico');
    Route::get('/admin/visualizar/{tabla}/orden-por-{sort_by}/{orientacion?}',[AdminController::class, 'ordenar'])->name('admin_visualizar_especifico_ordenado');
    Route::post('/admin/store',[AdminController::class, 'store_usuario'])->name('admin_store_usuario');

    /*
    Route::get('/admin/productos',[AdminController::class, 'index'])->name('admin_test');
    Route::post('/admin/familias',[AdminController::class, 'familias'])->name('test2');
    */
    
 

});

require __DIR__.'/auth.php';
