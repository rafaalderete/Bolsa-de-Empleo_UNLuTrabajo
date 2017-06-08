@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Configurar Cuenta | Recibir E-mail')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Configurar Cuenta</a></li>
        <li><a>Recibir E-mail</a></li>
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

    <div class="box-content dropbox col-xs-8 col-sm-8">
      <h4 class="page-header">Recibir E-mail</h4>
      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

      <!-- Formulario -->
      {!! Form::open(['route' => 'in.configurar-cuenta-recibir-email', 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true]) !!}

        <div class="form-group">
          {!! Form::label('recibir_email','¿Desea recibir E-mail de una nueva postulación?', ['class' => 'col-sm-5 control-label col-sm-offset-3']) !!}
          <div class="col-sm-1">
            @if ($recibeMail)
              <input type="checkbox" name='recibe_mail' class="form-control" checked/>
            @else
              <input type="checkbox" name='recibe_mail' class="form-control"/>
            @endif
          </div>
        </div>

        <div class="form-group text-center">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-info btn-label-left">
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
