@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Tipos de Jornada | Editar Tipo de Jornada')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Tipos de Jornada</a></li>
        <li><a>Editar Tipo de Jornada</a></li>
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
        <h4 class="page-header">Editar Tipo de Jornada - {{$tipo_jornada->nombre_tipo_jornada}} </h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => ['in.tipo_jornada.update', $tipo_jornada], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

      		<div class="form-group">
      			{!! Form::label('nombre_tipo_jornada','Nombre Tipo Jornada', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('nombre_tipo_jornada', $tipo_jornada->nombre_tipo_jornada,['class' => 'form-control', 'placeholder' => 'Nombre Tipo Jornada', 'required'])!!}
            </div>
      		</div>

          <div class="form-group">
            {!! Form::label('estado','Estado', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::select('estado', ['' => '','activo'=>'Activo', 'inactivo'=>'Inactivo'], $tipo_jornada->estado, ['class'=>'populate placeholder', 'id'=>'selectEstado'] ) !!}﻿
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

        <a href="{{ route('in.tipo_jornada.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver al Listado
        </a>
      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    function restablecer (tipo_jornada){
      $("input[name='nombre_tipo_jornada']").val(tipo_jornada['nombre_tipo_jornada']);
      $('#selectEstado').select2().select2("val", tipo_jornada['estado']);
      $('#selectEstado').select2();
    }

    $(document).ready(function() {

      var tipo_jornada = [];
      tipo_jornada['nombre_tipo_jornada'] = "{{$tipo_jornada->nombre_tipo_jornada}}";
      tipo_jornada['estado'] = "{{$tipo_jornada->estado}}";

      $('#selectEstado').select2({
        placeholder: "Estado"
      });

      $("#reset").on("click", function() {
        restablecer(tipo_jornada);
      });

    });
  </script>

@endsection
