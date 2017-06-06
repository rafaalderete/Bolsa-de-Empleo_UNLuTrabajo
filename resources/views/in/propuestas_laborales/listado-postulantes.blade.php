@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Mis Propuestas | Listado de Postulantes')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Mis Propuestas</a></li>
        <li><a>Listado de Postulantes</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')


<div class="row" style="margin-top:-20px">
  <!-- Box -->
  <div class="box no-box-shadow">
    <!-- Cuerpo del Box-->

    <div class="box-content dropbox">
      <h4 class="page-header">Listado de Postulantes - {{$titulo}}</h4>

      @include('flash::message')
      @include('template.partials.errors')

      <!-- Tabla -->
      <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="dev-table">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Tel. Fijo</th>
            <th>Tel. Celular</th>
            <th>Fecha de Postulación</th>
            <th>Estado Postulación</th>
            <th style="width:120px">Cv Descargado</th>
            <th style="width:100px">Visualizar Cv</th>
          </tr>
        </thead>
        <tbody>
          @foreach( $postulantes as $postulante)
              <tr>
                <td>{{$postulante->fisica->nombre_persona." ".$postulante->fisica->apellido_persona}}</td>
                <td>
                  @foreach ($postulante->fisica->persona->telefonos as $telefono)
                    @if ($telefono->tipo_telefono == 'fijo')
                      {{$telefono->nro_telefono}}
                    @endif
                  @endforeach
                </td>
                <td>
                  @foreach ($postulante->fisica->persona->telefonos as $telefono)
                    @if ($telefono->tipo_telefono == 'celular')
                      {{$telefono->nro_telefono}}
                    @endif
                  @endforeach
                </td>
                <td>{{$postulante->fecha_postulacion}}</td>
                <td>{{$postulante->estado_postulacion}}</td>
                <td class="text-center">
                  @if ($postulante->pivot->cv_descargado)
                    <span class="fa fa-check icon-descargado-true"></span>
                  @else
                    <span class="fa fa-remove icon-descargado-false"></span>
                  @endif
                </td>
                <td class="text-center">
                  <a href="{{ route('in.propuestas-laborales.listado-postulantes.vizualizar-cv', ['id_propuesta' => $postulante->pivot->propuesta_laboral_id, 'id_estudiante' => $postulante->pivot->estudiante_id]) }}" class="btn btn-info">
                    <span class="fa fa-file-text-o" aria-hidden="true" style="color:white"></span></a>
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>

      <a href="{{ route('in.propuestas-laborales.detalle', $propuestaId) }}"  style="margin-top: -5px" class="btn btn-info pull-right">
        <span><i class="fa fa-reply"></i></span>
        Volver al Detalle
      </a>

    </div>
  </div>
</div>

@endsection

@section('bodyJS')

  <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('plugins/datatables/ZeroClipboard.js')}}"></script>
  <script src="{{asset('plugins/datatables/TableTools.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>


  <script type="text/javascript">

    $(document).ready(function(){

      // Tabla
      $('#dev-table').dataTable( {
        "bStateSave": "false",
        "aaSorting": [[ 0, "asc" ]],
        "sDom": "<'pull-right'l>rt<'text-center'p>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     '<select><option value="5">5</option>'+
          '<option value="10">10</option>'+
          '<option value="25">25</option></select>',
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "",
          "sInfo":           "",
          "sInfoEmpty":      "",
          "sInfoFiltered":   "",
          "sInfoPostFix":    "",
          "sSearch":         "",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending":  "",
            "sSortDescending": ""
          }
        },
      });

      // Multiseletc para la tabla
      $('select').select2();
      $('.dataTables_filter').each(function(){
        $(this).find('label input[type=text]').attr('placeholder', 'Buscar');
      });
    });

  </script>

@endsection
