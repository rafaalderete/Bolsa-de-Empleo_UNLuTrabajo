@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Rubros Empresariales | Editar Rubro Empresarial')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Rubros Empresariales</a></li>
        <li><a>Editar Rubro Empresarial</a></li>
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
        <h4 class="page-header">Editar Rubro Empresarial - {{$rubro->nombre_rubro_empresarial}} </h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => ['in.rubros-empresariales.update', $rubro], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

      		<div class="form-group">
      			{!! Form::label('nombre_rubro_empresarial','Nombre Rubro Empresarial', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('nombre_rubro_empresarial', $rubro->nombre_rubro_empresarial,['class' => 'form-control', 'placeholder' => 'Nombre Rubro Empresarial', 'required'])!!}
            </div>
      		</div>

          <div class="form-group">
            {!! Form::label('estado','Estado', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::select('estado', ['' => '','activo'=>'Activo', 'inactivo'=>'Inactivo'], $rubro->estado, ['class'=>'populate placeholder', 'id'=>'selectEstado'] ) !!}﻿
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

        <a href="{{ route('in.rubros-empresariales.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver al Listado
        </a>
      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    function restablecer (rubro){
      $("input[name='nombre_rubro_empresarial']").val(rubro['nombre_rubro_empresarial']);
      $('#selectEstado').select2().select2("val", rubro['estado']);
      $('#selectEstado').select2();
    }

    $(document).ready(function() {

      var rubro= [];
      rubro['nombre_rubro_empresarial'] = "{{$rubro->nombre_rubro_empresarial}}";
      rubro['estado'] = "{{$rubro->estado}}";

      $('#selectEstado').select2({
        placeholder: "Estado"
      });

      $("#reset").on("click", function() {
        restablecer(rubro);
      });

    });
  </script>

@endsection
