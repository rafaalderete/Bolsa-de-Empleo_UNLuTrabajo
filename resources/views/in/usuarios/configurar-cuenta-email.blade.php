@extends('template.in_main')

@section('headTitle', 'Configurar Cuenta | Cambiar E-mail')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Configurar Cuenta</a></li>
        <li><a>Cambiar E-mail</a></li>
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
      <h4 class="page-header">Cambiar E-mail</h4>
      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

      <!-- Formulario -->
      {!! Form::open(['route' => 'in.configurar-cuenta-email', 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true]) !!}

        <div class="form-group">
          {!! Form::label('email','Nuevo E-mail', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'ejemplo@correo.com', 'required'])!!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('email_confirmation','Confirmar Nuevo E-mail', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('email_confirmation', null, ['class' => 'form-control', 'placeholder' => 'ejemplo@correo.com', 'required'])!!}
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
