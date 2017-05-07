@extends('template.in_main')

@section('headTitle', 'Gestionar CV | Conocimientos Idiomas')

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
  <div class="box">
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
          {!! Form::label('nivel_conocicmiento','Nivel Conocimiento:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::select('nivel_conocicmiento',$nivelesConocimientos, $conocimientoIdioma->nivel_conocimiento_id, ['class' =>'populate placeholder', 'id' => 'selectSimpleNC'])!!}
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
              <button type="reset" class="btn btn-default btn-label-left">
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

    $(document).ready(function() {
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

    });
  </script>

@endsection

