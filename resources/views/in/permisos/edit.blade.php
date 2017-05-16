@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Permisos | Registrar Permiso')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Permisos</a></li>
        <li><a>Editar Permiso</a></li>
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
        <h4 class="page-header">Editar Permiso - {{$permiso->name}} </h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => ['in.permisos.update', $permiso], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

      		<div class="form-group">
      			{!! Form::label('name','Nombre Permiso', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('name', $permiso->name,['class' => 'form-control', 'placeholder' => 'Nombre Permiso', 'required'])!!}
            </div>
      		</div>

      		<div class="form-group">
      			{!! Form::label('descripcion_permiso','Descripción Permiso', ['class' => 'col-sm-2 control-label'])!!}
            <div class="col-sm-4">
      			  {!! Form::text('descripcion_permiso', $permiso->descripcion_permiso, ['class' => 'form-control', 'placeholder' => 'Descripción Permiso', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('estado_permiso','Estado', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              <!-- ES mas facil hacerlo con etiqutas -->
              {!! Form::select('estado_permiso', ['' => '','activo'=>'Activo', 'inactivo'=>'Inactivo'], $permiso->estado_permiso, ['class'=>'populate placeholder', 'id'=>'selectEstado'] ) !!}﻿
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

        <a href="{{ route('in.permisos.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver a la Tabla
        </a>
      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    function restablecer (permiso){
      $("input[name='name']").val(permiso['name']);
      $("input[name='descripcion_permiso']").val(permiso['descripcion_permiso']);
      $('#selectPermisos').attr('placeholder', 'Asignar Permisos');
      $('#selectEstado').select2().select2("val", permiso['estado_permiso']);
      $('#selectEstado').select2();
    }

    $(document).ready(function() {

      //Valores para restableces.
      var permiso = [];
      permiso['name'] = "{{$permiso->name}}";
      permiso['descripcion_permiso'] = "{{$permiso->descripcion_permiso}}";
      permiso['estado_permiso'] = "{{$permiso->estado_permiso}}";

      $('#selectEstado').select2({
        placeholder: "Estado"
      });

      $("#reset").on("click", function() {
        restablecer(permiso);
      });

    });
  </script>

@endsection
