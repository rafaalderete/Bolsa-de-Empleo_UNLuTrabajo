 @extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Gestionar CV | Experiencia Laboral')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Modificar Experiencia Laboral</a></li>
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
      <h4 class="page-header">Modificar Experiencia Laboral</h4>

      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

      <!-- Formulario -->
      {!! Form::open(['route' => ['in.gestionar-cv.experiencia-laborales.update', $expLaboral], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

        <div class="form-group">
          {!! Form::label('nombre_empresa','Empresa:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('nombre_empresa', $expLaboral->nombre_empresa, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
          </div>
          {!! Form::label('rubro_empresarial','Rubro Empresarial:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::select('rubro_empresarial',$rubros_Empresariales, $expLaboral->rubro_empresarial_id, ['class' =>'populate placeholder', 'id' => 'selectSimple'])!!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('puesto','Puesto:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('puesto', $expLaboral->puesto, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
          </div>
          {!! Form::label('periodo_inicio','Periodo Inicio:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('periodo_inicio', $expLaboral->periodo_inicio, ['id' => 'input_date_inicio', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa', 'required'])!!}
          </div>
        </div>

        <div class="form-group descripcion">
          {!! Form::label('descripcion_tarea','Tareas:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <a href="#anchor" id="anchor"></a>
            {!! Form::textarea('descripcion_tarea', $expLaboral->descripcion_tarea, ['class' => 'form-control', 'placeholder' => '','id' => 'textarea_tarea'])!!}
            <div class="row error-descripcion">
              <div class="col-sm-10">
                <span>Debe completar las Tareas.</span>
              </div>
            </div>
          </div>
          @if($expLaboral->periodo_fin == 0)
            {!! Form::label('periodo_fin','Periodo Fin:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
              {!! Form::text('periodo_fin', null, ['id' => 'input_date_fin', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa','disabled'])!!}
            </div>
            <div class="col-sm-2">
              <div class="checkbox" name="presente">
                <label>
                  Presente
                  <input type="checkbox" name='presente' id='checkPresente' class="form-control" checked/>
                  <i class="fa fa-square-o"></i>
                </label>
              </div>
            </div>
          @else
            {!! Form::label('periodo_fin','Periodo Fin:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
              {!! Form::text('periodo_fin', $expLaboral->periodo_fin, ['id' => 'input_date_fin', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa'])!!}
            </div>
            <div class="col-sm-2">
              <div class="checkbox" name="presente">
                <label>
                  Presente
                  <input type="checkbox" name='presente' id='checkPresente' class="form-control"/>
                  <i class="fa fa-square-o"></i>
                </label>
              </div>
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

        <a href="{{ route('in.gestionar-cv.experiencia-laborales.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver a la Tabla
        </a>



    </div>
  </div>
</div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    function restablecer (expLaboral){
      $("input[name='nombre_empresa']").val(expLaboral['nombre_empresa']);
      $('#selectSimple').select2().select2("val", expLaboral['rubro_empresarial']);
      $('#selectSimple').select2();
      $("input[name='puesto']").val(expLaboral['puesto']);
      $('#textarea_tarea').summernote('code', expLaboral['descripcion_tarea']);
      $("input[name='periodo_inicio']").val(expLaboral['periodo_inicio']);
      $("input[name='periodo_fin']").datepicker('option', 'minDate', new Date(expLaboral['minY'] ,expLaboral['minM'],expLaboral['minD']));
      if (expLaboral['presente']){
        $("input[name='periodo_fin']").val('');
        $("input[name='periodo_fin']").attr('placeholder',"dd-mm-aaaa");
        $("input[name='periodo_fin']").prop('disabled',true);
        $("input[name='periodo_fin']").prop('required',false);
        $('#checkPresente').prop('checked',true);
      }
      else {
        $("input[name='periodo_fin']").val(expLaboral['periodo_fin']);
        $("input[name='periodo_fin']").prop('required',true);
        $("input[name='periodo_fin']").prop('disabled',false);
        $('#checkPresente').prop('checked',false);
      }
    }

    $(document).ready(function() {

      //Valores para restablecer.
      var expLaboral = [];
      expLaboral['nombre_empresa'] = "{{$expLaboral->nombre_empresa}}";
      expLaboral['rubro_empresarial'] = {{$expLaboral->rubro_empresarial_id}};
      expLaboral['puesto'] = "{{$expLaboral->puesto}}";
      expLaboral['descripcion_tarea'] = "{!!$expLaboral->descripcion_tarea!!}";
      expLaboral['periodo_inicio'] = "{{$expLaboral->periodo_inicio}}";
      expLaboral['periodo_fin'] = "{{$expLaboral->periodo_fin}}";
      if ({{$expLaboral->periodo_fin}} == 0){
        expLaboral['presente'] = true;
      }
      else {
        expLaboral['presente'] = false;
      }
      expLaboral['minY'] = {{$minY}};
      expLaboral['minM'] = {{$minM}}-1;
      expLaboral['minD'] = {{$minD}};

      // Fecha
      $('#input_date_inicio').datepicker({
        beforeShow : function(input,inst){
          var offset = $(input).offset();
          var height = $(input).height();
          window.setTimeout(function () {
            $(inst.dpDiv).css({ top: (offset.top - height) + 'px', left:offset.left + 'px' })
          }, 1);
        },
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
        beforeShow : function(input,inst){
          var offset = $(input).offset();
          var height = $(input).height();
          window.setTimeout(function () {
            $(inst.dpDiv).css({ top: (offset.top - height) + 'px', left:offset.left + 'px' })
          }, 1);
        },
        setDate: new Date(),
        minDate: new Date(expLaboral['minY'] ,expLaboral['minM'],expLaboral['minD'])
      });

      // Select
      $('#selectSimple').select2({
        placeholder: "Rubro Empresarial"
      });

      //Inicializacion cuando falla request.
      $("input[name='periodo_inicio']").val(expLaboral['periodo_inicio']);
      $("input[name='periodo_fin']").val(expLaboral['periodo_fin']);
      if($('#checkPresente').is(':checked')) {
        $('#input_date_fin').prop('disabled', true);
        $('#input_date_fin').val('');
        $('#input_date_fin').prop('required', false);
      }
      else {
        $('#input_date_fin').prop('disabled', false);
        $('#input_date_fin').prop('required', true);
      }

      $('#checkPresente').on('change', function() {
        if($(this).is(':checked')){
          $('#input_date_fin').prop('disabled', true);
          $('#input_date_fin').val('');
          $('#input_date_fin').prop('required', false);
        }else{
          $('#input_date_fin').prop('disabled', false);
          $('#input_date_fin').prop('required', true);
        }
      });

      $('#textarea_tarea').summernote({
        lang: 'es-ES',
        height: 130,
        disableResizeEditor: true,
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline']],
          ['para', ['ul', 'ol']],
        ]
      });

      //Para borrar el mensaje del summernote cuando no está vacio
      $("#textarea_tarea").on("summernote.change", function (e) {
        if (!$('#textarea_tarea').summernote('isEmpty')) {
          $('.error-descripcion').css('display', 'none');
        }
      });

      $("#reset").on("click", function() {
        restablecer(expLaboral);
      });

      $("form").on("submit", function(e) {
        if ($('#textarea_tarea').summernote('isEmpty')) {
          e.preventDefault();
          $("#anchor").focus();
          $('.error-descripcion').css('display', 'block');
        }
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
