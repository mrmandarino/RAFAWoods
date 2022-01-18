<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportes', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_transportista');
            $table->string('tipo_vehiculo');
            $table->integer('valor_viaje');
           
            $table->unsignedBigInteger('proveedor_rut');
            $table->foreign('proveedor_rut')->references('rut')->on('proveedors')->onDelete('cascade');


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
        Schema::dropIfExists('transportes');
    }
}
