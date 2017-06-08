@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Tipos de Conocimiento de Idioma | Editar Tipo de Conocimiento de Idioma')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Tipos de Conocimiento de Idioma</a></li>
        <li><a>Editar Tipo de Conocimiento de Idioma</a></li>
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
        <h4 class="page-header">Editar Tipo de Conocimiento de Idioma - {{$tipo_conocimiento_idioma->nombre_tipo_conocimiento_idioma}} </h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => ['in.tipo_conocimiento_idioma.update', $tipo_conocimiento_idioma], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

      		<div class="form-group">
      			{!! Form::label('nombre_tipo_conociminto_idioma','Nombre Tipo Conocimiento Idioma', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('nombre_tipo_conocimiento_idioma', $tipo_conocimiento_idioma->nombre_tipo_conocimiento_idioma,['class' => 'form-control', 'placeholder' => 'Nombre Tipo Conocimiento Idioma', 'required'])!!}
            </div>
      		</div>

          <div class="form-group">
            {!! Form::label('estado','Estado', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::select('estado', ['' => '','activo'=>'Activo', 'inactivo'=>'Inactivo'], $tipo_conocimiento_idioma->estado, ['class'=>'populate placeholder', 'id'=>'selectEstado'] ) !!}﻿
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

        <a href="{{ route('in.tipo_conocimiento_idioma.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver al Listado
        </a>
      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    function restablecer (tipo_conocimiento_idioma){
      $("input[name='nombre_tipo_conocimiento_idioma']").val(tipo_conocimiento_idioma['nombre_tipo_conocimiento_idioma']);
      $('#selectEstado').select2().select2("val", tipo_conocimiento_idioma['estado']);
      $('#selectEstado').select2();
    }

    $(document).ready(function() {

      var tipo_conocimiento_idioma = [];
      tipo_conocimiento_idioma['nombre_tipo_conocimiento_idioma'] = "{{$tipo_conocimiento_idioma->nombre_tipo_conocimiento_idioma}}";
      tipo_conocimiento_idioma['estado'] = "{{$tipo_conocimiento_idioma->estado}}";

      $('#selectEstado').select2({
        placeholder: "Estado"
      });

      $("#reset").on("click", function() {
        restablecer(tipo_conocimiento_idioma);
      });

    });
  </script>

@endsection
