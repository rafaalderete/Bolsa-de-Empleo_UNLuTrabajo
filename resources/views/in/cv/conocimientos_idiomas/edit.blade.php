@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Gestionar CV | Conocimientos Idiomas')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Modificar Conocimiento de Idioma</a></li>
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
      <h4 class="page-header">Modificar Conocimiento de Idioma</h4>

      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

      <!-- Formulario -->
      {!! Form::open(['route' => ['in.gestionar-cv.conocimientos-idiomas.update', $conocimientoIdioma], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

        <div class="form-group">
          {!! Form::label('idioma','Idioma:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::select('idioma',$idiomas, $conocimientoIdioma->idioma_id, ['class' =>'populate placeholder', 'id' => 'selectSimpleI'])!!}
          </div>
        </div>

		    <div class="form-group">
          {!! Form::label('tipo_conocimiento_idioma','Tipo Conocimiento:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::select('tipo_conocimiento_idioma',$tiposConocimientosIdiomas, $conocimientoIdioma->tipo_conocimiento_idioma_id, ['class' =>'populate placeholder', 'id' => 'selectSimpleTCI'])!!}
          </div>
        </div>

		    <div class="form-group">
          {!! Form::label('nivel_conocimiento','Nivel Conocimiento:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::select('nivel_conocimiento',$nivelesConocimientos, $conocimientoIdioma->nivel_conocimiento_id, ['class' =>'populate placeholder', 'id' => 'selectSimpleNC'])!!}
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

        <a href="{{ route('in.gestionar-cv.conocimientos-idiomas.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver a la Tabla
        </a>
    </div>
  </div>
</div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    function restablecer (conocimientoIdioma){
      $('#selectSimpleI').select2().select2("val", conocimientoIdioma['idioma']);
      $('#selectSimpleI').select2();
      $('#selectSimpleTCI').select2().select2("val", conocimientoIdioma['tipo_conocimiento_idioma']);
      $('#selectSimpleTCI').select2();
      $('#selectSimpleNC').select2().select2("val", conocimientoIdioma['nivel_conocimiento']);
      $('#selectSimpleNC').select2();
    }

    $(document).ready(function() {

      //Valores para restablecer.
      var conocimientoIdioma = [];
      conocimientoIdioma['idioma'] = {{$conocimientoIdioma->idioma_id}};
      conocimientoIdioma['tipo_conocimiento_idioma'] = {{$conocimientoIdioma->tipo_conocimiento_idioma_id}};
      conocimientoIdioma['nivel_conocimiento'] = {{$conocimientoIdioma->nivel_conocimiento_id}};

    	// Select
    	$('#selectSimpleI').select2({
      	placeholder: "Idioma"
    	});

    	$('#selectSimpleTCI').select2({
      	placeholder: "Tipo Conocimiento"
    	});

	    $('#selectSimpleNC').select2({
        	placeholder: "Nivel Conocimiento"
      	});

      $("#reset").on("click", function() {
        restablecer(conocimientoIdioma);
      });

    });
  </script>

@endsection
