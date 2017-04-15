<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnluTablas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('carreras', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre_carrera');
          $table->timestamps();
      });

      Schema::create('estudiantes', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('legajo')->unsigned();
          $table->integer('carrera_id')->unsigned();
          $table->foreign('carrera_id')->references('id')->on('carreras');
          $table->string('nombre_estudiante');
          $table->string('apellido_estudiante');
          $table->date('fecha_nacimiento_estudiante');
          $table->string('cuil')->unique();
          $table->string('tipo_documento');
          $table->string('nro_documento')->unique();
          $table->string('email_estudiante')->unique();
          $table->string('telefono_fijo');
          $table->string('telefono_celular');
          $table->string('domicilio');
          $table->string('localidad');
          $table->string('provincia');
          $table->string('pais');
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

        Schema::drop('carreras');
        Schema::drop('estudiantes');

    }
}
