@extends('template.main')

@section('headTitle', 'Roles | Tabla de Roles')

@section('headContent')

  <meta name="description" content="description">
  <meta name="author" content="DevOOPS">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('plugins/bootstrap/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}">
  <link rel="stylesheet" href="{{asset('http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('http://fonts.googleapis.com/css?family=Righteous')}}" >
  <link rel="stylesheet" href="{{asset('plugins/fancybox/jquery.fancybox.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/fullcalendar/fullcalendar.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/xcharts/xcharts.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">

@endsection

@section('bodyHeader')

  @include('template.partials.header')
  @include('template.partials.modal')

@endsection

@section('bodySidebar')

  @include('template.partials.sidebar')

@endsection

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Roles</a></li>
        <li><a>Tabla de Roles</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')

  <div class="row">
    <!-- Box -->
    <div class="box" style="margin-top: -20px">
      <!-- Cuerpo del Box-->
      <div class="box-content dropbox">
        <!-- Titulo del Cuerpo del Box -->
        <h4 class="page-header">Tabla de Roles <a href="{{ route('in.roles.create') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-plus"></i></span>
          Registar Rol</a>
        </h4>
        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')
        <!-- Tabla -->
        <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="dev-table">
          <!-- columnas de la tabla -->
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre Rol</th>
              <th>Nombre amigable del Rol</th>
              <th>Estado</th>
              <th style="width:75px">Acción</th>
            </tr>
          </thead>
          <!-- contenido de la tabla -->
          <tbody>
            @foreach( $roles as $rol)
              <tr>
                <td>{{ $rol->id }}</td>
                <td>{{ $rol->name }}</td>
                <td>{{ $rol->nombre_amigable_rol }}</td>
                <td>{{ $rol->estado_rol }}</td>
                <!-- envio el parametro del metodo edit y destroy-->
                <td>
                  <a href="{{ route('in.roles.edit', $rol->id) }}" class="btn btn-primary"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                  {!! Form::open(['route' => ['in.roles.destroy', $rol->id], 'method' => 'DELETE', 'style' => "display: inline-block"]) !!}
                  <a href="" class="btn btn-danger" data-toggle="modal" data-target="#delSpk" data-title="Eliminar Rol"
                    data-message="¿Seguro que quiere eliminar el Rol {{$rol->name}}?"><span class=" fa fa-trash-o" aria-hidden="true"></span></a>
                  {!! Form::close() !!}
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

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <!--<script src="http://code.jquery.com/jquery.js"></script>-->
  <script src="{{asset('plugins/jquery/jquery.js')}}"></script>
  <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>
  <script src="{{asset('plugins/justified-gallery/jquery.justifiedgallery.min.js')}}"></script>
  <script src="{{asset('plugins/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('plugins/tinymce/jquery.tinymce.min.js')}}"></script>
  <!-- All functions for this theme + document.ready processing -->
  <script src="{{asset('js/devoops.min.js')}}"></script>
  <!-- Se Agregaron -->
  <script src="{{asset('plugins/select2/select2.js')}}"></script>
  <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('plugins/datatables/ZeroClipboard.js')}}"></script>
  <script src="{{asset('plugins/datatables/TableTools.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>

  <script type="text/javascript">
  // Run Datables plugin and create 3 variants of settings
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
      "sDom": "<'pull-left'f><'pull-right'l>rt<'text-center'p>",
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
