<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechumbresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('techumbres', function (Blueprint $table) {
            $table->unsignedBigInteger('producto_id')->primary();
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->string('material');
            $table->integer('alto');
            $table->integer('ancho');
            $table->integer('largo');

            


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
        Schema::dropIfExists('techumbres');
    }
}
