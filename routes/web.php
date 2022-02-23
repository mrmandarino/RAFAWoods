<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\GraficoController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\EjecutivoController;
use App\Http\Controllers\ComentarioController;
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
})->name('cover');

Route::get('/ayudameme', function () {
    

    //return view('graficos.graficos');
    return view('inicio.inicio_usuario');
});

Route::get('inicio', [ComentarioController::class,'create'])->name('inicio');
Route::put('update/comentario/{id}', [ComentarioController::class,'update'])->name('update_comentario');
Route::put('destroy/{id}', [ComentarioController::class,'destroy'])->name('destroy_comentario');

//Graficos

// Route::get('graficos', [GraficoController::class,'index'])->name('graficos');
// Route::get('/graficos/redireccion', [GraficoController::class,'redireccion'])->name('redireccion');
// Route::get('/graficos/grafico_anual/{ano}', [GraficoController::class,'grafico_anual'])->name('grafico_anual');
// Route::get('/graficos/grafico_mes/{fecha_mes}', [GraficoController::class,'grafico_mes'])->name('grafico_mes');
// Route::get('/graficos/grafico_semana/{fecha_semana}', [GraficoController::class,'grafico_semana'])->name('grafico_semana');

//Inventario
// Route::get('/inventario', [EjecutivoController::class,'index'])->name('ver_inventario');
// Route::post('/inventario/created',[EjecutivoController::class, 'agregar_producto'])->name('agregar_producto');
// Route::post('/familias',[EjecutivoController::class, 'familias'])->name('test2');
// Route::get('/detalle',[EjecutivoController::class, 'detalle_producto'])->name('ver_detalle');
// Route::put('/detalle/{id}/stock/updated',[EjecutivoController::class, 'detalle_producto_stock_actualizado'])->name('ver_detalle_stock_actualizado');
// Route::put('/detalle/{id}/producto/updated',[EjecutivoController::class, 'actualizar_producto'])->name('ver_detalle_producto_actualizado');
// Route::put('/detalle/{id}/producto/precio/updated',[EjecutivoController::class, 'actualizar_precio_producto'])->name('ver_detalle_precio_producto_actualizado');
// Route::post('/detalle/{id}/producto/deleted',[EjecutivoController::class, 'borrar_producto'])->name('eliminar_producto');
// Route::get('/inventario/precios',[EjecutivoController::class,'index_precios'])->name('ver_detalle_precios');
// Route::post('/familias',[EjecutivoController::class, 'familias'])->name('test2'); //obsoleto
// Route::post('/detalle/{id}/producto/deleted',[EjecutivoController::class, 'borrar_producto'])->name('eliminar_producto');//obsoleto
// Route::put('/inventario/{id}/estado',[EjecutivoController::class,'cambiar_estado_producto'])->name('cambiar_estado');//metodo de vista administrar_prod, activa o desactiva un producto - listo - mandarino

//Historico de ventas
// Route::get('/detalle/historico', [EjecutivoController::class,'historico_ventas'])->name('ver_historico');
// Route::get('/detalle/historico/{id}', [EjecutivoController::class,'ver_detalle_venta'])->name('ver_detalle_historico');
// Route::get('/productos/visualizar', [EjecutivoController::class,'ver_productos'])->name('ver_productos');

//Ventas
// Route::resource('ventas',VentaController::class);

//Catálogo
Route::get('/catalogo',[CatalogoController::class,'index'])->name('ver_catalogo');
Route::get('/catalogo/intermedio',[CatalogoController::class,'intermedio'])->name('ver_catalogo_intermedio');
Route::get('catalogo/intermedio/producto',[CatalogoController::class,'intermedio_producto'])->name('ver_producto_intermedio');
Route::get('/catalogo/intermedio/filtrar/{familia}/{tipo_filtro}',[CatalogoController::class,'intermedio_filtro'])->name('ver_filtro_intermedio');
Route::get('/catalogo/{familia}',[CatalogoController::class,'index_por_familia'])->name('ver_catalogo_por_familia');
Route::get('/catalogo/detalle_producto/{nombre_producto}',[CatalogoController::class,'detalle_producto'])->name('ver_detalle_producto');
Route::get('/catalogo/filtrar/{tipo_filtro}/{familia}',[CatalogoController::class,'index_filtro'])->name('ver_catalogo_filtrado');

