@extends('template.main')

@section('headTitle', 'Permisos | Registrar Permiso')

@section('headContent')

  <meta name="description" content="description">
  <meta name="author" content="DevOOPS">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('plugins/bootstrap/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}">
  <link rel="stylesheet" href="{{asset('http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('http://fonts.googleapis.com/css?family=Righteous')}}" >
  <link rel="stylesheet" href="{{asset('plugins/fancybox/jquery.fancybox.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/fullcalendar/fullcalendar.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/xcharts/xcharts.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/chosen/chosen.css')}}">

@endsection

@section('bodyHeader')

  @include('template.partials.header')

@endsection

@section('bodySidebar')

  @include('template.partials.sidebar')

@endsection

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
      			{!! Form::label('funcionalidad_permiso','Funcionalidad Permiso', ['class' => 'col-sm-2 control-label'])!!}
            <div class="col-sm-5">
      			  {!! Form::text('funcionalidad_permiso', $permiso->funcionalidad_permiso, ['class' => 'form-control', 'placeholder' => 'Funcionalidad Permiso', 'required'])!!}
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

        <a href="{{ route('in.permisos.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver a la Tabla
        </a>
      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <!--<script src="http://code.jquery.com/jquery.js"></script>-->
  <script src="{{asset('plugins/jquery/jquery.js')}}"></script>
  <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>
  <script src="{{asset('plugins/justified-gallery/jquery.justifiedgallery.min.js')}}"></script>
  <script src="{{asset('plugins/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('plugins/tinymce/jquery.tinymce.min.js')}}"></script>
  <!-- All functions for this theme + document.ready processing -->
  <script src="{{asset('js/devoops.min.js')}}"></script>
  <!-- Se Agregaron -->
  <script src="{{asset('plugins/select2/select2.js')}}"></script>
  <script src="{{asset('plugins/chosen/chosen.jquery.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      $('#selectEstado').select2({
        placeholder: "Estado"
      });

    });
  </script>

@endsection
