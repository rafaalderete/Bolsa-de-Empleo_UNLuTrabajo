@extends('template.in_main')

@section('headTitle', 'Personas | Editar Persona')

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
        <h4 class="page-header">Editar Persona - {{$pfisica->nombre_persona}} {{$pfisica->apellido_persona}}</h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => ['in.personas.update', $pfisica], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

          <div class="form-group">
            {!! Form::label('nombre_persona','Nombre', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('nombre_persona',$pfisica->nombre_persona,['class' => 'form-control', 'placeholder' => 'Nombre', 'data-toggle' => "tooltip", 'data-placement' => "bottom", 'required'])!!}
            </div>
            {!! Form::label('apellido_persona','Apellido', ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('apellido_persona',$pfisica->apellido_persona,['class' => 'form-control', 'placeholder' => 'Apellido', 'data-toggle' => "tooltip", 'data-placement' => "bottom", 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('fecha_nacimiento','Fecha Nacimiento', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
              {!! Form::text('fecha_nacimiento', $pfisica->fecha_nacimiento, ['id' => 'input_date', 'class' => 'form-control', 'placeholder' => 'dd/mm/aaaa', 'required'])!!}
            </div>
            {!! Form::label('tipo_documento','Documento', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
              {!! Form::select('tipo_documento',$tipos_documento, $pfisica->tipo_documento_id, ['class' =>'populate placeholder', 'id' => 'selectSimple'])!!}
            </div>
            <div class="col-sm-3">
              {!! Form::text('nro_documento', $pfisica->nro_documento, ['class' => 'form-control', 'placeholder' => 'Numero', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('cuil','Cuil', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('cuil', $pfisica->cuil, ['class' => 'form-control', 'placeholder' => 'Cuil', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('domicilio_residencia','Domicilio', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('domicilio_residencia', $pfisica->persona->direccion->domicilio, ['class' => 'form-control', 'placeholder' => 'Calle - Numero', 'required'])!!}
            </div>
              {!! Form::label('localidad_residencia','Localidad', ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('localidad_residencia', $pfisica->persona->direccion->localidad, ['class' => 'form-control', 'placeholder' => 'Localidad', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('provincia_residencia','Provincia', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('provincia_residencia', $pfisica->persona->direccion->provincia, ['class' => 'form-control', 'placeholder' => 'Provicia', 'required'])!!}
            </div>
            {!! Form::label('pais_residencia','Pais', ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('pais_residencia', $pfisica->persona->direccion->pais, ['class' => 'form-control', 'placeholder' => 'Pais', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('telefono_fijo','Teléfono Fijo', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              @if ($telefono_fijo == '')
                {!! Form::text('telefono_fijo', null, ['class' => 'form-control', 'placeholder' => 'Telefono Fijo'])!!}
              @else
                {!! Form::text('telefono_fijo', $telefono_fijo, ['class' => 'form-control', 'placeholder' => 'Telefono Fijo'])!!}
              @endif
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('telefono_celular','Teléfono Celular', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              @if ($telefono_celular == '')
                  {!! Form::text('telefono_celular', null, ['class' => 'form-control', 'placeholder' => 'Telefono Celular'])!!}
              @else
                  {!! Form::text('telefono_celular', $telefono_celular, ['class' => 'form-control', 'placeholder' => 'Telefono Celular'])!!}
              @endif
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
      dateFormat: 'dd-mm-yy',
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
