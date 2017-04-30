<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvsTablas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('cvs', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('estudiante_id')->unsigned();
          $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade');
          $table->string('carta_presentacion');
          $table->string('sueldo_bruto_pretendido');
          $table->timestamps();
      });

      Schema::create('experiencias_laborales', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('cv_id')->unsigned();
          $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('cascade');
          $table->string('nombre_empresa');
          $table->string('puesto');
          $table->string('descripcion_tarea');
          $table->integer('rubro_empresarial_id')->unsigned();
          $table->foreign('rubro_empresarial_id')->references('id')->on('rubros_empresariales');
          $table->string('periodo_inicio');
          $table->string('periodo_fin');
          $table->timestamps();
      });

      Schema::create('estudios_academicos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('cv_id')->unsigned();
          $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('cascade');
          $table->string('nombre_instituto');
          $table->string('titulo');
          $table->integer('materias_total')->unsigned();
          $table->integer('materias_aprobadas')->unsigned();
          $table->integer('nivel_educativo_id')->unsigned();
          $table->foreign('nivel_educativo_id')->references('id')->on('niveles_educativos');
          $table->integer('estado_carrera_id')->unsigned();
          $table->foreign('estado_carrera_id')->references('id')->on('estados_carrera');
          $table->string('periodo_inicio');
          $table->string('periodo_fin');
          $table->timestamps();
      });

      Schema::create('conocimientos_informaticos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('cv_id')->unsigned();
          $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('cascade');
          $table->integer('tipo_software_id')->unsigned();
          $table->foreign('tipo_software_id')->references('id')->on('tipos_software');
          $table->integer('nivel_conocimiento_id')->unsigned();
          $table->foreign('nivel_conocimiento_id')->references('id')->on('niveles_conocimiento');
          $table->timestamps();
      });

      Schema::create('conocimientos_idiomas', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('cv_id')->unsigned();
          $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('cascade');
          $table->integer('idioma_id')->unsigned();
          $table->foreign('idioma_id')->references('id')->on('idiomas');
          $table->integer('tipo_conocimiento_idioma_id')->unsigned();
          $table->foreign('tipo_conocimiento_idioma_id')->references('id')->on('tipos_conocimiento_idioma');
          $table->integer('nivel_conocimiento_id')->unsigned();
          $table->foreign('nivel_conocimiento_id')->references('id')->on('niveles_conocimiento');
          $table->timestamps();
      });

      Schema::create('conocimientos_adicionales', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('cv_id')->unsigned();
          $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('cascade');
          $table->string('nombre_conocimiento');
          $table->string('descripcion_conocimiento');
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

        Schema::drop('cvs');
        Schema::drop('experiencias_laborales');
        Schema::drop('estudios_academicos');
        Schema::drop('conocimientos_informaticos');
        Schema::drop('conocimientos_idiomas');
        Schema::drop('conocimientos_adicionales');

    }
}
