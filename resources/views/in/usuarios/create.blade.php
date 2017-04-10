@extends('template.in_main')

@section('headTitle', 'Usuario | Registrar Usuario')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Usuarios</a></li>
        <li><a>Registrar Usuario</a></li>
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
      <h4 class="page-header">Registro de Usuario</h4>

      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

      <!-- Formulario -->
      {!! Form::open(['route' => 'in.usuarios.store', 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true]) !!}

        <div class="form-group">
          {!! Form::label('nombre_usuario','Nombre Usuario', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('nombre_usuario',null,['class' => 'form-control', 'placeholder' => 'Nombre Usuario', 'data-toggle' => "tooltip", 'data-placement' => "bottom", 'required'])!!}
          </div>
          {!! Form::label('persona_id','Persona/Empresa', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <select name="persona_id" class="populate placeholder" id="selectPersona">
              <option value=""></option>
              @foreach( $personas as $persona)
                @if($persona->tipo_persona == 'fisica')
                  <option value="{{$persona->id}}">{{$persona->fisica->nombre_persona.' '.$persona->fisica->apellido_persona}}</option>
                @else
                  <option value="{{$persona->id}}">{{$persona->juridica->nombre_comercial}}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('email','E-mail', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'yyyy@xxxx.zzz', 'required'])!!}
          </div>
          {!! Form::label('password','Contraseña', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('password',null,['class' => 'form-control', 'placeholder' => '*********', 'required'])!!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('roles','Roles Asignados', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::select('roles[]',$roles, null, ['multiple', 'class' =>'populate placeholder', 'id' => 's2_with_tag'])!!}
          </div>
          {!! Form::label('imagen','Imagen', ['class' => 'col-sm-2 control-label'])!!}
          <div class="col-sm-4">
            {!! Form::file('imagen') !!}
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
              Borrar
            </button>
          </div>
        </div>

      {!! Form::close()!!}

      <a href="{{ route('in.usuarios.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
        <span><i class="fa fa-reply"></i></span>
        Volver a la Tabla</a>
      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    $(document).ready(function() {
      // Select
      $('#s2_with_tag').select2({
        placeholder: "Roles",
      });

      $('#selectPersona').select2({
        placeholder: "Persona"
      });
    });

  </script>

@endsection
