<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_proveedors', function (Blueprint $table) {
            $table->id();

            $table->integer('nivel_calidad');
           
            $table->unsignedBigInteger('proveedor_rut');
            $table->foreign('proveedor_rut')->references('rut')->on('proveedors')->onDelete('cascade');

            $table->unsignedBigInteger('madera_id');
            $table->foreign('madera_id')->references('producto_id')->on('maderas')->onDelete('cascade');

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
        Schema::dropIfExists('venta_proveedors');
    }
}
