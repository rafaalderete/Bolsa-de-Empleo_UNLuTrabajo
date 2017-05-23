@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Gestionar CV | Conocimientos Idiomas')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Agregar Conocimiento de Idioma</a></li>
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
      <h4 class="page-header">Agregar Conocimiento de Idioma</h4>

      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

      <!-- Formulario -->
      {!! Form::open(['route' => 'in.gestionar-cv.conocimientos-idiomas.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

        <div class="form-group">
          {!! Form::label('idioma','Idioma:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-2">
            <select name="idioma" class="populate placeholder" id="selectSimpleI" required>
              <option value=""></option>
              @foreach($idiomas as $idioma)
                <option value="{{$idioma->id}}">{{$idioma->nombre_idioma}}</option>
              @endforeach
            </select>
          </div>
        </div>

		<div class="form-group">
          {!! Form::label('tipo_conocimiento_idioma','Tipo Conocimiento Idioma:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-2">
            <select name="tipo_conocimiento_idioma" class="populate placeholder" id="selectSimpleTCI" required>
              <option value=""></option>
              @foreach($tiposConocimientosIdiomas as $tipoConocimientoIdioma)
                <option value="{{$tipoConocimientoIdioma->id}}">{{$tipoConocimientoIdioma->nombre_tipo_conocimiento_idioma}}</option>
              @endforeach
            </select>
          </div>
        </div>

		<div class="form-group">
          {!! Form::label('nivel_conocimiento','Nivel Conocimiento:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-2">
            <select name="nivel_conocimiento" class="populate placeholder" id="selectSimpleNC" required>
              <option value=""></option>
              @foreach($nivelesConocimientos as $nivelConocimiento)
                <option value="{{$nivelConocimiento->id}}">{{$nivelConocimiento->nombre_nivel_conocimiento}}</option>
              @endforeach
            </select>
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
                Borrar
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

    function borrar (){
      $('#selectSimpleI').select2().select2("val", null);
      $('#selectSimpleI').attr('placeholder', 'Idioma');
      $('#selectSimpleI').select2();
      $('#selectSimpleTCI').select2().select2("val", null);
      $('#selectSimpleTCI').attr('placeholder', 'Tipo Conocimiento');
      $('#selectSimpleTCI').select2();
      $('#selectSimpleNC').select2().select2("val", null);
      $('#selectSimpleNC').attr('placeholder', 'Nivel Conocimiento');
      $('#selectSimpleNC').select2();
    }

    $(document).ready(function() {
    	// Select
    	$('#selectSimpleI').select2({
      	placeholder: "Idioma",
        language: "es"
    	});

    	$('#selectSimpleTCI').select2({
      	placeholder: "Tipo Conocimiento"
    	});

	    $('#selectSimpleNC').select2({
        	placeholder: "Nivel Conocimiento"
      	});

      $("#reset").on("click", function() {
        borrar();
      });

    });
  </script>

@endsection
