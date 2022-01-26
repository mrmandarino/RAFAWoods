<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTornillosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tornillos', function (Blueprint $table) {
            $table->unsignedBigInteger('producto_id')->primary();
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->integer('cabeza');//diametro de la cabeza
            $table->string('tipo_rosca');//total o parcial
            $table->integer('separacion_rosca');//longitud entre vueltas del hilo
            $table->string('punta');
            $table->integer('rosca_parcial')->default('0');//longitud de la parte del tornillo sin rosca
            $table->integer('vastago');//longitud del tornillo sin contar la cabeza
            
            


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
        Schema::dropIfExists('tornillos');
    }
}