//middleware vendedor
Route::middleware(['auth','activo','vendedor'])->group(function(){
  
    //ventas
    Route::resource('ventas',VentaController::class);
    //productos (sidebar)
    Route::get('/productos/visualizar', [EjecutivoController::class,'ver_productos'])->name('ver_productos');

});

//middleware ejecutivos
Route::middleware(['auth','activo','ejecutivo'])->group(function(){
    
    //graficos
    Route::get('graficos', [GraficoController::class,'index'])->name('graficos');
    Route::get('/graficos/redireccion', [GraficoController::class,'redireccion'])->name('redireccion');
    Route::get('/graficos/grafico_anual/{ano}', [GraficoController::class,'grafico_anual'])->name('grafico_anual');
    Route::get('/graficos/grafico_mes/{fecha_mes}', [GraficoController::class,'grafico_mes'])->name('grafico_mes');
    Route::get('/graficos/grafico_semana/{fecha_semana}', [GraficoController::class,'grafico_semana'])->name('grafico_semana');

    //inventario
    Route::get('/cargar',[EjecutivoController::class, 'cargar_administrar'])->name('cargar_administrar');
    Route::post('/detalle/{id}/producto/imagen/created',[EjecutivoController::class, 'subir_imagen'])->name('subir_imagen_producto');
    Route::get('/inventario', [EjecutivoController::class,'index'])->name('ver_inventario');
    Route::post('/inventario/created',[EjecutivoController::class, 'agregar_producto'])->name('agregar_producto');
    Route::post('/familias',[EjecutivoController::class, 'familias'])->name('test2');
    Route::get('/detalle/{id_redirect}',[EjecutivoController::class, 'detalle_producto'])->name('ver_detalle');
    Route::put('/detalle/{id}/stock/updated',[EjecutivoController::class, 'detalle_producto_stock_actualizado'])->name('ver_detalle_stock_actualizado');
    Route::put('/detalle/{id}/producto/updated',[EjecutivoController::class, 'actualizar_producto'])->name('ver_detalle_producto_actualizado');
    Route::put('/detalle/{id}/producto/precio/updated',[EjecutivoController::class, 'actualizar_precio_producto'])->name('ver_detalle_precio_producto_actualizado');
    Route::post('/detalle/{id}/producto/deleted',[EjecutivoController::class, 'borrar_producto'])->name('eliminar_producto');
    Route::get('/inventario/precios',[EjecutivoController::class,'index_precios'])->name('ver_detalle_precios');
    Route::post('/familias',[EjecutivoController::class, 'familias'])->name('test2'); //obsoleto
    Route::post('/detalle/{id}/producto/deleted',[EjecutivoController::class, 'borrar_producto'])->name('eliminar_producto');//obsoleto
    Route::put('/inventario/{id}/estado',[EjecutivoController::class,'cambiar_estado_producto'])->name('cambiar_estado');//metodo de vista administrar_prod, activa o desactiva un producto - listo - mandarino

    //historico ventas
    Route::get('/historico/ventas', [EjecutivoController::class,'historico_ventas'])->name('ver_historico');
    Route::get('/historico/ventas/{id}', [EjecutivoController::class,'ver_detalle_venta'])->name('ver_detalle_historico');


});

//middleware administrador
Route::middleware(['auth','activo','administrador'])->group(function(){

    //base de datos
    Route::get('/menu_bd',[AdminController::class,'menu'])->name('menu_bd');
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
