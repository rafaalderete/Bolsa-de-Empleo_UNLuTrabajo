@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Gestionar CV | Conocimientos Informaticos')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Modificar Conocimiento Informático</a></li>
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
      <h4 class="page-header">Modificar Conocimiento Informático</h4>

      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

      <!-- Formulario -->
      {!! Form::open(['route' => ['in.gestionar-cv.conocimientos-informaticos.update', $conocimientoInformatico], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

		    <div class="form-group">
          {!! Form::label('tipo_software','Tipo Conocimiento:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-3">
            {!! Form::select('tipo_software',$tiposSoftware, $conocimientoInformatico->tipo_software_id, ['class' =>'populate placeholder', 'id' => 'selectSimpleTS'])!!}
          </div>
        </div>

		    <div class="form-group">
          {!! Form::label('nivel_conocimiento','Nivel Conocimiento:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-3">
            {!! Form::select('nivel_conocimiento',$nivelesConocimientos, $conocimientoInformatico->nivel_conocimiento_id, ['class' =>'populate placeholder', 'id' => 'selectSimpleNC'])!!}
          </div>
        </div>

        <div class="form-group descripcion">
          {!! Form::label('descripcion_conocimiento','Descripción Conocimiento:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-4">
            <a href="#anchor" id="anchor"></a>
            {!! Form::textarea('descripcion_conocimiento', $conocimientoInformatico->descripcion_conocimiento, ['class' => 'form-control', 'placeholder' => '', 'id' => 'textarea_tarea'])!!}
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

    function restablecer (conocimientoInformatico){
      $('#selectSimpleTS').select2().select2("val", conocimientoInformatico['tipo_software']);
      $('#selectSimpleTS').select2();
      $('#selectSimpleNC').select2().select2("val", conocimientoInformatico['nivel_conocimiento']);
      $('#selectSimpleNC').select2();
      $('#textarea_tarea').summernote('code', expLaboral['descripcion_conocimiento']);
    }

    $(document).ready(function() {

      //Valores para restablecer.
      var conocimientoInformatico = [];
      conocimientoInformatico['tipo_software'] = {{$conocimientoInformatico->tipo_software_id}};
      conocimientoInformatico['nivel_conocimiento'] = {{$conocimientoInformatico->nivel_conocimiento_id}};

    	// Select
    	$('#selectSimpleTS').select2({
      	placeholder: "Tipo Software"
    	});

	    $('#selectSimpleNC').select2({
        	placeholder: "Nivel Conocimiento"
      	});

      $("#reset").on("click", function() {
        restablecer(conocimientoInformatico);
      });

      $('#textarea_tarea').summernote({
        lang: 'es-ES',
        height: 130,
        disableResizeEditor: true,
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline']],
          ['fontsize', ['fontsize']],
          ['para', ['ul', 'ol', 'paragraph']],
        ]
      });

    });
  </script>

@endsection
