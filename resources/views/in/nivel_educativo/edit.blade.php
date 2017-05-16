@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Niveles Educativos | Editar Nivel Educativo')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Niveles Educativos</a></li>
        <li><a>Editar Nivel Educativo</a></li>
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
        <h4 class="page-header">Editar Nivel Educativo - {{$niveles_educativos->nombre_nivel_educativo}} </h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => ['in.nivel_educativo.update', $niveles_educativos], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

      		<div class="form-group">
      			{!! Form::label('nombre_nivel_educativo','Nombre Nivel Educativo', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('nombre_nivel_educativo', $niveles_educativos->nombre_nivel_educativo,['class' => 'form-control', 'placeholder' => 'Nombre Nivel Educativo', 'required'])!!}
            </div>
      		</div>

          <div class="form-group">
            {!! Form::label('estado','Estado', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::select('estado', ['' => '','activo'=>'Activo', 'inactivo'=>'Inactivo'], $niveles_educativos->estado, ['class'=>'populate placeholder', 'id'=>'selectEstado'] ) !!}﻿
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

        <a href="{{ route('in.nivel_educativo.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver a la Tabla
        </a>
      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    function restablecer (nivel_educativo){
      $("input[name='nombre_nivel_educativo']").val(nivel_educativo['nombre_nivel_educativo']);
      $('#selectEstado').select2().select2("val", nivel_educativo['estado']);
      $('#selectEstado').select2();
    }

    $(document).ready(function() {

      var nivel_educativo = [];
      nivel_educativo['nombre_nivel_educativo'] = "{{$niveles_educativos->nombre_nivel_educativo}}";
      nivel_educativo['estado'] = "{{$niveles_educativos->estado}}";

      $('#selectEstado').select2({
        placeholder: "Estado"
      });

      $("#reset").on("click", function() {
        restablecer(nivel_educativo);
      });

    });
  </script>

@endsection
