@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Gestionar CV | Conocimientos Adicionales')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Modificar Conocimiento Adicional</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')


<div class="row" style="margin-top:-20px">
  <!-- Box -->
  <div class="box no-box-shadow">
    <!-- Cuerpo del Box-->

    @include('template.partials.sidebar-gestionarcv')

    <div class="box-content dropbox">
      <h4 class="page-header">Modificar Conocimiento Adicional</h4>

      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

      <!-- Formulario -->
      {!! Form::open(['route' => ['in.gestionar-cv.conocimientos-adicionales.update', $conocimientoAdicional], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

		<div class="form-group">
          {!! Form::label('nombre_conocimiento','Nombre Conocimiento:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('nombre_conocimiento', $conocimientoAdicional->nombre_conocimiento, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
          </div>
        </div>

    	<div class="form-group">
          {!! Form::label('descripcion_conocimiento','Descripción Conocimiento:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-6">
            {!! Form::text('descripcion_conocimiento', $conocimientoAdicional->descripcion_conocimiento, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
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

        <a href="{{ route('in.gestionar-cv.conocimientos-adicionales.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver al Listado
        </a>
    </div>
  </div>
</div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    function restablecer (conocimientoAdicional){
      $("input[name='nombre_conocimiento']").val(conocimientoAdicional['nombre_conocimiento']);
      $("input[name='descripcion_conocimiento']").val(conocimientoAdicional['descripcion_conocimiento']);

    }

    $(document).ready(function() {

      //Valores para restablecer.
      var conocimientoAdicional = [];
      conocimientoAdicional['nombre_conocimiento'] = "{{$conocimientoAdicional->nombre_conocimiento}}";
      conocimientoAdicional['descripcion_conocimiento'] = "{{$conocimientoAdicional->descripcion_conocimiento}}";

      $("#reset").on("click", function() {
        restablecer(conocimientoAdicional);
      });
    });

  </script>

@endsection
