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
            $table->string('cabeza');
            $table->string('tipo_rosca');
            $table->string('rosca');
            $table->string('punta');
            //$table->string('rosca_parcial');
            //$table->string('rosca_total');
            //$table->integer('vastago');
            //$table->boolean('tiene_parcial');
            
            


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
