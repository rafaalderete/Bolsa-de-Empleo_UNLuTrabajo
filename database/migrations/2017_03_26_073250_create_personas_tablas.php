<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTablas extends Migration
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
          $table->enum('tipo_persona', ['fisica','juridica']);
          $table->enum('estado_persona', ['activo','inactivo']);
          $table->timestamps();
      });

      Schema::create('telefonos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('persona_id')->unsigned();
          $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
          $table->enum('tipo_telefono', ['fijo','celular']);
          $table->string('nro_telefono');
          $table->timestamps();
      });

      Schema::create('direcciones', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('persona_id')->unsigned();
          $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
          $table->string('domicilio');
          $table->string('localidad');
          $table->string('provincia');
          $table->string('pais');
          $table->timestamps();
      });

      Schema::create('juridicas', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('persona_id')->unsigned();
          $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
          $table->string('nombre_comercial');
          $table->date('fecha_fundacion');
          $table->string('cuit')->unique();
          $table->integer('rubro_empresarial_id')->unsigned();
          $table->foreign('rubro_empresarial_id')->references('id')->on('rubros_empresariales');
          $table->timestamps();
      });

      Schema::create('fisicas', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('persona_id')->unsigned();
          $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
          $table->string('nombre_persona');
          $table->string('apellido_persona');
          $table->date('fecha_nacimiento');
          $table->string('cuil')->unique();
          $table->integer('tipo_documento_id')->unsigned();
          $table->foreign('tipo_documento_id')->references('id')->on('tipos_documento');
          $table->string('nro_documento')->unique();
          $table->timestamps();
      });

      Schema::create('postulantes', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('fisica_id')->unsigned();
          $table->foreign('fisica_id')->references('id')->on('fisicas')->onDelete('cascade');
          $table->integer('estudiante_id')->unsigned();
          $table->foreign('estudiante_id')->references('id')->on('estudiantes');
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
        Schema::drop('telefonos');
        Schema::drop('direcciones');
        Schema::drop('juridicas');
        Schema::drop('fisicas');
        Schema::drop('postulantes');

    }
}
