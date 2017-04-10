<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametriasTablas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('rubros_empresariales', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre_rubro_empresarial')->unique();
          $table->enum('estado', ['activo','inactivo']);
          $table->timestamps();
      });

      Schema::create('tipos_jornada', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre_tipo_jornada')->unique();
          $table->enum('estado', ['activo','inactivo']);
          $table->timestamps();
      });

      Schema::create('tipos_trabajo', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre_tipo_trabajo')->unique();
          $table->enum('estado', ['activo','inactivo']);
          $table->timestamps();
      });

      Schema::create('estados_carrera', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre_estado_carrera')->unique();
          $table->enum('estado', ['activo','inactivo']);
          $table->timestamps();
      });

      Schema::create('niveles_educativos', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre_nivel_educativo')->unique();
          $table->enum('estado', ['activo','inactivo']);
          $table->timestamps();
      });

      Schema::create('tipos_software', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre_tipo_software')->unique();
          $table->enum('estado', ['activo','inactivo']);
          $table->timestamps();
      });

      Schema::create('niveles_conocimiento', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre_nivel_conocimiento')->unique();
          $table->enum('estado', ['activo','inactivo']);
          $table->timestamps();
      });

      Schema::create('idiomas', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre_idioma')->unique();
          $table->enum('estado', ['activo','inactivo']);
          $table->timestamps();
      });

      Schema::create('tipos_conocimiento_idioma', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre_tipo_conocimiento_idioma')->unique();
          $table->enum('estado', ['activo','inactivo']);
          $table->timestamps();
      });

      Schema::create('tipos_documento', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre_tipo_documento')->unique();
          $table->enum('estado', ['activo','inactivo']);
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

        Schema::drop('rubros_empresariales');
        Schema::drop('tipos_jornada');
        Schema::drop('tipos_trabajo');
        Schema::drop('estados_carrera');
        Schema::drop('niveles_educativos');
        Schema::drop('tipos_software');
        Schema::drop('niveles_conocimiento');
        Schema::drop('idiomas');
        Schema::drop('tipos_conocimiento_idioma');
        Schema::drop('tipos_documento');

    }
}
