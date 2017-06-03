@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Mis Propuestas | Modificar Propuesta Laboral')

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
        {!! Form::open(['route' => ['in.propuestas-laborales.update', $propuesta->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

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

        <div class="form-group descripcion">
          {!! Form::label('descripcion','Descripción de la Propuesta', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-8">
            <a href="#anchor" id="anchor"></a>
            {!! Form::textarea('descripcion',$propuesta->descripcion, ['id' => 'descripcion_textarea', 'class' => 'form-control', 'placeholder' => 'Descripción de la Propuesta'])!!}
            <div class="row error-descripcion">
              <div class="col-sm-10">
                <span>Debe completar la descripción.</span>
              </div>
            </div>
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
            {!! Form::text('fecha_fin_propuesta', $propuesta->fecha_fin_propuesta, ['id' => 'input_date', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa', 'required'])!!}
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-12  requisitos-label">
            <p>Requisitos a considerar</p>
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('requisito_años_experiencia_laboral','Años de Experiencia', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::number('requisito_años_experiencia_laboral',$propuesta->requisito_años_experiencia_laboral,['min' => 0, 'class' => 'form-control', 'placeholder' => 'Años de Experiencia'])!!}
          </div>
        </div>

        <div class="form-group form-group-requisito">
          {!! Form::label('lugar_residencia','Lugar de Residencia', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-6 table-responsive">
            <table class="table" id="tab_logic_residencia">
              <thead>
                <tr>
                  <th class="text-center col-sm-5">
                    Lugar de Residencia
                  </th>
                  <th class="text-center col-sm-1">
                    Importante
                  </th>
                  <th class="text-center col-sm-1 requisitos-tabla">
                  </th>
                </tr>
              </thead>
              <tbody class="body_requisitos_residencia">
                <tr class="hidden">
                  <td data-name="lugar">
                    <input type="text" name='lugar[]' placeholder='Lugar de Residencia' class="form-control">
                  </td>
                  <td data-name="excluyente_residencia">
                    <input type="checkbox" name='excluyente_residencia[]' class="form-control requisitos-tabla-checkbox">
                  </td>
                  <td data-name="del">
                    <button name="del" class='btn btn-danger row-remove'><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                  </td>
                </tr>
                <?php $pos_residencia = 1; ?>
                @foreach ($propuesta->requisitosResidencia as $requisito_residencia)
                  <tr class="tr_requisitos_residencia">
                    <td data-name="lugar">
                      <input type="text" name='lugar[]' placeholder='Lugar de Residencia' class="form-control" value={{$requisito_residencia->lugar}}>
                    </td>
                    <td data-name="excluyente_residencia">
                      @if ($requisito_residencia->excluyente)
                        <input type="checkbox" name='excluyente_residencia[]' class="form-control requisitos-tabla-checkbox" value={{$pos_residencia}} checked>
                      @else
                        <input type="checkbox" name='excluyente_residencia[]' class="form-control requisitos-tabla-checkbox" value={{$pos_residencia}}>
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
        <div class="form-group form-group-requisito-boton">
          <div class="col-sm-2 col-sm-offset-2">
            <a id="add_row_residencia" class="btn btn-default">Agregar Lugar de Residencia</a>
          </div>
        </div>

        <div class="form-group form-group-requisito">
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
                    Importante
                  </th>
                  <th class="text-center col-sm-1 requisitos-tabla">
                  </th>
                </tr>
              </thead>
              <tbody class="body_requisitos_idioma">
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
                    <input type="checkbox" name='excluyente_idioma[]' class="form-control requisitos-tabla-checkbox">
                  </td>
                  <td data-name="del">
                    <button name="del" class='btn btn-danger row-remove'><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                  </td>
                </tr>
                <?php $pos_idioma = 0; ?>
                @foreach ($propuesta->requisitosIdioma as $requisito_idioma)
                  <tr class="tr_requisitos_idioma">
                    <td data-name="idioma">
                      {!! Form::select('idioma[]',$array_idiomas, $requisito_idioma->idioma_id, ['id' => 'selectIdioma', 'class' => 'form-control input_idioma input_idioma_idioma'])!!}
                    </td>
                    <td data-name="tipo_conocimiento_idioma">
                      {!! Form::select('tipo_conocimiento_idioma[]',$array_tipos_conocimiento_idioma, $requisito_idioma->tipo_conocimiento_idioma_id, ['class' => 'form-control input_idioma input_idioma_tipo'])!!}
                    </td>
                    <td data-name="nivel_conocimiento_idioma">
                      {!! Form::select('nivel_conocimiento_idioma[]',$array_niveles_conocimiento, $requisito_idioma->nivel_conocimiento_id, ['class' => 'form-control'])!!}
                    </td>
                    <td data-name="excluyente_idioma">
                      @if ($requisito_idioma->excluyente)
                        <input type="checkbox" name='excluyente_idioma[]' class="form-control requisitos-tabla-checkbox" value={{$pos_idioma}} checked>
                      @else
                        <input type="checkbox" name='excluyente_idioma[]' class="form-control requisitos-tabla-checkbox" value={{$pos_idioma}}>
                      @endif
                    </td>
                    <td data-name="del">
                      <button name="del" class='btn btn-danger row-remove'><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                    </td>
                  </tr>
                  <?php $pos_idioma++; ?>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="row error-idioma">
            <div class="col-sm-10 col-sm-offset-2">
              <span>Idioma y Tipo Conocimiento ya seleccionados.</span>
            </div>
          </div>
        </div>
        <div class="form-group form-group-requisito-boton">
          <div class="col-sm-2 col-sm-offset-2">
            <a id="add_row_idioma" class="btn btn-default">Agregar Idioma</a>
          </div>
        </div>

        <div class="form-group form-group-requisito">
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
              <tbody class="body_requisitos_carrera">
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
                    <input type="checkbox" name='excluyente_carrera[]' class="form-control requisitos-tabla-checkbox">
                  </td>
                  <td data-name="del">
                    <button name="del" class='btn btn-danger row-remove'><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                  </td>
                </tr>
                <?php $pos_carrera = 0; ?>
                @foreach ($propuesta->requisitosCarrera as $requisito_carrera)
                  <tr class="tr_requisitos_carrera">
                    <td data-name="carrera">
                      {!! Form::select('carrera[]',$array_carreras, $requisito_carrera->carrera_id, ['class' => 'form-control input_carrera'])!!}
                    </td>
                    <td data-name="estado_carrera">
                      {!! Form::select('estado_carrera[]',$array_estados_carrera, $requisito_carrera->estado_carrera_id, ['class' => 'form-control'])!!}
                    </td>
                    <td data-name="excluyente_carrera">
                      @if ($requisito_carrera->excluyente)
                        <input type="checkbox" name='excluyente_carrera[]' class="form-control requisitos-tabla-checkbox" value={{$pos_carrera}} checked>
                      @else
                        <input type="checkbox" name='excluyente_carrera[]' class="form-control requisitos-tabla-checkbox" value={{$pos_carrera}}>
                      @endif
                    </td>
                    <td data-name="del">
                      <button name="del" class='btn btn-danger row-remove'><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                    </td>
                  </tr>
                  <?php $pos_carrera++; ?>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="row error-carrera">
            <div class="col-sm-10 col-sm-offset-2">
              <span>Carrera ya seleccionada.</span>
            </div>
          </div>
        </div>
        <div class="form-group form-group-requisito-boton">
          <div class="col-sm-2 col-sm-offset-2">
            <a id="add_row_carrera" class="btn btn-default">Agregar Carrera</a>
          </div>
        </div>

        <div class="form-group form-group-requisito">
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
                    Importante
                  </th>
                  <th class="text-center col-sm-1 requisitos-tabla">
                  </th>
                </tr>
              </thead>
              <tbody class="body_requisitos_adicional">
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
                    <input type="checkbox" name='excluyente_adicional[]' class="form-control requisitos-tabla-checkbox">
                  </td>
                  <td data-name="del">
                    <button name="del" class='btn btn-danger row-remove'><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                  </td>
                </tr>
                <?php $pos_adicional = 1; ?>
                @foreach ($propuesta->requisitosAdicionales as $requisito_adicional)
                  <tr class="tr_requisitos_adicional">
                    <td data-name="nombre_requisito">
                      <input type="text" name='nombre_requisito[]' placeholder='Nombre Requisito' class="form-control" value={{$requisito_adicional->nombre_requisito}}>
                    </td>
                    <td data-name="nivel_conocimiento_adicional">
                      {!! Form::select('nivel_conocimiento_adicional[]',$array_niveles_conocimiento, $requisito_adicional->nivel_conocimiento_id, ['class' => 'form-control'])!!}
                    </td>
                    <td data-name="excluyente_adicional">
                      @if ($requisito_adicional->excluyente)
                        <input type="checkbox" name='excluyente_adicional[]' class="form-control requisitos-tabla-checkbox" value={{$pos_adicional}} checked>
                      @else
                        <input type="checkbox" name='excluyente_adicional[]' class="form-control requisitos-tabla-checkbox" value={{$pos_adicional}}>
                      @endif
                    </td>
                    <td data-name="del">
                      <button name="del" class='btn btn-danger row-remove'><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                    </td>
                  </tr>
                  <?php $pos_adicional++; ?>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="form-group form-group-requisito-boton">
          <div class="col-sm-2 col-sm-offset-2">
            <a id="add_row_adicional" class="btn btn-default">Agregar Requisito Adicional</a>
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

        <a href="{{ route('in.propuestas-laborales.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
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
          $('.error-idioma').css('display', 'block');
          input.val("");
        }
        else {
          $('.error-idioma').css('display', 'none');
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
          $('.error-carrera').css('display', 'block');
          input.val("");
        }
        else {
          $('.error-carrera').css('visibility', 'none');
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

      $('#descripcion_textarea').summernote({
        lang: 'es-ES',
        height: 300,
        disableResizeEditor: true,
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline']],
          ['para', ['ul', 'ol']],
        ]
      });

      //Para borrar el mensaje del summernote cuando no está vacio
      $("#descripcion_textarea").on("summernote.change", function (e) {
        if (!$('#descripcion_textarea').summernote('isEmpty')) {
          $('.error-descripcion').css('display', 'none');
        }
      });

      //Valores para restablecer.
      var propuesta = [];
      propuesta['titulo'] = "{{$propuesta->titulo}}";
      propuesta['descripcion'] = "{!!$propuesta->descripcion!!}";
      propuesta['lugar_de_trabajo'] = "{{$propuesta->lugar_de_trabajo}}";
      propuesta['tipo_trabajo'] = {{$propuesta->tipo_trabajo_id}};
      propuesta['tipo_jornada'] = {{$propuesta->tipo_jornada_id}};
      propuesta['vacantes'] = {{$propuesta->vacantes}};
      propuesta['fecha_fin_propuesta'] = "{{$propuesta->fecha_fin_propuesta}}";
      propuesta['requisito_años_experiencia_laboral'] = {{$propuesta->requisito_años_experiencia_laboral}};

      //Comienzo de la posición de los checkbox.
      var pos_residencia = {{count($propuesta->requisitosResidencia)}}+1;
      var pos_idioma = {{count($propuesta->requisitosIdioma)}};
      var pos_carrera = {{count($propuesta->requisitosCarrera)}};
      var pos_adicional = {{count($propuesta->requisitosAdicionales)}}+1;

      //Se guardan los requisitos.
      var requisitosResidencia = $('.tr_requisitos_residencia');
      var requisitosIdioma = $('.tr_requisitos_idioma');
      var requisitosCarrera = $('.tr_requisitos_carrera');
      var requisitosAdicional = $('.tr_requisitos_adicional');

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

      //Eliminar fila de la requisitos ya cargados.
      $('.row-remove').on("click", function() {
           $(this).closest("tr").remove();
      });

      // Fecha Nac.
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
      $('#selectTipoTrabajo').select2({
        placeholder: "Tipo de Trabajo"
      });

      $('#selectTipoJornada').select2({
        placeholder: "Tipo de Jornada"
      });

      $('#reset').on("click", function() {
        $("input[name='titulo']").val(propuesta['titulo']);
        $('#descripcion_textarea').summernote('code', propuesta['descripcion']);
        $("input[name='lugar_de_trabajo']").val(propuesta['lugar_de_trabajo']);
        $('#selectTipoTrabajo').select2().select2("val", propuesta['tipo_trabajo']);
        $('#selectTipoTrabajo').select2();
        $('#selectTipoJornada').select2().select2("val", propuesta['tipo_jornada']);
        $('#selectTipoJornada').select2();
        $("input[name='fecha_fin_propuesta']").val(propuesta['fecha_fin_propuesta']);
        $("input[name='vacantes']").val(propuesta['vacantes']);
        $("input[name='requisito_años_experiencia_laboral']").val(propuesta['requisito_años_experiencia_laboral']);

        $('.body_requisitos_residencia').children().not(':first').remove();
        $('.body_requisitos_residencia').append(requisitosResidencia);

        $('.body_requisitos_idioma').children().not(':first').remove();
        $('.body_requisitos_idioma').append(requisitosIdioma);

        $('.body_requisitos_carrera').children().not(':first').remove();
        $('.body_requisitos_carrera').append(requisitosCarrera);

        $('.body_requisitos_adicional').children().not(':first').remove();
        $('.body_requisitos_adicional').append(requisitosAdicional);

        $(".tr_requisitos_residencia .row-remove, .tr_requisitos_idioma .row-remove, .tr_requisitos_carrera .row-remove, .tr_requisitos_adicional .row-remove").on("click", function() {
            $(this).closest("tr").remove();
        });

        //Reinicia los valores de los checkbox.
        pos_residencia = {{count($propuesta->requisitosResidencia)}}+1;
        pos_idioma = {{count($propuesta->requisitosIdioma)}};
        pos_carrera = {{count($propuesta->requisitosCarrera)}};
        pos_adicional = {{count($propuesta->requisitosAdicionales)}}+1;
      });

      $("form").on("submit", function(e) {
        if ($('#descripcion_textarea').summernote('isEmpty')) {
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
      minDate: 'today'
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $(function () {
      $("#input_date").datepicker();
    });

  </script>

@endsection
