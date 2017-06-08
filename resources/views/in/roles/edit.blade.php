@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Roles | Editar Rol')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Roles</a></li>
        <li><a>Editar Rol</a></li>
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
        <h4 class="page-header">Editar Rol - {{$rol->name}}</h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => ['in.roles.update', $rol], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

      		<div class="form-group">
      			{!! Form::label('name','Nombre Rol', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('name',$rol->name,['class' => 'form-control', 'placeholder' => 'Nombre Rol', 'required'])!!}
            </div>
      		</div>

      		<div class="form-group">
      			{!! Form::label('descripcion_rol','Descripción Rol', ['class' => 'col-sm-2 control-label'])!!}
            <div class="col-sm-4">
      			  {!! Form::text('descripcion_rol', $rol->descripcion_rol, ['class' => 'form-control', 'placeholder' => 'Descripción Rol', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('permisos','Permisos', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
              {!! Form::select('permisos[]',$permisos, $my_permisos, ['multiple', 'id' => 'selectPermisos'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('estado_rol','Estado', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              <!-- ES mas facil hacerlo con etiqutas -->
              {!! Form::select('estado_rol', ['' => '','activo'=>'Activo', 'inactivo'=>'Inactivo'], $rol->estado_rol, ['class'=>'populate placeholder', 'id'=>'selectEstado'] ) !!}﻿
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

        <a href="{{ route('in.roles.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver al Listado
        </a>
      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    function restablecer (rol){
      $("input[name='name']").val(rol['name']);
      $("input[name='descripcion_rol']").val(rol['descripcion_rol']);
      $("#selectPermisos").select2('val',rol['permisos_seleccionados']);
      $('#selectPermisos').select2();
      $('#selectPermisos').attr('placeholder', 'Asignar Permisos');
      $('#selectEstado').select2().select2("val", rol['estado_rol']);
      $('#selectEstado').select2();
    }

    $(document).ready(function() {

      //Valores para restablecer.
      var rol = [];
      rol['name'] = "{{$rol->name}}";
      rol['descripcion_rol'] = "{{$rol->descripcion_rol}}";
      rol['estado_rol'] = "{{$rol->estado_rol}}";
      rol['permisos_seleccionados'] = {{ json_encode($my_permisos) }};

      // Select
      $('#selectEstado').select2({
        placeholder: "Estado"
      });

      $('#selectPermisos').select2({
        placeholder: "Asignar Permisos"
      });

      $('#reset').click(function() {
        restablecer(rol);
      });
    });

  </script>

@endsection
