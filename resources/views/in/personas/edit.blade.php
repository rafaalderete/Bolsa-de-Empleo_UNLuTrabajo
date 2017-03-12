@extends('template.main')

@section('headTitle', 'Personas | Editar Persona')

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
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/chosen/chosen.css')}}">

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
        <li><a>Personas</a></li>
        <li><a>Editar Persona</a></li>
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
        <h4 class="page-header">Editar Persona - {{$persona->nombre_persona}} {{$persona->apellido_persona}}</h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => ['in.personas.update', $persona], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

          <div class="form-group">
            {!! Form::label('nombre_persona','Nombre', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('nombre_persona',$persona->nombre_persona,['class' => 'form-control', 'placeholder' => 'Nombre', 'data-toggle' => "tooltip", 'data-placement' => "bottom", 'required'])!!}
            </div>
            {!! Form::label('apellido_persona','Apellido', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('apellido_persona',$persona->apellido_persona,['class' => 'form-control', 'placeholder' => 'Apellido', 'data-toggle' => "tooltip", 'data-placement' => "bottom", 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('fecha_nacimiento_persona','Fecha Nacimiento', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
              {!! Form::text('fecha_nacimiento_persona', $persona->fecha_nacimiento_persona, ['id' => 'input_date', 'class' => 'form-control', 'placeholder' => 'dd/mm/aaaa', 'required'])!!}
            </div>
            {!! Form::label('tipo_documento_persona','Documento', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
              {!! Form::select('tipo_documento_persona',['' => '', 'DNI' => 'DNI', 'LC' => 'LC', 'CI' => 'CI'], $persona->tipo_documento_persona, ['class' =>'populate placeholder', 'id' => 'selectSimple'])!!}
            </div>
            <div class="col-sm-4">
              {!! Form::text('nro_documento_persona', $persona->nro_documento_persona, ['class' => 'form-control', 'placeholder' => 'Numero', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('domicilio_residencia_persona','Domicilio', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('domicilio_residencia_persona', $persona->domicilio_residencia_persona, ['class' => 'form-control', 'placeholder' => 'Calle - Numero', 'required'])!!}
            </div>
              {!! Form::label('localidad_residencia_persona','Localidad', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('localidad_residencia_persona', $persona->localidad_residencia_persona, ['class' => 'form-control', 'placeholder' => 'Localidad', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('provincia_residencia_persona','Residencia', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
              {!! Form::text('provincia_residencia_persona', $persona->provincia_residencia_persona, ['class' => 'form-control', 'placeholder' => 'Provicia', 'required'])!!}
            </div>
            <div class="col-sm-5">
              {!! Form::text('pais_residencia_persona', $persona->pais_residencia_persona, ['class' => 'form-control', 'placeholder' => 'Pais', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('telefono_contacto_persona','Telefono', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
              {!! Form::text('telefono_contacto_persona', $persona->telefono_contacto_persona, ['class' => 'form-control', 'placeholder' => 'Telefono', 'required'])!!}
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
                Restablecer
              </button>
            </div>
          </div>

        {!! Form::close()!!}

        <a href="{{ route('in.personas.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
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
  <script src="{{ asset('plugins/chosen/chosen.jquery.js')}}"></script>

  <script type="text/javascript">

    $(document).ready(function() {

      // Fecha Nac.
      $('#input_date').datepicker({setDate: new Date()});

      // Select
      $('#selectSimple').select2({
        placeholder: "Tipo"
      });
      $('#selectEstado').select2({
        placeholder: "Estado"
      });
    });

    <!-- Cambiar el idioma de datepiker -->
    $.datepicker.regional['es'] = {
      closeText: 'Cerrar',
      prevText: '< Ant',
      nextText: 'Sig >',
      currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
      weekHeader: 'Sm',
      dateFormat: 'dd/mm/yy',
      firstDay: 1,
      isRTL: false,
      showMonthAfterYear: false,
      yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $(function () {
      $("#fecha").datepicker();
    });

  </script>

@endsection
