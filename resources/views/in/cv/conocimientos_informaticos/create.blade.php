@extends('template.in_main')

@section('headTitle', 'Gestionar CV | Conocimientos Idiomas')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Agregar Conocimiento Informático</a></li>
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
      <h4 class="page-header">Agregar Conocimiento Informático</h4>
        
      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')
      
      <!-- Formulario -->
      {!! Form::open(['route' => 'in.gestionar-cv.conocimientos-informaticos.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

		<div class="form-group">
          {!! Form::label('tipo_software','Tipo Software:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-2">
            <select name="tipo_software" class="populate placeholder" id="selectSimpleTS" required>
              <option value=""></option>
              @foreach($tiposSoftware as $tipoSoftware)
                <option value="{{$tipoSoftware->id}}">{{$tipoSoftware->nombre_tipo_software}}</option>
              @endforeach
            </select>
          </div>
        </div>

		<div class="form-group">
          {!! Form::label('nivel_conocicmiento','Nivel Conocimiento:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-2">
            <select name="nivel_conocicmiento" class="populate placeholder" id="selectSimpleNC" required>
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
              <button type="reset" class="btn btn-default btn-label-left">
                <span><i class="fa fa-times-circle txt-danger"></i></span>
                Borrar
              </button>
            </div>
          </div>

        {!! Form::close()!!}

        <a href="{{ route('in.gestionar-cv.conocimientos-informaticos.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
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

      	$('#selectSimpleTS').select2({
        	placeholder: "Tipo Software"
      	});

	    $('#selectSimpleNC').select2({
        	placeholder: "Nivel Conocimiento"
      	});

    });
  </script>

@endsection

