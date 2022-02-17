<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VentaController;
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

Route::get('/cover', function () {
    return view('cover.cover_home');
});

// Route::get('/ayudameme', function () {
//     $id_producto_int=1;
//     $familia = DB::table('productos')->where('id',$id_producto_int)->value('familia');
//     $tabla_familia = strtolower($familia.'s');
//     $producto_en_stock = DB::table('localizacions')->where('producto_id',$id_producto_int)->first();
//     $producto_en_bruto = DB::table('productos')->where('id',$id_producto_int)->first(); 
//     $producto_en_tabla = DB::table($tabla_familia)->where('producto_id',$id_producto_int)->first();

//     return view('inventario.administrar_prod',compact('producto_en_stock','producto_en_bruto','producto_en_tabla'));
// });


//las conexiones estan listas, falta validaciones varias
Route::get('/productos', [EjecutivoController::class,'index'])->name('ver_inventario');//vista control_inv - listo - mandarino
Route::get('/productos/precios',[EjecutivoController::class,'index_precios'])->name('ver_detalle_precios');//metodo de vista control_inv, ir a lista de precios - listo - mandarino
Route::post('/productos/created',[EjecutivoController::class, 'agregar_producto'])->name('agregar_producto');//metodo de vista control_inv, agregar nuevo producto - listo - mandarino

Route::get('/detalle',[EjecutivoController::class, 'detalle_producto'])->name('ver_detalle');//vista administrar_prod - listo - mandarino
Route::put('/detalle/{id}/stock/updated',[EjecutivoController::class, 'detalle_producto_stock_actualizado'])->name('ver_detalle_stock_actualizado');//metodo de vista administrar_prod, actualizar stock - listo - mandarino
Route::put('/detalle/{id}/producto/precio/updated',[EjecutivoController::class, 'actualizar_precio_producto'])->name('ver_detalle_precio_producto_actualizado');//metodo de vista administrar_prod, actualizar precio de venta - listo - mandarino
Route::put('/detalle/{id}/producto/updated',[EjecutivoController::class, 'actualizar_producto'])->name('ver_detalle_producto_actualizado');//metodo de vista administrar_prod, Editar producto - listo - mandarino
Route::put('/productos/{id}/estado',[EjecutivoController::class,'cambiar_estado_producto'])->name('cambiar_estado');//metodo de vista administrar_prod, activa o desactiva un producto - listo - mandarino


Route::post('/familias',[EjecutivoController::class, 'familias'])->name('test2'); //obsoleto
Route::post('/detalle/{id}/producto/deleted',[EjecutivoController::class, 'borrar_producto'])->name('eliminar_producto');//obsoleto


Route::resource('ventas',VentaController::class);


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
