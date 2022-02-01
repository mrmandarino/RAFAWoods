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
Route::put('/detalle/{id}/stock/updated',[EjecutivoController::class, 'detalle_producto_stock_actualizado'])->name('ver_detalle_stock_actualizado');
Route::put('/detalle/{id}/producto/updated',[EjecutivoController::class, 'actualizar_producto'])->name('ver_detalle_producto_actualizado');
Route::put('/detalle/{id}/producto/precio/updated',[EjecutivoController::class, 'actualizar_precio_producto'])->name('ver_detalle_precio_producto_actualizado');
Route::post('/detalle/{id}/producto/deleted',[EjecutivoController::class, 'borrar_producto'])->name('eliminar_producto');
Route::get('/productos/precios',[EjecutivoController::class,'index_precios'])->name('ver_detalle_precios');


//Route::get('/detalle/{id}/stock',[EjecutivoController::class, 'detalle_producto_stock'])->name('ver_detalle_stock');


Route::middleware(['auth'])->group(function(){
    Route::get('/admin/crear_usuario',[AdminController::class, 'create'])->name('admin_crear_usuario');
    Route::post('/admin/store',[AdminController::class, 'store_usuario'])->name('admin_store_usuario');

});

require __DIR__.'/auth.php';
