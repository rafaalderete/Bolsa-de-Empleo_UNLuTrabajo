@extends('template.in_main')

@section('headTitle', 'Usuarios | Editar Usuario')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Usuarios</a></li>
        <li><a>Editar Usuario</a></li>
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
        <h4 class="page-header">Editar Usuario - {{$usuario->nombre_usuario}}</h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => ['in.usuarios.update', $usuario], 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}

          <div class="form-group">
            {!! Form::label('nombre_usuario','Nombre', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('nombre_usuario',$usuario->nombre_usuario, ['class' => 'form-control', 'placeholder' => 'Nombre Usuario', 'data-toggle' => "tooltip", 'data-placement' => "bottom", 'required'])!!}
            </div>
            {!! Form::label('persona_id','Persona', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::select('persona_id',$personas, $my_persona, ['id' => 'selectPersona'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('email','E-mail', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('email', $usuario->email, ['class' => 'form-control', 'placeholder' => 'yyyy@xxxx.zzz', 'required'])!!}
            </div>

            {!! Form::label('imagen','Imagen', ['class' => 'col-sm-2 control-label'])!!}
            <div class="col-sm-4">
              {!! Form::file('imagen') !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('roles','Roles Asignados', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::select('roles[]',$roles, $my_roles, ['multiple', 'id' => 'selectRoles'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('estado_usuario','Estado', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              <!-- ES mas facil hacerlo con etiqutas -->
              {!! Form::select('estado_usuario', ['' => '','activo'=>'Activo', 'inactivo'=>'Inactivo'], $usuario->estado_usuario, ['class'=>'populate placeholder', 'id'=>'selectEstado'] ) !!}﻿
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-2">
              <button type="submit" class="btn btn-primary btn-label-left">
                <span><i class="fa fa-check-square"></i></span>
                Aceptar
              </button>
            </div>
            <div class="col-sm-2">
              <button type="reset" class="btn btn-default btn-label-left">
                <span><i class="fa fa-times-circle txt-danger"></i></span>
                Restablecer
              </button>
            </div>
          </div>

        {!! Form::close()!!}

        <a href="{{ route('in.usuarios.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver a la Tabla
        </a>
      </div>
    </div>
  </div>

@endsection


@section('bodyJS')

  <script type="text/javascript">

    $(document).ready(function() {
      // Select
      $('#selectPersona').select2({
        placeholder: "Persona"
      });


      $('#selectRoles').select2({
        placeholder: "Asignar Roles"
      });

      $('#selectEstado').select2({
        placeholder: "Estado"
      });
    });

  </script>

@endsection
