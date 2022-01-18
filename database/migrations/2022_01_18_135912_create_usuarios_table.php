<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Usuario;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->unsignedBigInteger('rut')->primary();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('password');
            $table->string('correo');
            $table->enum('tipo_usuario',[Usuario::trabajador, Usuario::cliente, Usuario::admin]);
            $table->enum('estado',[Usuario::ACTIVADO, Usuario::DESACTIVADO])->default(Usuario::ACTIVADO);


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
        Schema::dropIfExists('usuarios');
    }
}
