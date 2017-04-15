@extends('template.in_main')

@section('headTitle', 'Configurar Cuenta | Cambiar Password')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Configurar Cuenta</a></li>
        <li><a>Cambiar Password</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')


<div class="row" style="margin-top:-20px">
  <!-- Box -->
  <div class="box">
    <!-- Cuerpo del Box-->

    @include('template.partials.sidebar-configuracion')

    <div class="box-content dropbox col-xs-9 col-sm-9">
      <h4 class="page-header">Cambiar Password</h4>
      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

      <!-- Formulario -->
      {!! Form::open(['route' => 'in.configurar-cuenta-password', 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true]) !!}

        <div class="form-group">
          {!! Form::label('password','Nueva Contraseña', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '********', 'autocomplete' => 'off', 'required'])!!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('password_confirmation','Confirmar Nueva Contraseña', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-4">
              {!!Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => '********', 'autocomplete' => 'off', 'required'])!!}
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-2">
            <button type="submit" class="btn btn-primary btn-label-left">
              <span><i class="fa fa-check-square"></i></span>
              Aceptar
            </button>
          </div>
        </div>

      {!! Form::close()!!}

      </div>
    </div>
  </div>

@endsection
