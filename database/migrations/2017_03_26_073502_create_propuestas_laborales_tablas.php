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
          $table->string('descripcion');
          $table->string('requisito');
          $table->date('fecha_inicio_propuesta');
          $table->date('fecha_fin_propuesta');
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
          $table->integer('persona_id')->unsigned();
          $table->foreign('persona_id')->references('id')->on('personas')->onUpdate('cascade')->onDelete('cascade');
          $table->date('fecha_postulacion');
          $table->timestamps();
      });

      Schema::create('propuesta_unlu_carrera', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('propuesta_laboral_id')->unsigned();
          $table->foreign('propuesta_laboral_id')->references('id')->on('propuestas_laborales')->onUpdate('cascade')->onDelete('cascade');
          $table->integer('unlu_carrera_id')->unsigned();
          $table->foreign('unlu_carrera_id')->references('id')->on('unlu_carreras')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('estudiante_propuestalaboral');
        Schema::drop('propuesta_unlucarrera');

    }
}
