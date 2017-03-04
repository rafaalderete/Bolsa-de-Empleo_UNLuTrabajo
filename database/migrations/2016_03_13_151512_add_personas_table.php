<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_persona');
            $table->string('apellido_persona');
            $table->string('descripcion_persona');
            $table->enum('estado_persona', ['activo','inactivo']);
            $table->date('fecha_nacimiento_persona');
            $table->string('tipo_documento_persona');
            $table->integer('nro_documento_persona');
            $table->string('domicilio_residencia_persona');
            $table->string('localidad_residencia_persona');
            $table->string('provincia_residencia_persona');
            $table->string('pais_residencia_persona');       
            $table->string('telefono_contacto_persona');
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
        Schema::drop('personas');
    }
}
