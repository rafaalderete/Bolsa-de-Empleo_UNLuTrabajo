@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Gestionar CV | Estudio Academico')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Modificar Estudio Académico</a></li>
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
      <h4 class="page-header">Modificar Estudio Académico</h4>

      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

      <!-- Formulario -->
      {!! Form::open(['route' => ['in.gestionar-cv.estudios-academicos.update', $estudio], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

        <div class="form-group">
          {!! Form::label('titulo','Carrera:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('titulo', $estudio->titulo, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
          </div>
          {!! Form::label('nivel_educativo','Nivel Educativo:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::select('nivel_educativo',$nivelesEducativos, $estudio->nivel_educativo_id, ['class' =>'populate placeholder', 'id' => 'selectSimpleNE'])!!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('nombre_instituto','Instituto:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('nombre_instituto', $estudio->nombre_instituto, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
          </div>
          {!! Form::label('estado_carrera','Estado de la Carrera:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::select('estado_carrera',$estadosCarrera, $estudio->estado_carrera_id, ['class' =>'populate placeholder', 'id' => 'selectSimpleEC'])!!}
          </div>
        </div>

		<div class="form-group">
		  {!! Form::label('materias_total','Materias Total:', ['class' => 'col-sm-2 control-label']) !!}
		  <div class="col-sm-2">
		    {!! Form::number('materias_total', $estudio->materias_total, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
		  </div>
		  {!! Form::label('periodo_inicio','Periodo Inicio:', ['class' => 'col-sm-4 control-label']) !!}
		  <div class="col-sm-2">
		    {!! Form::text('periodo_inicio', $estudio->periodo_inicio, ['id' => 'input_date_inicio', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa'])!!}
		  </div>
		</div>

		<div class="form-group">
          {!! Form::label('materias_aprobadas','Materias Aprobadas:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::number('materias_aprobadas', $estudio->materias_aprobadas, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
          </div>
          @if($estudio->estadoCarrera->nombre_estado_carrera == 'Finalizado')
            {!! Form::label('periodo_fin','Periodo Fin:', ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-sm-2">
              {!! Form::text('periodo_fin', $estudio->periodo_fin, ['id' => 'input_date_fin', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa', 'required'])!!}
            </div>
          @else
            {!! Form::label('periodo_fin','Periodo Fin:', ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-sm-2">
              {!! Form::text('periodo_fin', null, ['id' => 'input_date_fin', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa', 'disabled'])!!}
            </div>
          @endif
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

        <a href="{{ route('in.gestionar-cv.estudios-academicos.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver a la Tabla
        </a>



    </div>
  </div>
</div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    function restablecer (estudio){
      $("input[name='titulo']").val(estudio['titulo']);
      $('#selectSimpleNE').select2().select2("val", estudio['nivel_educativo']);
      $('#selectSimpleNE').select2();
      $("input[name='nombre_instituto']").val(estudio['nombre_instituto']);
      $('#selectSimpleEC').select2().select2("val", estudio['estado_carrera']);
      $('#selectSimpleEC').select2();
      $("input[name='materias_total']").val(estudio['materias_total']);
      $("input[name='periodo_inicio']").val(estudio['periodo_inicio']);
      $("input[name='materias_aprobadas']").val(estudio['materias_aprobadas']);
      $('#input_date_fin').datepicker('option', 'minDate', new Date(estudio['minY'] ,estudio['minM'],estudio['minD']));
      if (estudio['finalizado']){
        $("input[name='periodo_fin']").val(estudio['periodo_fin']);
        $("input[name='periodo_fin']").prop('required',true);
        $("input[name='periodo_fin']").prop('disabled',false);
      }
      else {
        $("input[name='periodo_fin']").val('');
        $("input[name='periodo_fin']").attr('placeholder',"dd-mm-aaaa");
        $("input[name='periodo_fin']").prop('disabled',true);
        $("input[name='periodo_fin']").prop('required',false);
      }
    }

    $(document).ready(function() {

      //Valores para restablecer.
      var estudio = [];
      estudio['titulo'] = "{{$estudio->titulo}}";
      estudio['nivel_educativo'] = {{$estudio->nivel_educativo_id}};
      estudio['nombre_instituto'] = "{{$estudio->nombre_instituto}}";
      estudio['estado_carrera'] = {{$estudio->estado_carrera_id}};
      estudio['materias_total'] = {{$estudio->materias_total}};
      estudio['periodo_inicio'] = "{{$estudio->periodo_inicio}}";
      estudio['materias_aprobadas'] = {{$estudio->materias_aprobadas}};
      estudio['periodo_fin'] = "{{$estudio->periodo_fin}}";
      if ("{{$estudio->estadoCarrera->nombre_estado_carrera}}" == "Finalizado"){
        estudio['finalizado'] = true;
      }
      else {
        estudio['finalizado'] = false;
      }
      estudio['minY'] = {{$minY}};
      estudio['minM'] = {{$minM}}-1;
      estudio['minD'] = {{$minD}};

      //Inicializacion cuando falla request.
      $("input[name='periodo_inicio']").val(estudio['periodo_inicio']);
      $("input[name='periodo_fin']").val(estudio['periodo_fin']);
      if($('#selectSimpleEC').val() == {{$finalizado}}){
        $('#input_date_fin').prop('disabled', false);
        $('#input_date_fin').prop('required', true);
      }else{
        $('#input_date_fin').prop('disabled', true);
        $('#input_date_fin').val('');
        $('#input_date_fin').prop('required', false);
      }

      // Fecha
      $('#input_date_inicio').datepicker({
        setDate: new Date(),
        onSelect: function(dateText, inst) {
            var date = $(this).datepicker('getDate'),
                dia  = date.getDate(),
                mes = date.getMonth(),
                anio =  date.getFullYear();
            $('#input_date_fin').val('');
            $('#input_date_fin').datepicker('option', 'minDate', new Date(anio,mes,dia));
        }
      });
      $('#input_date_fin').datepicker({
        setDate: new Date(),
        minDate: new Date(estudio['minY'] ,estudio['minM'],estudio['minD'])
      });

      // Select
      $('#selectSimpleNE').select2({
        placeholder: "Nivel Educativo"
      });
      $('#selectSimpleEC').select2({
        placeholder: "Estado Carrera"
      });

      $('#selectSimpleEC').on('change', function() {
        if($(this).val() == {{$finalizado}}){
          $('#input_date_fin').prop('disabled', false);
          $('#input_date_fin').prop('required', true);
        }else{
          $('#input_date_fin').prop('disabled', true);
          $('#input_date_fin').val('');
          $('#input_date_fin').prop('required', false);
        }
      });

      $("#reset").on("click", function() {
        restablecer(estudio);
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
      yearSuffix: '',
      maxDate: 'today'
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $(function () {
      $("#fecha").datepicker();
    });

  </script>

@endsection
