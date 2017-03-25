<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('password', 60);
            $table->string('email')->unique();
            $table->string('descripcion_usuario');
            $table->enum('estado_usuario', ['activo','inactivo']);
            $table->string('nombre_usuario')->unique();
            $table->string('imagen');
            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            $table->rememberToken();
            $table->string('confirmacion_token', 255);
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
        // se deben eliminar en orden para q no haya problemas de claves foraneas

        Schema::drop('usuarios');
    }
}
