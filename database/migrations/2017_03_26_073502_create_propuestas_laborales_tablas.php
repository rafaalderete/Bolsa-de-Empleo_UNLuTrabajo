<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropuestasLaboralesTablas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('propuestas_laborales', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('juridica_id')->unsigned();
          $table->foreign('juridica_id')->references('id')->on('juridicas')->onDelete('cascade');
          $table->string('titulo');
          $table->string('descripcion', 5000);
          $table->date('fecha_inicio_propuesta');
          $table->date('fecha_fin_propuesta');
          $table->string('lugar_de_trabajo');
          $table->integer('vacantes')->unsigned();
          $table->integer('requisito_años_experiencia_laboral')->unsigned();
          $table->enum('estado_propuesta', ['activo','inactivo']);
          $table->integer('tipo_jornada_id')->unsigned();
          $table->foreign('tipo_jornada_id')->references('id')->on('tipos_jornada');
          $table->integer('tipo_trabajo_id')->unsigned();
          $table->foreign('tipo_trabajo_id')->references('id')->on('tipos_trabajo');
          $table->timestamps();
      });

      Schema::create('estudiante_propuesta_laboral', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('propuesta_laboral_id')->unsigned();
          $table->foreign('propuesta_laboral_id')->references('id')->on('propuestas_laborales')->onUpdate('cascade')->onDelete('cascade');
          $table->integer('estudiante_id')->unsigned();
          $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onUpdate('cascade')->onDelete('cascade');
          $table->date('fecha_postulacion');
          $table->timestamps();
      });

      Schema::create('requisitos_carrera', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('propuesta_laboral_id')->unsigned();
          $table->foreign('propuesta_laboral_id')->references('id')->on('propuestas_laborales')->onUpdate('cascade')->onDelete('cascade');
          $table->integer('carrera_id')->unsigned();
          $table->foreign('carrera_id')->references('id')->on('carreras')->onUpdate('cascade')->onDelete('cascade');
          $table->integer('estado_carrera_id')->unsigned();
          $table->foreign('estado_carrera_id')->references('id')->on('estados_carrera')->onUpdate('cascade')->onDelete('cascade');
          $table->boolean('excluyente');
          $table->timestamps();
      });

      Schema::create('requisitos_idioma', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('propuesta_laboral_id')->unsigned();
          $table->foreign('propuesta_laboral_id')->references('id')->on('propuestas_laborales')->onUpdate('cascade')->onDelete('cascade');
          $table->integer('idioma_id')->unsigned();
          $table->foreign('idioma_id')->references('id')->on('idiomas')->onUpdate('cascade')->onDelete('cascade');
          $table->integer('tipo_conocimiento_idioma_id')->unsigned();
          $table->foreign('tipo_conocimiento_idioma_id')->references('id')->on('tipos_conocimiento_idioma')->onUpdate('cascade')->onDelete('cascade');
          $table->integer('nivel_conocimiento_id')->unsigned();
          $table->foreign('nivel_conocimiento_id')->references('id')->on('niveles_conocimiento')->onUpdate('cascade')->onDelete('cascade');
          $table->boolean('excluyente');
          $table->timestamps();
      });

      Schema::create('requisitos_residencia', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('propuesta_laboral_id')->unsigned();
          $table->foreign('propuesta_laboral_id')->references('id')->on('propuestas_laborales')->onUpdate('cascade')->onDelete('cascade');
          $table->string('lugar');
          $table->boolean('excluyente');
          $table->timestamps();
      });

      Schema::create('requisitos_adicionales', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('propuesta_laboral_id')->unsigned();
          $table->foreign('propuesta_laboral_id')->references('id')->on('propuestas_laborales')->onUpdate('cascade')->onDelete('cascade');
          $table->string('nombre_requisito');
          $table->integer('nivel_conocimiento_id')->unsigned();
          $table->foreign('nivel_conocimiento_id')->references('id')->on('niveles_conocimiento')->onUpdate('cascade')->onDelete('cascade');
          $table->boolean('excluyente');
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

        Schema::drop('propuestas_laborales');
        Schema::drop('postulante_propuesta_laboral');
        Schema::drop('requisitos_carrera');
        Schema::drop('requisitos_idioma');
        Schema::drop('requisitos_residencia');
        Schema::drop('requisitos_adicionales');

    }
}
