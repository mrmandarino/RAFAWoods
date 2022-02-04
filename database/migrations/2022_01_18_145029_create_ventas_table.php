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
            $table->integer('total_venta');
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
