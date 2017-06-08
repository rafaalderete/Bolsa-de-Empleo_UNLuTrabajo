@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Reportes | Detalle')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Reportes</a></li>
        <li><a>Detalle Estudiantes para observar</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')


<div class="row" style="margin-top:-20px;">
  <!-- Box -->
  <div class="box no-box-shadow">
    <!-- Cuerpo del Box-->

    <div class="box-content dropbox" style="width:70%; margin: 0 auto;">
      <h4 class="page-header">Reporte - Detalle Estudiantes Para Observar
        @if(count($cantPostSinDecidirPorProp) > 0)
          @if(true)
            <a href="{{route('in.reportes.empleador.tablaspdf.propuestas-mas-postulados-por-ver')}}"  style="margin-top: -5px" class="btn btn-info pull-right btn-registrar-3">
              <span><i class="fa fa-download"></i></span>
              Descargar Reporte
            </a>
          @endif
        @endif
      </h4>
      @if(count($cantPostSinDecidirPorProp) > 0)
        <!-- Tabla -->
        <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="dev-table">
          <!-- columnas de la tabla -->
          <thead>
            <tr>
              <th style="width:10%">#</th>
              <th style="width:60%">Propuesta</th>
              <th style="width:30%">Postulados por ver</th>
            </tr>
          </thead>
          <!-- contenido de la tabla -->
          <tbody>
            @foreach( $cantPostSinDecidirPorProp as $key => $propuesta )
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$propuesta->titulo}}</td>
                <td>{{$propuesta->postulados_sin_decidir}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div class="text-center">
          <span>No hay datos.</span>
        </div>
      @endif

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

      //Modal
      $('#delSpk').on('show.bs.modal', function (e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
      });
      $('#delSpk').find('.modal-footer #confirm').on('click', function(){
        $(this).data('form').submit();
      });

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
