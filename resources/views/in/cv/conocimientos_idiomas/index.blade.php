@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Gestionar CV | Conocimientos Idiomas')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Tabla de Conocimientos de Idiomas</a></li>
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
      <h4 class="page-header">Tabla Conocimientos de Idiomas
        @if(true)
          <a href="{{ route('in.gestionar-cv.conocimientos-idiomas.create') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
            <span><i class="fa fa-plus"></i></span>
            Registrar Conomiento de Idioma
          </a>
        @endif
      </h4>

      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

      <!-- Tabla -->
      <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="dev-table">
        <!-- columnas de la tabla -->
        <thead>
          <tr>
            <th>Idioma</th>
            <th>Tipo Conocimiento</th>
            <th>Nivel Conocimiento</th>
            <th style="width:75px">Acción</th>
          </tr>
        </thead>
        <!-- contenido de la tabla -->
        <tbody>
          @foreach( $conocimientosIdiomas as $conocimientoIdioma )
            <tr>
              <td>{{$conocimientoIdioma->idioma->nombre_idioma}}</td>
              <td>{{$conocimientoIdioma->tipoConocimientoIdioma->nombre_tipo_conocimiento_idioma}}</td>
              <td>{{$conocimientoIdioma->nivelConocimiento->nombre_nivel_conocimiento}}</td>
              <!-- envio el parametro del metodo edit y destroy-->
              <td>
                @if(true)
                  <a href="{{ route('in.gestionar-cv.conocimientos-idiomas.edit', $conocimientoIdioma->id) }}" class="btn btn-primary"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                @endif
                @if(true)
                  {!! Form::open(['route' => ['in.gestionar-cv.conocimientos-idiomas.destroy', $conocimientoIdioma->id], 'method' => 'DELETE', 'style' => "display: inline-block"]) !!}
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#delSpk" data-title="Eliminar Rol"
                      data-message="¿Seguro que quiere eliminar el conocimiento {{$conocimientoIdioma->tipoConocimientoIdioma->nombre_tipo_conocimiento_idioma}} del idioma {{$conocimientoIdioma->idioma->nombre_idioma}}?"><span class=" fa fa-trash-o" aria-hidden="true"></span></a>
                  {!! Form::close() !!}
                  @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

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
        "sDom": "rt<'text-center'p>",
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
