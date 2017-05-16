@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Idiomas | Editar Idioma')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Idioma</a></li>
        <li><a>Editar Idioma</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')

  <div class="row" style="margin-top:-20px">
    <!-- Box -->
    <div class="box">
      <!-- Cuerpo del Box-->
      <div class="box-content dropbox">
        <h4 class="page-header">Editar Idioma - {{$idioma->nombre_idioma}} </h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => ['in.idiomas.update', $idioma], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

      		<div class="form-group">
      			{!! Form::label('nombre_idioma','Nombre Idioma', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('nombre_idioma', $idioma->nombre_idioma,['class' => 'form-control', 'placeholder' => 'Nombre Idioma', 'required'])!!}
            </div>
      		</div>

          <div class="form-group">
            {!! Form::label('estado','Estado', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::select('estado', ['' => '','activo'=>'Activo', 'inactivo'=>'Inactivo'], $idioma->estado, ['class'=>'populate placeholder', 'id'=>'selectEstado'] ) !!}﻿
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-2">
              <button type="submit" class="btn btn-info btn-label-left">
                <span><i class="fa fa-check-square"></i></span>
                Aceptar
              </button>
            </div>
            <div class="col-sm-2">
              <button type="button" class="btn btn-default btn-label-left" id="reset">
                <span><i class="fa fa-times-circle txt-danger"></i></span>
                Restablecer
              </button>
            </div>
          </div>

      	{!! Form::close()!!}

        <a href="{{ route('in.idiomas.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver a la Tabla
        </a>
      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    function restablecer (idioma){
      $("input[name='nombre_idioma']").val(idioma['nombre_idioma']);
      $('#selectEstado').select2().select2("val", idioma['estado']);
      $('#selectEstado').select2();
    }

    $(document).ready(function() {

      var idioma = [];
      idioma['nombre_idioma'] = "{{$idioma->nombre_idioma}}";
      idioma['estado'] = "{{$idioma->estado}}";

      $('#selectEstado').select2({
        placeholder: "Estado"
      });

      $("#reset").on("click", function() {
        restablecer(idioma);
      });

    });
  </script>

@endsection
