<?php

use App\Models\Venta;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sucursal_id')->nullable();
            $table->foreign('sucursal_id')->references('id')->on('inventarios')->onDelete('set null');
            $table->enum('medio_de_pago',[Venta::efectivo, Venta::tarjeta_debito,Venta::tarjeta_credito,Venta::transferencia]);
            $table->string('vendedor_rut');
            $table->foreign('vendedor_rut')->references('usuario_rut')->on('trabajadors')->onDelete('set null');
            $table->string('cliente_rut')->nullable();
            //$table->foreign('cliente_rut')->references('usuario_rut')->on('clientes')->onDelete('set null');
            $table->integer('total_venta');
            $table->integer('utilidad_bruta');
            $table->boolean('con_factura')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}