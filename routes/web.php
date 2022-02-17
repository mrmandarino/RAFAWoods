<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\EjecutivoController;
use App\Http\Controllers\GraficoController;

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

Route::get('/cover', function () {
    return view('cover.cover_home');
});

Route::get('/ayudameme', function () {
    

    //return view('graficos.graficos');
    return view('graficos.charts');
});



//Graficos
Route::get('graficos', [GraficoController::class,'index'])->name('graficos');
Route::get('/graficos/redireccion', [GraficoController::class,'redireccion'])->name('redireccion');
Route::get('/graficos/grafico_anual/{ano}', [GraficoController::class,'grafico_anual'])->name('grafico_anual');
Route::get('/graficos/grafico_mes/{fecha_mes}', [GraficoController::class,'grafico_mes'])->name('grafico_mes');
Route::get('/graficos/grafico_semana/{fecha_semana}', [GraficoController::class,'grafico_semana'])->name('grafico_semana');

//las conexiones estan listas, falta validaciones varias
Route::get('/productos', [EjecutivoController::class,'index'])->name('ver_inventario');//vista control_inv - listo - mandarino
Route::get('/productos/precios',[EjecutivoController::class,'index_precios'])->name('ver_detalle_precios');//metodo de vista control_inv, ir a lista de precios - listo - mandarino
Route::post('/productos/created',[EjecutivoController::class, 'agregar_producto'])->name('agregar_producto');//metodo de vista control_inv, agregar nuevo producto - listo - mandarino

Route::get('/detalle',[EjecutivoController::class, 'detalle_producto'])->name('ver_detalle');//vista administrar_prod - listo - mandarino
Route::put('/detalle/{id}/stock/updated',[EjecutivoController::class, 'detalle_producto_stock_actualizado'])->name('ver_detalle_stock_actualizado');//metodo de vista administrar_prod, actualizar stock - listo - mandarino
Route::put('/detalle/{id}/producto/precio/updated',[EjecutivoController::class, 'actualizar_precio_producto'])->name('ver_detalle_precio_producto_actualizado');//metodo de vista administrar_prod, actualizar precio de venta - listo - mandarino
Route::put('/detalle/{id}/producto/updated',[EjecutivoController::class, 'actualizar_producto'])->name('ver_detalle_producto_actualizado');//metodo de vista administrar_prod, Editar producto - listo - mandarino
Route::put('/productos/{id}/estado',[EjecutivoController::class,'cambiar_estado_producto'])->name('cambiar_estado');//metodo de vista administrar_prod, activa o desactiva un producto - listo - mandarino



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
Route::post('/familias',[EjecutivoController::class, 'familias'])->name('test2'); //obsoleto
Route::post('/detalle/{id}/producto/deleted',[EjecutivoController::class, 'borrar_producto'])->name('eliminar_producto');//obsoleto

Route::get('/detalle/historico', [EjecutivoController::class,'historico_ventas'])->name('ver_historico');
Route::get('/productos/visualizar', [EjecutivoController::class,'ver_productos'])->name('ver_productos');
Route::get('/detalle/historico/{id}', [EjecutivoController::class,'ver_detalle_venta'])->name('ver_detalle_historico');


Route::resource('ventas',VentaController::class);

//Catálogo
Route::get('/catalogo',[CatalogoController::class,'index'])->name('ver_catalogo');
Route::get('/catalogo/intermedio',[CatalogoController::class,'intermedio'])->name('ver_catalogo_intermedio');
Route::get('catalogo/intermedio/producto',[CatalogoController::class,'intermedio_producto'])->name('ver_producto_intermedio');
Route::get('/catalogo/intermedio/filtrar/{familia}/{tipo_filtro}',[CatalogoController::class,'intermedio_filtro'])->name('ver_filtro_intermedio');
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
