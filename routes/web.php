<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CatalogoController;
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

/*Route::get('/ventas', function () {
    return view('ventas.realizar_ventas');
});*/

Route::get('/ayudameme', function () {
    return view('ventas.ayuda');
});


//Inventario
Route::get('/productos', [EjecutivoController::class,'index'])->name('ver_inventario');
Route::post('/productos/created',[EjecutivoController::class, 'agregar_producto'])->name('agregar_producto');
Route::post('/familias',[EjecutivoController::class, 'familias'])->name('test2');
Route::get('/detalle',[EjecutivoController::class, 'detalle_producto'])->name('ver_detalle');
Route::put('/detalle/{id}/stock/updated',[EjecutivoController::class, 'detalle_producto_stock_actualizado'])->name('ver_detalle_stock_actualizado');
Route::put('/detalle/{id}/producto/updated',[EjecutivoController::class, 'actualizar_producto'])->name('ver_detalle_producto_actualizado');
Route::put('/detalle/{id}/producto/precio/updated',[EjecutivoController::class, 'actualizar_precio_producto'])->name('ver_detalle_precio_producto_actualizado');
Route::post('/detalle/{id}/producto/deleted',[EjecutivoController::class, 'borrar_producto'])->name('eliminar_producto');
Route::get('/productos/precios',[EjecutivoController::class,'index_precios'])->name('ver_detalle_precios');
Route::resource('ventas',VentaController::class);

//Catálogo
Route::get('/catalogo',[CatalogoController::class,'index'])->name('ver_catalogo');
Route::get('/catalogo/intermedio',[CatalogoController::class,'intermedio'])->name('ver_catalogo_intermedio');
Route::get('catalogo/intermedio/producto',[CatalogoController::class,'intermedio_producto'])->name('ver_producto_intermedio');
Route::get('/catalogo/intermedio/filtrar/{tipo_filtro}',[CatalogoController::class,'intermedio_filtro'])->name('ver_filtro_intermedio');
Route::get('/catalogo/{familia}',[CatalogoController::class,'index_por_familia'])->name('ver_catalogo_por_familia');
Route::get('/catalogo/detalle_producto/{nombre_producto}',[CatalogoController::class,'detalle_producto'])->name('ver_detalle_producto');
Route::get('/catalogo/filtrar/{tipo_filtro}/{familia}',[CatalogoController::class,'index_filtro'])->name('ver_catalogo_filtrado');

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
