@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Empresas | Editar Empresa')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Empresas</a></li>
        <li><a>Editar Empresa</a></li>
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
        <h4 class="page-header">Editar Empresa - {{$pjuridica->nombre_comercial}}</h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => ['in.empresas.update', $pjuridica], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

          <div class="form-group">
            {!! Form::label('nombre_comercial','Nombre Comercial', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('nombre_comercial',$pjuridica->nombre_comercial,['class' => 'form-control', 'placeholder' => 'Nombre Comercial', 'data-toggle' => "tooltip", 'data-placement' => "bottom", 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('fecha_fundacion','Fecha Fundacion', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
              {!! Form::text('fecha_fundacion', $pjuridica->fecha_fundacion, ['id' => 'input_date', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa', 'required'])!!}
            </div>
            {!! Form::label('rubro_empresarial','Rubro Empresarial', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
              {!! Form::select('rubro_empresarial',$rubros_empresariales, $pjuridica->rubro_empresarial_id, ['class' =>'populate placeholder', 'id' => 'selectSimple'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('cuit','Cuit', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('cuit', $pjuridica->cuit, ['class' => 'form-control', 'placeholder' => 'Cuit', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('domicilio_residencia','Domicilio', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('domicilio_residencia', $pjuridica->persona->direccion->domicilio, ['class' => 'form-control', 'placeholder' => 'Calle - Numero', 'required'])!!}
            </div>
              {!! Form::label('localidad_residencia','Localidad', ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('localidad_residencia', $pjuridica->persona->direccion->localidad, ['class' => 'form-control', 'placeholder' => 'Localidad', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('provincia_residencia','Provincia', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('provincia_residencia', $pjuridica->persona->direccion->provincia, ['class' => 'form-control', 'placeholder' => 'Provincia', 'required'])!!}
            </div>
            {!! Form::label('pais_residencia','Pais', ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('pais_residencia', $pjuridica->persona->direccion->pais, ['class' => 'form-control', 'placeholder' => 'Pais', 'required'])!!}
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

    function restablecer (pjuridica){
      $("input[name='nombre_persona']").val(pjuridica['nombre_comercial']);
      $("input[name='fecha_fundacion']").val(pjuridica['fecha_fundacion']);
      $('#selectSimple').select2().select2("val", pjuridica['rubro_empresarial']);
      $('#selectSimple').select2();
      $("input[name='cuit']").val(pjuridica['cuit']);
      $("input[name='domicilio_residencia']").val(pjuridica['domicilio_residencia']);
      $("input[name='localidad_residencia']").val(pjuridica['localidad_residencia']);
      $("input[name='provincia_residencia']").val(pjuridica['provincia_residencia']);
      $("input[name='pais_residencia']").val(pjuridica['pais_residencia']);
      $("input[name='telefono_fijo']").val(pjuridica['telefono_fijo']);
      $("input[name='telefono_celular']").val(pjuridica['telefono_celular']);
    }

    $(document).ready(function() {

      //Valores para restablecer.
      var pjuridica = [];
      pjuridica['nombre_comercial'] = "{{$pjuridica->nombre_comercial}}";
      pjuridica['fecha_fundacion'] = "{{$pjuridica->fecha_fundacion}}";
      pjuridica['rubro_empresarial'] = {{$pjuridica->rubro_empresarial_id}};
      pjuridica['cuit'] = "{{$pjuridica->cuit}}";
      pjuridica['domicilio_residencia'] = "{{$pjuridica->persona->direccion->domicilio}}";
      pjuridica['localidad_residencia'] = "{{$pjuridica->persona->direccion->localidad}}";
      pjuridica['provincia_residencia'] = "{{$pjuridica->persona->direccion->provincia}}";
      pjuridica['pais_residencia'] = "{{$pjuridica->persona->direccion->pais}}";
      pjuridica['telefono_fijo'] = "{{$telefono_fijo}}";
      pjuridica['telefono_celular'] = "{{$telefono_celular}}";

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
      $('#selectEstado').select2({
        placeholder: "Estado"
      });

      $("#reset").on("click", function() {
        restablecer(pjuridica);
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
