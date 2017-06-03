@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Empresas | Registrar Empresa')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Empresas</a></li>
        <li><a>Registrar Empresa</a></li>
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
        <h4 class="page-header">Registro de Empresa</h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => 'in.empresas.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

          <div class="form-group">
            {!! Form::label('nombre_comercial','Nombre Comercial', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('nombre_comercial',null,['class' => 'form-control', 'placeholder' => 'Nombre Comercial', 'data-toggle' => "tooltip", 'data-placement' => "bottom", 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('fecha_fundacion','Fecha Fundacion', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
              {!! Form::text('fecha_fundacion', null, ['id' => 'input_date', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa', 'required'])!!}
            </div>
            {!! Form::label('rubro_empresarial','Rubro Empresarial', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
              <select name="rubro_empresarial" class="populate placeholder" id="selectSimple" required>
                <option value=""></option>
                @foreach($rubros_empresariales as $rubro_empresarial)
                  <option value="{{$rubro_empresarial->id}}">{{$rubro_empresarial->nombre_rubro_empresarial}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('cuit','Cuit', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('cuit', null, ['class' => 'form-control', 'placeholder' => 'Cuit', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('domicilio_residencia','Domicilio', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('domicilio_residencia', null, ['class' => 'form-control', 'placeholder' => 'Calle - Numero', 'required'])!!}
            </div>
              {!! Form::label('localidad_residencia','Localidad', ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('localidad_residencia', null, ['class' => 'form-control', 'placeholder' => 'Localidad', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('provincia_residencia','Provincia', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('provincia_residencia', null, ['class' => 'form-control', 'placeholder' => 'Provincia', 'required'])!!}
            </div>
            {!! Form::label('pais_residencia','Pais', ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('pais_residencia', null, ['class' => 'form-control', 'placeholder' => 'Pais', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('telefono_fijo','Teléfono Fijo', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('telefono_fijo', null, ['class' => 'form-control', 'placeholder' => 'Telefono Fijo'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('telefono_celular','Teléfono Celular', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('telefono_celular', null, ['class' => 'form-control', 'placeholder' => 'Telefono Celular'])!!}
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

        <a href="{{ route('in.empresas.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
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
      $("input[type='text']").val("");
      $('#selectSimple').select2().select2("val", null);
      $('#selectSimple').attr('placeholder', 'Rubro');
      $('#selectSimple').select2();
    }

    $(document).ready(function() {

      $('#input_date').datepicker({
        beforeShow : function(input,inst){
          var offset = $(input).offset();
          var height = $(input).height();
          window.setTimeout(function () {
            $(inst.dpDiv).css({ top: (offset.top - height) + 'px', left:offset.left + 'px' })
          }, 1);
        },
        setDate: new Date()
      });

      // Select
      $('#selectSimple').select2({
        placeholder: "Rubro"
      });

      $("#reset").on("click", function() {
        borrar();
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
