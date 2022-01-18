<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelefonoProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefono_proveedors', function (Blueprint $table) {
            //$table->id();

            $table->unsignedBigInteger('proveedor_rut');
            $table->foreign('proveedor_rut')->references('rut')->on('proveedors')->onDelete('cascade');
            $table->string('telefono');
            $table->timestamps();

            //OJITO
            $table->primary(['proveedor_rut', 'telefono']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefono_proveedors');
    }
}
