<?php

use App\Models\Detalle_compra;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_compras', function (Blueprint $table) {
            //$table->id();
            $table->unsignedBigInteger('oc_id');
            $table->foreign('oc_id')->references('id')->on('orden_compras')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('nivel_calidad',[Detalle_compra::bajo, Detalle_compra::aceptable,Detalle_compra::medio,Detalle_compra::bueno,Detalle_compra::excelente]);
            $table->integer('cantidad');
            $table->integer('precio_unitario');
            $table->integer('total');
            $table->timestamps();
            $table->primary(['oc_id', 'producto_id']);
        });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_compras');
    }
}
