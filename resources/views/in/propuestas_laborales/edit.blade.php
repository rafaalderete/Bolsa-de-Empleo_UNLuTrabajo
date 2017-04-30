@extends('template.in_main')

@section('headTitle', 'Mis Propuestas | Modificar Propuesta Laboral')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Mis Propuestas</a></li>
        <li><a>Modificar Propuesta Laboral</a></li>
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
        <h4 class="page-header">Modificar Propuesta Laboral</h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => 'in.propuestas_laborales.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

        <div class="form-group">
          <div class="col-sm-12  requisitos-label">
            <p>Información general</p>
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('titulo','Título de la Propuesta', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-6">
            {!! Form::text('titulo',$propuesta->titulo,['class' => 'form-control', 'placeholder' => 'Título de la Propuesta', 'required'])!!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('descripcion','Descripción de la Propuesta', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-8">
            {!! Form::textarea('descripcion',$propuesta->descripcion, ['class' => 'form-control', 'placeholder' => 'Descripción de la Propuesta', 'required'])!!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('lugar_de_trabajo','Lugar de Trabajo', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-3">
            {!! Form::text('lugar_de_trabajo', $propuesta->lugar_de_trabajo, ['class' => 'form-control', 'placeholder' => 'Lugar de Trabajo', 'required'])!!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('tipo_trabajo_id','Tipo de Trabajo', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::select('tipo_trabajo_id',$tipos_trabajo, $propuesta->tipo_trabajo_id, ['id' => 'selectTipoTrabajo'])!!}
          </div>
          {!! Form::label('tipo_jornada_id','Tipo de Jornada', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::select('tipo_jornada_id',$tipos_jornada, $propuesta->tipo_jornada_id, ['id' => 'selectTipoJornada'])!!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('vacantes','Vacantes', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::number('vacantes',$propuesta->vacantes,['min' => 1, 'class' => 'form-control', 'placeholder' => 'Vacantes', 'required'])!!}
          </div>
          {!! Form::label('fecha_fin_propuesta','Fecha Finalización Propuesta', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('fecha_fin_propuesta', $propuesta->fecha_fin_propuesta, ['id' => 'input_date', 'class' => 'form-control', 'placeholder' => 'dd/mm/aaaa', 'required'])!!}
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-12  requisitos-label">
            <p>Requisitos</p>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            {!! Form::label('requisito_años_experiencia_laboral','Años de Experiencia', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
              {!! Form::number('requisito_años_experiencia_laboral',$propuesta->requisito_años_experiencia_laboral,['min' => 0, 'class' => 'form-control', 'placeholder' => 'Años de Experiencia', 'required'])!!}
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            {!! Form::label('lugar_residencia','Lugar de Residencia', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-6 table-responsive">
              <table class="table" id="tab_logic_residencia">
                <thead>
                  <tr>
                    <th class="text-center col-sm-5">
                      Lugar de Residencia
                    </th>
                    <th class="text-center col-sm-1">
                      Excluyente
                    </th>
                    <th class="text-center col-sm-1 requisitos-tabla">
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="hidden">
                    <td data-name="lugar">
                      <input type="text" name='lugar[]' placeholder='Lugar de Residencia' class="form-control"/>
                    </td>
                    <td data-name="excluyente_residencia">
                      <input type="checkbox" name='excluyente_residencia[]' class="form-control requisitos-tabla-checkbox"/>
                    </td>
                    <td data-name="del">
                      <button name="del" class='btn btn-danger row-remove'><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                    </td>
                  </tr>
                  <?php $pos_residencia = 1; ?>
                  @foreach ($propuesta->requisitosResidencia as $requisito_residencia)
                    <tr>
                      <td data-name="lugar">
                        <input type="text" name='lugar[]' placeholder='Lugar de Residencia' class="form-control" value={{$requisito_residencia->lugar}}>
                      </td>
                      <td data-name="excluyente_residencia">
                        @if ($requisito_residencia->excluyente)
                          <input type="checkbox" name='excluyente_residencia[]' class="form-control requisitos-tabla-checkbox" value={{$pos_residencia}} checked/>
                        @else
                          <input type="checkbox" name='excluyente_residencia[]' class="form-control requisitos-tabla-checkbox" value={{$pos_residencia}}/>
                        @endif
                      </td>
                      <td data-name="del">
                        <button name="del" class='btn btn-danger row-remove'><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                      </td>
                    </tr>
                    <?php $pos_residencia++; ?>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2 col-sm-offset-2">
              <a id="add_row_residencia" class="btn btn-default">Agregar Lugar de Residencia</a>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            {!! Form::label('idioma','Idioma', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-7 table-responsive">
              <table class="table" id="tab_logic_idioma">
                <thead>
                  <tr>
                    <th class="text-center col-sm-3">
                      Idioma
                    </th>
                    <th class="text-center col-sm-3">
                      Tipo Conocimiento
                    </th>
                    <th class="text-center col-sm-3">
                      Nivel
                    </th>
                    <th class="text-center col-sm-1">
                      Excluyente
                    </th>
                    <th class="text-center col-sm-1 requisitos-tabla">
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="hidden">
                    <td data-name="idioma">
                      <select name="idioma[]" placeholder='Idioma' class="form-control input_idioma input_idioma_idioma">
                        <option value="" disabled selected hidden>Idioma</option>
                        @foreach($idiomas as $idioma)
                          <option value="{{$idioma->id}}">{{$idioma->nombre_idioma}}</option>
                        @endforeach
                      </select>
                    </td>
                    <td data-name="tipo_conocimiento_idioma">
                      <select name="tipo_conocimiento_idioma[]" placeholder='Tipo de Conocimiento' class="form-control input_idioma input_idioma_tipo">
                        <option value="" disabled selected hidden>Tipo Conocimiento</option>
                        @foreach($tipos_conocimiento_idioma as $tipo_conocimiento_idioma)
                          <option value="{{$tipo_conocimiento_idioma->id}}">{{$tipo_conocimiento_idioma->nombre_tipo_conocimiento_idioma}}</option>
                        @endforeach
                      </select>
                    </td>
                    <td data-name="nivel_conocimiento_idioma">
                      <select name="nivel_conocimiento_idioma[]" placeholder='Nivel' class="form-control">
                        <option value="" disabled selected hidden>Nivel</option>
                        @foreach($niveles_conocimiento as $nivel_conocimiento)
                          <option value="{{$nivel_conocimiento->id}}">{{$nivel_conocimiento->nombre_nivel_conocimiento}}</option>
                        @endforeach
                      </select>
                    </td>
                    <td data-name="excluyente_idioma">
                      <input type="checkbox" name='excluyente_idioma[]' class="form-control requisitos-tabla-checkbox"/>
                    </td>
                    <td data-name="del">
                      <button name="del" class='btn btn-danger row-remove'><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                    </td>
                  </tr>
                  <?php $pos_Idioma = 0; ?>
                  @foreach ($propuesta->requisitosIdioma as $requisito_idioma)
                    <tr>
                      <td data-name="idioma">
                        <select name="idioma[]" placeholder='Idioma' class="form-control input_idioma input_idioma_idioma">
                          <option value="" disabled selected hidden>Idioma</option>
                          @foreach($idiomas as $idioma)
                            <option value="{{$idioma->id}}">{{$idioma->nombre_idioma}}</option>
                          @endforeach
                        </select>
                      </td>
                      <td data-name="tipo_conocimiento_idioma">
                        <select name="tipo_conocimiento_idioma[]" placeholder='Tipo de Conocimiento' class="form-control input_idioma input_idioma_tipo">
                          <option value="" disabled selected hidden>Tipo Conocimiento</option>
                          @foreach($tipos_conocimiento_idioma as $tipo_conocimiento_idioma)
                            <option value="{{$tipo_conocimiento_idioma->id}}">{{$tipo_conocimiento_idioma->nombre_tipo_conocimiento_idioma}}</option>
                          @endforeach
                        </select>
                      </td>
                      <td data-name="nivel_conocimiento_idioma">
                        <select name="nivel_conocimiento_idioma[]" placeholder='Nivel' class="form-control">
                          <option value="" disabled selected hidden>Nivel</option>
                          @foreach($niveles_conocimiento as $nivel_conocimiento)
                            <option value="{{$nivel_conocimiento->id}}">{{$nivel_conocimiento->nombre_nivel_conocimiento}}</option>
                          @endforeach
                        </select>
                      </td>
                      <td data-name="excluyente_idioma">
                        <input type="checkbox" name='excluyente_idioma[]' class="form-control requisitos-tabla-checkbox"/>
                      </td>
                      <td data-name="del">
                        <button name="del" class='btn btn-danger row-remove'><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                      </td>
                    </tr>
                    <?php $pos_residencia++; ?>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="row error-idioma">
            <div class="col-sm-10 col-sm-offset-2">
              <span>Idioma y Tipo Conocimiento ya seleccionados.</span>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2 col-sm-offset-2">
              <a id="add_row_idioma" class="btn btn-default">Agregar Idioma</a>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            {!! Form::label('carrera','Carrera', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-6 table-responsive">
              <table class="table" id="tab_logic_carrera">
                <thead>
                  <tr>
                    <th class="text-center col-sm-4">
                      Carrera
                    </th>
                    <th class="text-center col-sm-3">
                      Estado Carrera
                    </th>
                    <th class="text-center col-sm-1">
                      Excluyente
                    </th>
                    <th class="text-center col-sm-1 requisitos-tabla">
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="hidden">
                    <td data-name="carrera">
                      <select name="carrera[]" placeholder='Carrera' class="form-control input_carrera">
                        <option value="" disabled selected hidden>Carrera</option>
                        @foreach($carreras as $carrera)
                          <option value="{{$carrera->id}}">{{$carrera->nombre_carrera}}</option>
                        @endforeach
                      </select>
                    </td>
                    <td data-name="estado_carrera">
                      <select name="estado_carrera[]" placeholder='Estado Carrera' class="form-control">
                        <option value="" disabled selected hidden>Estado Carrera</option>
                        @foreach($estados_carrera as $estado_carrera)
                          <option value="{{$estado_carrera->id}}">{{$estado_carrera->nombre_estado_carrera}}</option>
                        @endforeach
                      </select>
                    </td>
                    <td data-name="excluyente_carrera">
                      <input type="checkbox" name='excluyente_carrera[]' class="form-control requisitos-tabla-checkbox"/>
                    </td>
                    <td data-name="del">
                      <button name="del" class='btn btn-danger row-remove'><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row error-carrera">
            <div class="col-sm-10 col-sm-offset-2">
              <span>Carrera ya seleccionada.</span>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2 col-sm-offset-2">
              <a id="add_row_carrera" class="btn btn-default">Agregar Carrera</a>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            {!! Form::label('adicional','Requisito Adicional', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-6 table-responsive">
              <table class="table" id="tab_logic_adicional">
                <thead>
                  <tr>
                    <th class="text-center col-sm-3">
                      Nombre Requisito
                    </th>
                    <th class="text-center col-sm-3">
                      Nivel
                    </th>
                    <th class="text-center col-sm-1">
                      Excluyente
                    </th>
                    <th class="text-center col-sm-1 requisitos-tabla">
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="hidden">
                    <td data-name="nombre_requisito">
                      <input type="text" name='nombre_requisito[]' placeholder='Nombre Requisito' class="form-control"/>
                    </td>
                    <td data-name="nivel_conocimiento_adicional">
                      <select name="nivel_conocimiento_adicional[]" placeholder='Nivel' class="form-control">
                        <option value="" disabled selected hidden>Nivel</option>
                        @foreach($niveles_conocimiento as $nivel_conocimiento)
                          <option value="{{$nivel_conocimiento->id}}">{{$nivel_conocimiento->nombre_nivel_conocimiento}}</option>
                        @endforeach
                      </select>
                    </td>
                    <td data-name="excluyente_adicional">
                      <input type="checkbox" name='excluyente_adicional[]' class="form-control requisitos-tabla-checkbox"/>
                    </td>
                    <td data-name="del">
                      <button name="del" class='btn btn-danger row-remove'><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2 col-sm-offset-2">
              <a id="add_row_adicional" class="btn btn-default">Agregar Requisito Adicional</a>
            </div>
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

        <a href="{{ route('in.propuestas_laborales.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver a Mis Propuestas
        </a>
      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    function eventoIdioma(input) {
      input.on('change', function() {
        var error = false;
        var idioma = input.parent().parent().find($(".input_idioma_idioma")).val();
        var tipo_conocimiento_idioma = input.parent().parent().find($(".input_idioma_tipo")).val();
        $.each(input.parent().parent().siblings(), function() {
            var idioma_sibling = $(this).find($(".input_idioma_idioma")).val();
            var tipo_conocimiento_idioma_sibling = $(this).find($(".input_idioma_tipo")).val();
            if ( (idioma == idioma_sibling) && (tipo_conocimiento_idioma == tipo_conocimiento_idioma_sibling) ) {
              error = true;
            }
        });
        if (error) {
          $('.error-idioma').css('visibility', 'visible');
          input.val("");
        }
        else {
          $('.error-idioma').css('visibility', 'hidden');
        }
      });
    }

    function eventoCarrera(input) {
      input.on('change', function() {
        var error = false;
        var carrera = input.val();
        $.each(input.parent().parent().siblings(), function() {
            var carrera_sibling = $(this).find($(".input_carrera")).val();
            if (carrera == carrera_sibling) {
              error = true;
            }
        });
        if (error) {
          $('.error-carrera').css('visibility', 'visible');
          input.val("");
        }
        else {
          $('.error-carrera').css('visibility', 'hidden');
        }
      });
    }

    function agregarFila(idTabla, pos) {
      var tr = $("<tr></tr>");
      // loop through each td and create new elements with name of newid
      $.each($(idTabla+" tbody tr:nth(0) td"), function() {
          var cur_td = $(this);
          var children = cur_td.children();
          // add new td and element if it has a name
          if ($(this).data("name") != undefined) {
              var td = $("<td></td>", {
                  "data-name": $(cur_td).data("name"),
                  "class":"requisitos-tabla"
              });

              var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
              c.attr("name", $(cur_td).data("name")+"[]");
              if (!c.is(':checkbox')) {
                c.prop('required',true);
              }
              else {
                c.attr("value", pos); //Posicion de checkbox.
              }
              c.appendTo($(td));
              td.appendTo($(tr));

              if ( (c.attr('name') == 'idioma[]') || (c.attr('name') == 'tipo_conocimiento_idioma[]') ) {
                eventoIdioma(c);
              }

              if (c.attr('name') == 'carrera[]') {
                eventoCarrera(c);
              }

          } else {
              var td = $("<td></td>", {
                  'text': $(idTabla+' tr').length
              }).appendTo($(tr));
          }
      });

      // add the new row
      $(tr).appendTo($(idTabla));
      pos++;
      $(tr).find("td button.row-remove").on("click", function() {
           $(this).closest("tr").remove();
      });
    }

    $(document).ready(function() {

      //Comienzo de la posición de los checkbox.
      var pos_residencia = {{count($propuesta->requisitosResidencia)}}+1;
      var pos_idioma = {{count($propuesta->requisitosIdioma)}};
      var pos_carrera = {{count($propuesta->requisitosCarrera)}};
      var pos_adicional = {{count($propuesta->requisitosAdicionales)}}+1;

      $("#add_row_residencia").on("click", function() {
        agregarFila("#tab_logic_residencia", pos_residencia);
        pos_residencia++;
      });

      $("#add_row_idioma").on("click", function() {
        agregarFila("#tab_logic_idioma", pos_idioma);
        pos_idioma++;
      });

      $("#add_row_carrera").on("click", function() {
        agregarFila("#tab_logic_carrera", pos_carrera);
        pos_carrera++;
      });

      $("#add_row_adicional").on("click", function() {
        agregarFila("#tab_logic_adicional", pos_adicional);
        pos_adicional++;
      });

      // Fecha Nac.
      $('#input_date').datepicker({setDate: new Date()});

      // Select
      $('#selectTipoTrabajo').select2({
        placeholder: "Tipo de Trabajo"
      });

      $('#selectTipoJornada').select2({
        placeholder: "Tipo de Jornada"
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
